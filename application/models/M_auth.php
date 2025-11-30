<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Ambil data user berdasarkan email (untuk Login)
    public function get_user_by_email($email)
    {
        // Query ini aman untuk semua role
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    // Registrasi User Baru (Default role: user/pelapor)
    public function register_user($data)
    {
        return $this->db->insert('users', $data);
    }
}