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

if (!function_exists('character_limiter'))
{
    /**
     * Membatasi jumlah karakter dalam string.
     * Mempertahankan keutuhan kata (tidak memotong kata di tengah).
     *
     * @param   string  $str        String input
     * @param   int     $n          Jumlah karakter maksimal
     * @param   string  $end_char   Karakter penutup (default: ...)
     * @return  string
     */
    function character_limiter($str, $n = 500, $end_char = '&#8230;')
    {
        // Jika panjang string lebih pendek dari batas, kembalikan apa adanya
        if (strlen($str) < $n)
        {
            return $str;
        }

        // Bersihkan spasi ganda dan baris baru agar rapi
        $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

        if (strlen($str) <= $n)
        {
            return $str;
        }

        $out = "";
        // Pecah string berdasarkan spasi untuk menjaga keutuhan kata
        foreach (explode(' ', trim($str)) as $val)
        {
            $out .= $val.' ';

            if (strlen($out) >= $n)
            {
                $out = trim($out);
                // Kembalikan hasil potongan + end_char (biasanya titik tiga '...')
                return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
            }
        }
    }
}