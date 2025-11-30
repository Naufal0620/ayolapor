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
        $id = $this->input->post('id');
        $this->M_petugas->selesaikan_laporan($id);
        echo json_encode(['status' => true]);
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