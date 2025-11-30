<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_petugas');
        
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'petugas') {
            redirect('auth/admin');
        }
    }

    public function index()
    {
        redirect('petugas/dashboard');
    }

    public function dashboard()
    {
        $data['title']   = "Tugas Saya";
        $data['header']  = "Daftar Tugas";
        $data['content'] = "petugas/home_mobile";
        $data['libjs']   = "petugas/mobile_logic";
        $data['tugas']   = $this->M_petugas->get_tugas_aktif(); 

        $this->load->view("mobile_template", $data);
    }

    public function detail($id)
    {
        $data['title']   = "Detail Laporan";
        $data['header']  = "Detail Perbaikan";
        $data['content'] = "petugas/detail_mobile";
        $data['libjs']   = "petugas/mobile_logic";
        
        // Query ambil 1 data by ID
        $data['row'] = $this->db->get_where('pengaduan', ['id_pengaduan' => $id])->row();

        $this->load->view("mobile_template", $data);
    }
    
    public function aksi_selesai()
    {
        // Validasi Input
        $this->form_validation->set_rules('keterangan_admin', 'Keterangan', 'required|trim');
        if (empty($_FILES['foto_selesai']['name'])) {
            $this->form_validation->set_rules('foto_selesai', 'Foto Bukti', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
            return;
        }

        // Config Upload
        $config['upload_path']   = './uploads/foto_bukti_selesai/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 5120; // 5MB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto_selesai')) {
            echo json_encode(['status' => false, 'message' => $this->upload->display_errors('','')]);
            return;
        }

        $file_data = $this->upload->data();
        $id_pengaduan = $this->input->post('id_pengaduan');

        // Data Update
        $data = [
            'status'             => 'Selesai',
            'keterangan_admin'   => $this->input->post('keterangan_admin', TRUE),
            'foto_bukti_selesai' => 'uploads/foto_bukti_selesai/' . $file_data['file_name'],
            'updated_at'         => date('Y-m-d H:i:s')
        ];

        // Update Database via Model (Anda bisa pakai $this->db->update langsung atau via model)
        $this->db->where('id_pengaduan', $id_pengaduan);
        $update = $this->db->update('pengaduan', $data);

        if ($update) {
            echo json_encode(['status' => true, 'message' => 'Pekerjaan berhasil diselesaikan!']);
        } else {
            unlink($config['upload_path'] . $file_data['file_name']); // Hapus foto jika gagal DB
            echo json_encode(['status' => false, 'message' => 'Database error.']);
        }
    }

    public function riwayat()
    {
        $data['title']   = "Riwayat Pekerjaan";
        $data['header']  = "Riwayat Selesai";
        $data['content'] = "petugas/riwayat_mobile";
        $data['libjs']   = "petugas/mobile_logic"; 
        $data['riwayat'] = $this->M_petugas->get_riwayat_selesai();

        $this->load->view("mobile_template", $data);
    }
}