<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_users');
        
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'user') {
            // Jika bukan admin, tendang ke login admin
            redirect('auth');
        }
    }

    public function index()
    {
        // Redirect ke halaman utama aplikasi
        redirect('users/lapor');
    }

    // Halaman Utama (Dulu app.php, sekarang lapor)
    public function lapor()
    {
        $id_user = $this->session->userdata('id_user');
        $user = $this->M_users->get_by_id($id_user);

        $data = [
            'title'   => 'AyoLapor - Buat Laporan',
            'user'    => $user,
            // Kita load view khusus user, pisahkan CSS/JS nanti di view
            'content' => 'users/laporan', 
            'libjs'   => 'users/laporan_logic' // File JS khusus (Tahap 2)
        ];

        // Load view. Anda bisa menggunakan template atau langsung file view
        // Disini saya asumsikan load langsung view laporannya agar sesuai request view "app.php" -> "laporan.php"
        $this->load->view('users/laporan', $data);
    }

    // --- API / AJAX PROCESSES ---

    // 1. Ambil Data Riwayat (JSON)
    public function riwayat_json()
    {
        $id_user = $this->session->userdata('id_user');
        
        // Ambil data laporan milik user ini saja
        $this->db->select('*');
        $this->db->from('pengaduan'); // Pastikan nama tabel 'pengaduan' atau 'laporan' sesuai database
        $this->db->where('id_user', $id_user);
        $this->db->order_by('tgl_pengaduan', 'DESC');
        $data = $this->db->get()->result();

        echo json_encode($data);
    }

    // 2. Submit Laporan Baru
    public function submit_laporan()
    {
        // Validasi Server Side
        $this->form_validation->set_rules('lokasi_text', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('keterangan_pengaduan', 'Keterangan', 'required|trim|max_length[500]');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
            return;
        }

        // Upload Config
        $upload_path = './uploads/foto_bukti/';
        // Pastikan folder ada
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|heic'; // Tambah dukungan format
        $config['max_size']      = 5120; // 5MB
        $config['encrypt_name']  = TRUE; // Enkripsi nama file agar unik

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) {
            echo json_encode(['status' => false, 'message' => $this->upload->display_errors('','')]);
            return;
        }

        $file_data = $this->upload->data();
        
        $insert_data = [
            'id_user'              => $this->session->userdata('id_user'),
            'tgl_pengaduan'        => date('Y-m-d H:i:s'),
            'lokasi_text'          => $this->input->post('lokasi_text', TRUE),
            'latitude'             => $this->input->post('latitude', TRUE),
            'longitude'            => $this->input->post('longitude', TRUE),
            'foto_bukti'           => 'uploads/foto_bukti/' . $file_data['file_name'],
            'keterangan_pengaduan' => $this->input->post('keterangan_pengaduan', TRUE),
            'status'               => 'Pending',
            'updated_at'           => date('Y-m-d H:i:s')
        ];

        // Simpan ke Database
        $simpan = $this->db->insert('pengaduan', $insert_data);

        if ($simpan) {
            echo json_encode(['status' => true, 'message' => 'Laporan berhasil dikirim!']);
        } else {
            // Hapus gambar jika gagal simpan DB agar server tidak penuh sampah
            if(file_exists($upload_path . $file_data['file_name'])) {
                unlink($upload_path . $file_data['file_name']);
            }
            echo json_encode(['status' => false, 'message' => 'Gagal menyimpan ke database.']);
        }
    }
}