<?php

defined("BASEPATH") or exit("No direct script access allowed");

if (!function_exists("text_center")) {
	function text_center($text, $nowrap = false)
	{
		if ($nowrap) {
			return "<center style='white-space: nowrap;'>" .
				$text .
				"</center>";
		} else {
			return "<center>" . $text . "</center>";
		}
	}
}

if (!function_exists("get_current_time")) {
	function get_current_time(
		$format = "Y-m-d H:i:s",
		$add_days = 0,
		$add_hours = 0
	) {
		$date = new DateTime("now", new DateTimeZone("Asia/Jakarta"));

		if ($add_days != 0) {
			$date->modify("{$add_days} day");
		}

		if ($add_hours != 0) {
			$date->modify("{$add_hours} hour");
		}

		return $date->format($format);
	}
}