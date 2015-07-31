<?php

class Employee extends Eloquent {

    protected $table = 'employees';
    protected $fillable = array('id', 'ssn', 'name', 'is_male', 'birthday', 'street', 'department_id');
    public $timestamps = false;
    private $auto_check, $manual_in, $manual_out;

    // ---------- RELATION ----------

    public function account() {
        return $this->hasOne('Account');
    }

    public function department() {
        return $this->belongsTo('Department');
    }

    public function schedules() {
        return $this->hasMany('Schedule');
    }

    public function absences() {
        return $this->hasMany('Absence');
    }

    public function autoChecks() {
        return $this->hasMany('AutoCheck');
    }

    public function manualChecks() {
        return $this->hasMany('ManualCheck');
    }

    // ---------- FUNCTION ----------

    public function get_absence_data($month, $year) {
        //data utk disimpan
        $data = [
            'normal_weekday' => 0, 'normal_weekend' => 0,
            'pulang_awal_weekday_before_12' => 0, 'pulang_awal_weekday' => 0, 'pulang_awal_weekend' => 0,
            'terlambat' => 0, 'lupa' => 0, 'tugas_luar_weekday' => 0, 'tugas_luar_weekend' => 0, 'other' => 0,
            'sakit' => 0, 'izin' => 0, 'alpha' => 0,
            'masuk_weekday' => 0, 'masuk_weekend' => 0, 'tidak_masuk' => 0,
            'konsumsi_weekday' => 0, 'konsumsi_weekend' => 0, 'konsumsi_pulang_awal' => 0, 'konsumsi_total' => 0
        ];
        if (!is_null($this->schedules()->first())) {
            $weekly_schedules = $this->schedules()->orderBy('start_date', 'DESC')->first()->weekly_schedule()->get();
            //ambil data jadwal	
            $schedule = $this->getSchedule($weekly_schedules);

            if (!empty($schedule)) {
                $terlambat = ['weekday' => 0, 'weekend' => 0];
                $lupa = ['weekday' => 0, 'weekend' => 0];
//                $tugas = ['weekday' => 0, 'weekend' => 0];
                $other = ['weekday' => 0, 'weekend' => 0];

                //tentukan range waktu (awal bulan-akhir bulan)
                $end_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $start_date = "$year-$month-01 00:00:00";
                $end_date = "$year-$month-$end_day 23:59:59";
                $start_time = strtotime("$year-$month-01 00:00:00");
                $end_time = strtotime("$year-$month-$end_day 23:59:59");

                //ambil data uang konsumsi
                $allowance = $this->getAllowance($weekly_schedules);

                //iterasi perhari dari awal bulan hingga akhir bulan
                $absences = $this->absences()->where('start_date', '>=', $start_date)->where('end_date', '<=', $end_date)->orderBy('start_date')->get();
                $this->auto_check = $this->autoChecks()->whereBetween('date_time', [$start_date, $end_date])->orderBy('date_time')->get();
                $this->manual_in = $this->manualChecks()->whereBetween('date_time', [$start_date, $end_date])->where('is_in', '=', 1)->orderBy('date_time')->get();
                $this->manual_out = $this->manualChecks()->whereBetween('date_time', [$start_date, $end_date])->where('is_in', '=', 0)->orderBy('date_time')->get();
                for ($i = $start_time; $i <= $end_time; $i = strtotime("+1 day", $i)) {
                    $current_date = getdate($i);

                    if ($current_date['wday'] != 0) {//hari minggu tdk dihitung
                        //periksa attendance
                        if (count($absences) > 0 && date_parse($absences[0]['start_date'])['day'] == $current_date['mday']) {
                            $absence = $absences->shift();
                            $category_id = $absence['absence_category_id'];
                            switch ($category_id) {
                                case 3:
                                    $current_date['wday'] != 6 ? $other['weekday'] ++ : $other['weekend'] ++;
                                    break;
                                case 4:
//                                    $current_date['wday'] != 6 ? $tugas['weekday'] ++ : $tugas['weekend'] ++;
                                    $current_date['wday'] != 6 ? $data['tugas_luar_weekday'] ++ : $data['tugas_luar_weekend'] ++;
                                    break;
                                case 5:
                                    $data['izin'] ++;
                                    break;
                                case 6: //cuti dihitung sbg other
                                    $current_date['wday'] != 6 ? $other['weekday'] ++ : $other['weekend'] ++;
                                    break;
                                case 7:
                                    $data['sakit'] ++;
                                    break;
                                case 8:
                                    $data['lupa'] ++;
                                    break;
                            }
                        } else {
                            $holiday = MyDate::is_holiday(date('Y-m-d', $i));
                            if ($holiday != 1) {
                                $inout = $this->getInOut($current_date['mday']);
                                $in = $inout[0];
                                $out = $inout[1];
                                $alpha = TRUE;

                                // --- tanpa memperhitungkan perbedaan check in & check out
                                //                                if ($auto_check[0]['date_time']) {
                                //                                    $parsed_date = date_parse($auto[0]['date_time']);
                                //                                    $parsed_date['hour'] < 12 ? $in = $auto[0] : $in = $this->manualChecks()->whereBetween('date_time', array($current_date_start, $current_date_end))
                                //                                                            ->where('is_in', '=', 1)->orderBy('date_time')->first();
                                //                                }
                                //                                if ($size_auto >= 2 || $in != null) {
                                //                                    $parsed_date = date_parse($auto[$size_auto - 1]['date_time']);
                                //                                    $auto[$size_auto - 1]['is_in'] == 0 || $parsed_date['hour'] > 9 ? $out = $auto[$size_auto - 1] : $out = $this->manualChecks()->whereBetween('date_time', array($current_date_start, $current_date_end))
                                //                                                            ->where('is_in', '=', 0)->orderBy('date_time', 'DESC')->first();
                                //                                }
                                // --- selesai

                                if (!is_null($in)) {
                                    if (MyDate::is_late($in['date_time'], $schedule[$current_date['wday']]['start_time'])) {
                                        $current_date['wday'] != 6 ? $terlambat['weekday'] ++ : $terlambat['weekend'] ++;
                                        $alpha = FALSE;
                                    }
                                }
                                if ($alpha) {
                                    if (is_null($in) xor is_null($out)) {//lupa salah satu dari absen masuk/keluar
                                        $current_date['wday'] != 6 ? $lupa['weekday'] ++ : $lupa['weekend'] ++;
                                        $alpha = FALSE;
                                    } else if (/* !is_null($in) && */!is_null($out)) {
                                        if (MyDate::is_early($out['date_time'], $schedule[$current_date['wday']]['end_time'])) {
                                            if ($current_date['wday'] == 6) {//hari sabtu
                                                $data['pulang_awal_weekend'] ++;
                                            } else if (MyDate::is_before_12($out['date_time'])) {
                                                $data['pulang_awal_weekday_before_12'] ++;
                                            } else {
                                                $data['pulang_awal_weekday'] ++;
                                            }
                                        } else {
                                            if ($current_date['wday'] == 6) {//hari sabtu
                                                $data['normal_weekend'] ++;
                                            } else {
                                                $data['normal_weekday'] ++;
                                            }
                                        }
                                        $alpha = FALSE;
                                    }
                                }

                                //tidak ada yang ditemukan
                                if ($alpha) {
                                    $data['alpha'] ++;
                                }
                            }
                        }
                    }
                }

                $data['terlambat'] = $terlambat['weekday'] + $terlambat['weekend'];
                $data['lupa'] = $lupa['weekday'] + $lupa['weekend'];
//                $data['tugas_luar'] = $tugas['weekday'] + $tugas['weekend'];
                $data['other'] = $other['weekday'] + $other['weekend'];
                $data['masuk_weekday'] = $data['normal_weekday'] + $data['pulang_awal_weekday_before_12'] + $data['pulang_awal_weekday'] + $terlambat['weekday'] + $lupa['weekday'] + $data['tugas_luar_weekday'] + $other['weekday'];
                $data['masuk_weekend'] = $data['normal_weekend'] + $data['pulang_awal_weekend'] + $terlambat['weekend'] + $lupa['weekend'] + $data['tugas_luar_weekend'] + $other['weekend'];
                $data['tidak_masuk'] = $data['sakit'] + $data['izin'] + $data['alpha'];
                $data['konsumsi_weekday'] = $allowance['weekday'] * ($data['normal_weekday'] + $data['tugas_luar_weekday'] + $other['weekday']);
                $data['konsumsi_weekend'] = $allowance['weekend'] * ($data['normal_weekend'] + $data['tugas_luar_weekend'] + $other['weekend']);
                $data['konsumsi_pulang_awal'] = $allowance['pulang_awal'] * $data['pulang_awal_weekday'];
                $data['konsumsi_total'] = $data['konsumsi_weekday'] + $data['konsumsi_weekend'] + $data['konsumsi_pulang_awal'];
            }
        }
        Session::put($this->id, $data);
        return $data;
    }

