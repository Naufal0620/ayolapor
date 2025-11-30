<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
    }

    // --- HALAMAN USER (MASYARAKAT) ---
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            // Jika sudah login, cek role untuk redirect yang benar
            return $this->_redirect_by_role($this->session->userdata('role'));
        }
        
        // Load view Login User (masuk.php)
        // Kita pisah CSS/JS nya nanti sesuai instruksi
        $data['title'] = 'Masuk / Daftar - AyoLapor';
        $data['libjs'] = 'auth/user_auth'; // JS khusus user
        $this->load->view('auth/masuk', $data);
    }

    // --- HALAMAN ADMIN / PETUGAS ---
    public function admin()
    {
        if ($this->session->userdata('logged_in')) {
            return $this->_redirect_by_role($this->session->userdata('role'));
        }

        // Load view Login Admin (AdminLTE style)
        $this->load->view('auth/login_admin');
    }

    // --- PROSES LOGIN (AJAX) ---
    // Digunakan oleh kedua halaman login (User & Admin)
    public function process_login()
    {
        // Cek asal login (apakah dari halaman admin atau user)
        $is_admin_page = $this->input->post('is_admin_login'); 

        $email    = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->M_auth->get_user_by_email($email);

        if ($user) {
            // 1. Verifikasi Password
            if (password_verify($password, $user->password) || md5($password) === $user->password) {
                
                // 2. Validasi Hak Akses Halaman
                // Jika login di halaman admin, tapi role-nya 'user', tolak!
                if ($is_admin_page && $user->role == 'user') {
                    echo json_encode(['status' => false, 'message' => 'Anda tidak memiliki akses ke halaman petugas!']);
                    return;
                }

                // Set Session
                $session_data = [
                    'id_user'      => $user->id_user,
                    'nama_lengkap' => $user->nama_lengkap,
                    'email'        => $user->email,
                    'role'         => $user->role,
                    'logged_in'    => TRUE
                ];
                $this->session->set_userdata($session_data);

                // Tentukan Redirect URL
                $redirect_url = base_url('users'); // Default user
                if ($user->role == 'admin') {
                    $redirect_url = base_url('admin/dashboard');
                } elseif ($user->role == 'petugas') {
                    $redirect_url = base_url('petugas/dashboard');
                }

                echo json_encode(['status' => true, 'message' => 'Login berhasil!', 'redirect' => $redirect_url]);
            } else {
                echo json_encode(['status' => false, 'message' => 'Password salah!']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Email tidak terdaftar!']);
        }
    }

    // --- PROSES REGISTER (AJAX - User Only) ---
    public function process_register()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
        } else {
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                'email'        => $this->input->post('email', TRUE),
                'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'no_telp'      => $this->input->post('no_telp', TRUE),
                'role'         => 'user', // Default role masyarakat
                'created_at'   => date('Y-m-d H:i:s')
            ];

            if ($this->M_auth->register_user($data)) {
                echo json_encode(['status' => true, 'message' => 'Pendaftaran berhasil! Silakan login.']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Gagal mendaftar, coba lagi.']);
            }
        }
    }

    public function logout()
    {
        $role = $this->session->userdata('role');
        $this->session->sess_destroy();
        
        // Redirect sesuai role sebelumnya
        if ($role == 'admin' || $role == 'petugas') {
            redirect('auth/admin');
        } else {
            redirect('auth');
        }
    }

    private function _redirect_by_role($role)
    {
        if ($role == 'admin') redirect('admin/dashboard');
        if ($role == 'petugas') redirect('petugas/dashboard');
        redirect('users/lapor');
    }
}