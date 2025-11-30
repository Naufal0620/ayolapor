<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

    private $table = 'users';
    private $pk = 'id_user';

    public function __construct()
    {
        parent::__construct();
    }

    // --- GET DATA ---

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, [$this->pk => $id])->row();
    }

    public function get_by_email($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    // --- CRUD OPERATIONS ---

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where($this->pk, $id);
        return $this->db->update($this->table, $data);
    }

    // --- VALIDATION HELPERS ---

    public function check_email_exists($email, $except_id = null)
    {
        $this->db->where('email', $email);
        if ($except_id) {
            $this->db->where($this->pk . ' !=', $except_id);
        }
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }
}