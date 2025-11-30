<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_petugas extends CI_Model {

    private $table = 'pengaduan';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_tugas_aktif()
    {
        $this->db->select('p.*, u.nama_lengkap as nama_pelapor, u.no_telp as telp_pelapor');
        $this->db->from('pengaduan p');
        $this->db->join('users u', 'u.id_user = p.id_user', 'left');
        
        $this->db->where('p.status', 'Proses');
        
        $this->db->order_by('p.tgl_pengaduan', 'DESC');
        
        return $this->db->get()->result();
    }

    public function get_riwayat_selesai($limit = 20)
    {
        $this->db->select('p.*, u.nama_lengkap as nama_pelapor');
        $this->db->from('pengaduan p');
        $this->db->join('users u', 'u.id_user = p.id_user', 'left');
        
        $this->db->where('p.status', 'Selesai');
        
        $this->db->order_by('p.updated_at', 'DESC');
        
        $this->db->limit($limit);
        
        return $this->db->get()->result();
    }

    public function get_detail($id_pengaduan)
    {
        $this->db->select('p.*, u.nama_lengkap as nama_pelapor, u.no_telp');
        $this->db->from('pengaduan p');
        $this->db->join('users u', 'u.id_user = p.id_user', 'left');
        $this->db->where('p.id_pengaduan', $id_pengaduan);
        
        return $this->db->get()->row();
    }

    public function selesaikan_laporan($id_pengaduan)
    {
        $data = [
            'status'     => 'Selesai',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id_pengaduan', $id_pengaduan);
        return $this->db->update($this->table, $data);
    }

    public function hitung_tugas_aktif()
    {
        $this->db->where('status', 'Proses');
        return $this->db->count_all_results($this->table);
    }
}