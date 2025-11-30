<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model("M_admin", "MM");

		if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            redirect('auth/admin');
        }
	}

    public function index()
    {
        redirect('admin/dashboard','refresh');
    }

    public function dashboard()
    {
        $data["title"] = "ADMIN AYOLAPOR | Dashboard";
		$data["header"] = "Dashboard";
		$data["content"] = "admin/dashboard";
		$data["sidebar"] = "admin/sidebar";

		$this->load->view("template", $data);
    }

    public function pengaduan()
    {
        $data["title"] = "ADMIN AYOLAPOR | Pengaduan";
		$data["header"] = "Pengaduan";
		$data["content"] = "admin/pengaduan";
		$data["sidebar"] = "admin/sidebar";
		$data["libjs"] = "admin/pengaduan";
        $data["add_btn"] = add_btn("btn-tambah-pengaduan");

		$this->load->view("template", $data);
    }
    
	public function table_pengaduan()
	{
		$table = "pengaduan";
		$join = [
			[
				"table" => "users",
				"on" => "$table.id_user = users.id_user",
				"location" => "left",
			],
		];
		$where = "";
		$like = "";
		$select = "";
		$column_order = [
			null,
			"id_pengaduan",
			"id_user",
			"tgl_pengaduan",
			"lokasi_text",
			"latitude",
			"longitude",
			"foto_bukti",
			"keterangan_pengaduan",
			"keterangan_admin",
			"status",
			"updated_at",
			null,
		];
		$column_search = ["tgl_pengaduan", "lokasi_text", "keterangan_pengaduan", "keterangan_admin", "status"];
		$order = ["tgl_pengaduan" => "desc"];

		if ($this->input->is_ajax_request() == true) {
			$list = $this->MM->get_datatables(
				$table,
				$column_order,
				$column_search,
				$order,
				$join,
				$where,
				$like,
				$select
			);
			$data = [];
			$no = $_POST["start"];
			foreach ($list as $field) {
				$no++;
				$row = [];

				$row[] = $no;
				$row[] = $field->nama_lengkap;
				$row[] = $field->tgl_pengaduan;
				$row[] = $field->lokasi_text;
                $row[] = text_center(
					"<img width='150px' src=" . base_url() . $field->foto_bukti . " alt='" . $field->foto_bukti . "'></img>"
				);

				$row[] = $row[] = text_center(
					custom_btn($field->id_pengaduan, "", "btn-edit-pengaduan", "fas fa-pen", "warning") . custom_btn($field->id_pengaduan, "", "btn-hapus-pengaduan", "fas fa-trash", "danger"),
					true
				);

				$data[] = $row;
			}

			$output = [
				"draw" => $_POST["draw"],
				"recordsTotal" => $this->MM->count_all(),
				"recordsFiltered" => $this->MM->count_filtered(),
				"data" => $data,
			];

			//output dalam format JSON
			echo json_encode($output);
		} else {
			exit("Maaf data tidak bisa ditampilkan");
		}
	}

	public function tambah_pengaduan()
	{
		$users = $this->db->get("users");

		$data["users"] = $users->result();
		$data["status"] = true;

		echo json_encode($data);
	}

	public function edit_pengaduan($id)
	{
		$query = $this->db->query("SELECT * FROM pengaduan LEFT JOIN users ON users.id_user = pengaduan.id_user WHERE pengaduan.id_pengaduan = '$id'");
		$users = $this->db->get("users");

		$data["users"] = $users->result();
		$data["data"] = $query->row();
		$data["status"] = true;

		echo json_encode($data);
	}

	public function hapus_pengaduan($id)
	{
		$table = "pengaduan";
		$nama_module = "pengaduan";

		$where = [
			"id_pengaduan" => $id,
		];

		$q = $this->MM->hapus_data($table, $where);
		if ($q) {
			$ret["status"] = true;
			$ret["msg"] = "Data $nama_module berhasil dihapus";
		} else {
			$ret["status"] = false;
			$ret["msg"] = "Data $nama_module gagal dihapus";
		}

		echo json_encode($ret);
	}

	public function simpan_pengaduan()
	{
		$id = $this->input->post("id");
		$data = $this->input->post();
		unset($data["id"]);

		$table = "pengaduan";
		$nama_module = "pengaduan";

		if ($_FILES["foto_bukti"]["size"] > 0) {
			$upload_photo = $this->_upload_images(
				"foto_bukti",
				$data["id_user"] . "_" . time(),
				"foto_bukti"
			);
			if ($upload_photo["status"]) {
				$photo = $upload_photo["filename"];
				$data["foto_bukti"] = "uploads/foto_bukti/" . $photo;
			} else {
				$data["foto_bukti"] = "assets/dist/img/none.png";
			}
		} elseif (!$id) {
			$data["foto_bukti"] = "assets/dist/img/none.png";
		}

		if ($_FILES["foto_bukti_selesai"]["size"] > 0) {
			$upload_photo = $this->_upload_images(
				"foto_bukti_selesai",
				$data["id_user"] . "_" . time(),
				"foto_bukti_selesai"
			);
			if ($upload_photo["status"]) {
				$photo = $upload_photo["filename"];
				$data["foto_bukti_selesai"] = "uploads/foto_bukti_selesai/" . $photo;
			} else {
				$data["foto_bukti_selesai"] = "assets/dist/img/none.png";
			}
		} elseif (!$id) {
			$data["foto_bukti_selesai"] = "assets/dist/img/none.png";
		}

        if ($id) {
            $where = [
                "id_pengaduan" => $id,
            ];

            $q = $this->MM->edit_data($table, $data, $where);

            if ($q) {
                $ret["status"] = true;
                $ret["msg"] = "Data $nama_module berhasil diubah!";
            } else {
                $ret["status"] = false;
                $ret["msg"] = "Data $nama_module gagal diubah!";
            }
        } else {
			$data["tgl_pengaduan"] = get_current_time();
			
            $q = $this->MM->tambah_data($table, $data);

            if ($q) {
                $ret["status"] = true;
                $ret["msg"] = "Data $nama_module berhasil ditambah!";
            } else {
                $ret["status"] = false;
                $ret["msg"] = "Data $nama_module gagal ditambah!";
            }
        }

		echo json_encode($ret);
	}

    public function users()
    {
        $data["title"] = "ADMIN AYOLAPOR | Users";
		$data["header"] = "Users";
		$data["content"] = "admin/users";
		$data["sidebar"] = "admin/sidebar";
		$data["libjs"] = "admin/users";
        $data["add_btn"] = add_btn("btn-tambah-user");

		$this->load->view("template", $data);
    }

    public function table_users()
	{
		$table = "users";
		$join = "";
		$where = "";
		$like = "";
		$select = "";
		$column_order = [
			null,
			"id_user",
			"nama_lengkap",
			"email",
			"password",
			"no_telp",
			"role",
			"created_at",
			null,
		];
		$column_search = ["nama_lengkap", "email", "no_telp", "role"];
		$order = ["id_user" => "desc"];

		if ($this->input->is_ajax_request() == true) {
			$list = $this->MM->get_datatables(
				$table,
				$column_order,
				$column_search,
				$order,
				$join,
				$where,
				$like,
				$select
			);
			$data = [];
			$no = $_POST["start"];
			foreach ($list as $field) {
				$no++;
				$row = [];

				$row[] = $no;
				$row[] = $field->nama_lengkap;
				$row[] = $field->email;
				$row[] = $field->no_telp;
				$row[] = $field->role;

				$row[] = $row[] = text_center(
					custom_btn($field->id_user, "", "btn-edit-user", "fas fa-pen", "warning") . custom_btn($field->id_user, "", "btn-hapus-user", "fas fa-trash", "danger"),
					true
				);

				$data[] = $row;
			}

			$output = [
				"draw" => $_POST["draw"],
				"recordsTotal" => $this->MM->count_all(),
				"recordsFiltered" => $this->MM->count_filtered(),
				"data" => $data,
			];
			//output dalam format JSON
			echo json_encode($output);
		} else {
			exit("Maaf data tidak bisa ditampilkan");
		}
	}

	public function tambah_users()
	{
		$data["status"] = true;

		echo json_encode($data);
	}

	public function edit_users($id)
	{
		$table = "users";

		$where = [
			"id_user" => $id,
		];

		$query = $this->db->get_where($table, $where);

		$data["data"] = $query->row();
		$data["status"] = true;

		echo json_encode($data);
	}

	public function hapus_users($id)
	{
		$table = "users";
		$nama_module = "user";

		$where = [
			"id_user" => $id,
		];

		$q = $this->MM->hapus_data($table, $where);
		if ($q) {
			$ret["status"] = true;
			$ret["msg"] = "Data $nama_module berhasil dihapus";
		} else {
			$ret["status"] = false;
			$ret["msg"] = "Data $nama_module gagal dihapus";
		}

		echo json_encode($ret);
	}

    public function simpan_users()
	{
		$id = $this->input->post("id");
		$data = $this->input->post();
		unset($data["id"]);

		if ($data["password"] == "") {
			unset($data["password"]);
		} else {
			$data["password"] = password_hash(
				$this->input->post("password"),
				PASSWORD_DEFAULT
			);
		}

		$table = "users";
		$nama_module = "user";

		$check = [
			"id_user !=" => $id,
			"email" => $data["email"],
		];

		$data_validation = $this->MM->check_if_data_exist($table, $check);

		if ($data_validation->num_rows()) {
			$ret["status"] = false;
			$ret["msg"] = "Data $nama_module sudah terdaftar";
		} else {
			if ($id) {
				$where = [
					"id_user" => $id,
				];

				$q = $this->MM->edit_data($table, $data, $where);

				if ($q) {
					$ret["status"] = true;
					$ret["msg"] = "Data $nama_module berhasil diubah!";
				} else {
					$ret["status"] = false;
					$ret["msg"] = "Data $nama_module gagal diubah!";
				}
			} else {
				$q = $this->MM->tambah_data($table, $data);

				if ($q) {
					$ret["status"] = true;
					$ret["msg"] = "Data $nama_module berhasil ditambah!";
				} else {
					$ret["status"] = false;
					$ret["msg"] = "Data $nama_module gagal ditambah!";
				}
			}
		}

		echo json_encode($ret);
	}

	private function _upload_images(
		$fieldName,
		$name,
		$folder,
		$ovr = true,
		$ext = "jpg|JPG|jpeg|JPEG|png|PNG",
		$maxSize = 2500,
		$maxWidth = 4500,
		$maxHeight = 4500
	) {
		$config = [];
		$config["upload_path"] = "./uploads/" . $folder . "/";
		$config["allowed_types"] = $ext;
		$config["max_size"] = $maxSize; //set max size allowed in Kilobyte
		$config["max_width"] = $maxWidth; // set max width image allowed
		$config["max_height"] = $maxHeight; // set max height allowed
		$config["file_name"] = $folder . "_" . $name;
		$config['encrypt_name']  = TRUE;
		$config["file_ext_tolower"] = true;

		$this->load->library("upload", $config, $fieldName); // Create custom object for foto upload
		$this->$fieldName->initialize($config);
		$this->$fieldName->overwrite = $ovr;

		//upload and validate
		if ($this->$fieldName->do_upload($fieldName)) {
			$res["filename"] = $this->$fieldName->data("file_name");
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		return $res;
	}
}

/* End of file Admin.php */
