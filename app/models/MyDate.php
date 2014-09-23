<?php

class MyDate {

	/*
	 * Fungsi utk mengecek apakah tahun kabisat.
	 */
	public static function is_leap_year($year){
		return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0)));
	}

	/*
	 * Fungsi utk menentukan jumlah hari dr setiap bulan (Jan = 31, Feb = 28/29, ...).
	 */
	public static function get_number_of_day($month, $year){
		$end_day = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		$day = $end_day[$month-1];//index array dari 0 jd hrs -1
		if($month == 2){
			if(MyDate::is_leap_year($year)){//cek taun kabisat
				$day = 29;
			}
		}	
		return $day;
	}
	
	/*
	 * Fungsi utk mengubah ke awal hari (pukul 00:00:00).
	 */	
	public static function set_start_of_day($date){
		return date('Y-m-d 00:00:00', strtotime($date));
	}
	
	/*
	 * Fungsi utk mengubah ke akhir hari (pukul 23:59:59).
	 */		
	public static function set_end_of_day($date){
		return date('Y-m-d 23:59:59', strtotime($date));
	}
	
	/*
	 * Fungsi utk mengecek apakah tanggal ada di dlm range.
	 */	
	public static function is_in_range($date, $start_date, $end_date){
		$date_ts = strtotime($date);
		$start_ts = strtotime(MyDate::set_start_of_day($start_date));
		$end_ts = strtotime(MyDate::set_end_of_day($end_date));
		return (($start_ts <= $date_ts) && ($date_ts <= $end_ts));
	}

	/*
	 * Fungsi utk mengecek apakah tanggalnya sama (waktu diabaikan).
	 */	
	public static function is_same_date($date_1, $date_2){
		$date_1 = strtotime(MyDate::set_start_of_day($date_1));
		$date_2 = strtotime(MyDate::set_start_of_day($date_2));
		return ($date_1==$date_2);
	}
	
	/*
	 * Fungsi utk mengecek apakah terlambat datang.
	 */	
	public static function is_late($date_time, $schedule_time){
		$date_time = strtotime(date('H:i:s', strtotime($date_time)));
		$schedule_time = strtotime("+1 minute", strtotime($schedule_time));
		return ($date_time > $schedule_time);
	}	
	
	/*
	 * Fungsi utk mengecek apakah pulang awal.
	 */	
	public static function is_early($date_time, $schedule_time){
		$date_time = strtotime(date('H:i:s', strtotime($date_time)));
		$schedule_time = strtotime($schedule_time);
		return ($date_time < $schedule_time);
	}	
	
	public static function is_before_12($date_time){
		$date_time = strtotime(date('H:i:s', strtotime($date_time)));
		$schedule_time = strtotime('12:00:00');
		return ($date_time < $schedule_time);
	}
}
