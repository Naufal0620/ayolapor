<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

    public function index()
    {
        redirect('petugas/dashboard','refresh');
    }

    public function dashboard()
    {
        $data["title"] = "PETUGAS AYOLAPOR | Dashboard";
		$data["header"] = "Dashboard";
		$data["content"] = "petugas/dashboard";
		$data["sidebar"] = "petugas/sidebar";

		$this->load->view("template", $data);
    }

}

/* End of file Petugas.php */
