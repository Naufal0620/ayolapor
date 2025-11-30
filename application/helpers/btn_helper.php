<?php

defined("BASEPATH") or exit("No direct script access allowed");

if (!function_exists("custom_btn")) {
	function custom_btn(
		$id,
		$data = [],
		$class,
		$icon,
		$color,
		$text = "",
		$disabled = false
	) {
		if ($data != [] && $data != "") {
			$d = "";
			foreach ($data as $dt) {
				$d .= "data-" . $dt["key"] . "='" . $dt["value"] . "' ";
			}
		} else {
			$d = "";
		}

		$ret =
			"<button class='btn btn-sm btn-$color $class mx-1' data-id='$id' $d style='white-space: nowrap' " .
			($disabled == true ? "disabled" : "") .
			" ><i class='$icon'></i> $text</button>";

		return $ret;
	}
}

if (!function_exists("checkbox")) {
	function checkbox($id, $data = "", $class = "", $checked = false)
	{
		if ($data != [] && $data != "") {
			$d = "";
			foreach ($data as $dt) {
				$d .= "data-" . $dt["key"] . "='" . $dt["value"] . "' ";
			}
		} else {
			$d = "";
		}

		$ret =
			"<input type='checkbox' class='form-check-input $class m-0' data-id='$id' $d " .
			($checked ? "checked" : "") .
			" >";

		return $ret;
	}
}

if (!function_exists("add_btn")) {
	function add_btn($class, $text = '')
	{
		$data = "
        <a class='btn btn-primary $class'><i class='fas fa-plus'></i> Tambah Data $text</a>
        ";

		return $data;
	}
}