    public function getSchedule($weekly_schedules) {
        $schedule = array(); //array jadwal per hari dlm 1 minggu, indeks 1=senin .... 7=minggu
        foreach ($weekly_schedules as $ws) {
            $dailySchedule = $ws->dailySchedule()->first();
            $i = $ws['start_day'];
            if ($i == 7) {
                $i = 0;
            }
            $schedule[$i] = $dailySchedule;
        }
        return $schedule;
    }

    public function getAllowance($weekly_schedules) {
        $allow = $weekly_schedules[0]->allowance()->first();
        $allowance = array('weekday' => $allow->weekday_nominal, 'weekend' => $allow->weekend_nominal,
            'pulang_awal' => ($allow->weekday_nominal - $allow->cut_nominal));
        return $allowance;
    }

    private function getInOut($current_day) {
        $inout = [NULL, NULL];
        if (!$this->auto_check->isEmpty()) {
            $parsed_date = date_parse($this->auto_check[0]['date_time']);
            $inout[0] = $parsed_date['day'] == $current_day && $parsed_date['hour'] < 12 ? $this->auto_check->shift() : NULL;
        }
        if ($inout[0] == NULL) {
            $inout[0] = $this->getManualIn($current_day);
        }
        $temp = NULL;
        while (!$this->auto_check->isEmpty() && date_parse($this->auto_check[0]['date_time'])['day'] <= $current_day) {
            $temp = $this->auto_check->shift();
        }
        $inout[1] = $temp != NULL && ($temp['is_in'] == 0 || date_parse($temp['date_time'])['hour'] > 9) ? $temp : $this->getManualOut($current_day);
        return $inout;
    }

    private function getManualIn($current_day) {
        if ($this->manual_in->isEmpty()) {
            return NULL;
        }
        $in = NULL;
        $parsed_date = date_parse($this->manual_in[0]['date_time']);
        if ($parsed_date['day'] == $current_day) {
            $in = $this->manual_in->shift();
            while (!$this->manual_in->isEmpty() && date_parse($this->manual_in[0]['date_time'])['day'] <= $current_day) {
                $this->manual_in->shift();
            }
        }
        return $in;
    }

    private function getManualOut($current_day) {
        if ($this->manual_out->isEmpty()) {
            return NULL;
        }
        $out = NULL;
        $parsed_date = date_parse($this->manual_out[0]['date_time']);
        if ($parsed_date['day'] == $current_day) {
            do {
                $out = $this->manual_out->shift();
            } while (!$this->manual_out->isEmpty() && date_parse($this->manual_out[0]['date_time'])['day'] <= $current_day);
        }
        return $out;
    }

}
