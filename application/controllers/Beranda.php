<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Jika user sudah login, opsional: bisa langsung redirect ke dashboard
        // if ($this->session->userdata('logged_in')) {
        //     $this->_redirect_by_role($this->session->userdata('role'));
        // }
    }

    public function index()
    {
        $data['title'] = "AyoLapor - Layanan Pengaduan Jalan Rusak";
        $this->load->view('beranda', $data);
    }

    // Helper untuk redirect (Opsional)
    private function _redirect_by_role($role)
    {
        if ($role == 'admin') redirect('admin/dashboard');
        if ($role == 'petugas') redirect('petugas/dashboard');
        redirect('users/lapor');
    }
}