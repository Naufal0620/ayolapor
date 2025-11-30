<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Main_model extends CI_Model
{
	var $table,
		$column_order,
		$column_search,
		$order,
		$join,
		$where,
		$like,
		$select,
		$group;

	private function _get_datatables_query()
	{
		if ($this->select != "") {
			$this->db->select($this->select);
		}

		$this->db->from($this->table);

		if ($this->join != "") {
			foreach ($this->join as $join) {
				$this->db->join($join["table"], $join["on"], $join["location"]);
			}
		}

		if ($this->where != "") {
			if (isset($this->where["OR"]) && $this->where["OR"]) {
				unset($this->where["OR"]);
				$this->db->or_where($this->where);
			} else {
				$this->db->where($this->where);
			}
		}

		if ($this->like != "") {
			$this->db->like($this->like);
		}

		if ($this->group != "") {
			$this->db->group_by($this->group);
		}

		$i = 0;

		foreach ($this->column_search as $column) {
			if ($_POST["search"]["value"]) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($column, $_POST["search"]["value"]);
				} else {
					$this->db->or_like($column, $_POST["search"]["value"]);
				}

				if (count($this->column_search) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}

		if (isset($_POST["order"])) {
			$this->db->order_by(
				$this->column_order[$_POST["order"][0]["column"]],
				$_POST["order"][0]["dir"]
			);
		} elseif (isset($this->order)) {
			foreach ($this->order as $key => $value) {
				$this->db->order_by($key, $value);
			}
			// $this->db->order_by(
			// 	key($this->order),
			// 	$this->order[key($this->order)]
			// );
		}
	}

	public function get_datatables(
		$table,
		$column_order,
		$column_search,
		$order,
		$join = "",
		$where = "",
		$like = "",
		$select = "",
		$group = ""
	) {
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->join = $join;
		$this->where = $where;
		$this->like = $like;
		$this->select = $select;
		$this->group = $group;

		$this->_get_datatables_query();

		if ($_POST["length"] != -1) {
			$this->db->limit($_POST["length"], $_POST["start"]);
		}

		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function tambah_data($table, $data)
	{
		$q = $this->db->insert($table, $data);

		return $q;
	}

	function tambah_data_batch($table, $data)
	{
		$q = $this->db->insert_batch($table, $data);

		return $q;
	}

	function edit_data($table, $data, $where = "")
	{
		if ($where != "") {
			$q = $this->db->update($table, $data, $where);
		} else {
			$q = $this->db->update($table, $data);
		}

		return $q;
	}

	function hapus_data($table, $where)
	{
		$q = $this->db->delete($table, $where);

		return $q;
	}

	function check_if_data_exist($table, $data, $id = "", $where = "or")
	{
		if ($id != "") {
			$this->db->from($table);
			$this->db->where($id);
			$this->db->group_start();
			if ($where == "or") {
				$this->db->or_where($data);
			} elseif ($where == "and") {
				$this->db->where($data);
			}
			$this->db->group_end();
			$q = $this->db->get();
		} else {
			$q = $this->db->get_where($table, $data);
		}

		return $q;
	}

	function check_if_data_exist_custom($query)
	{
		$q = $this->db->query($query);

		return $q;
	}

	public function cek_user_login($table, $id_column)
	{
		$isLogin = $this->session->userdata("isLogin");
		$id = $this->session->userdata($id_column);

		$cek_id = $this->check_if_data_exist($table, [$id_column => $id]);

		if ($isLogin == "yes" and $cek_id->num_rows()) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file Main_model.php */
