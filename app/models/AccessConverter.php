<?php

class AccessConverter {

    private $dbh;
    private $last_convert_file = '\Last Convert.txt';
    private $num_data;

    public function __construct() {
        $this->dbh = App::make('AccessDB')->get_dbh();
    }

    public function convert() {
        set_time_limit(0);
        $this->num_data = 0;
        $starts = $this->readFile();
        $starts[0] = $this->user_speday($starts[0]);
        $starts[1] = $this->check_exact($starts[1]);
        $starts[2] = $this->check_inout($starts[2]);
        $starts[3] = $this->holidays($starts[3]);
        $this->updateFile($starts);
        return $this->num_data;
    }

    public function readFile() {
        return explode(';', file_get_contents(public_path() . $this->last_convert_file));
    }

    public function updateFile($starts) {
        $file = fopen(public_path() . $this->last_convert_file, 'w');
        fwrite($file, implode(';', $starts));
        fclose($file);
    }

    public function check_exact($start) {
        $query = new Query('CHECKEXACT', $this->dbh);
        $query->where('EXACTID', '>', $start);
        $query->order('EXACTID');
        $result = $query->get('EXACTID,USERID,CHECKTIME,CHECKTYPE');
        $result_array = [];
        foreach ($result as $row) {
            $result_array[] = [
                'date_time' => $row['CHECKTIME'],
                'is_in' => ($row['CHECKTYPE'] == 'I' ? 1 : 0),
                'employee_id' => $row['USERID']
            ];
        }
        $manual_check = array_chunk($result_array, 1000);
        foreach ($manual_check as $value) {
            ManualCheck::insert($value);
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['EXACTID'] : $start;
    }

    public function check_inout($start) {
        $query = new Query('CHECKINOUT', $this->dbh);
        $end = date('Y-m-01');
        $query->where('CHECKTIME', '>', $start);
        $query->where('CHECKTIME', '<', $end);
        $query->order('CHECKTIME');
        $result = $query->get('USERID,CHECKTIME,CHECKTYPE');
        $result_array = [];
        foreach ($result as $row) {
            $result_array[] = [
                'date_time' => $row['CHECKTIME'],
                'is_in' => ($row['CHECKTYPE'] == 'I' ? 1 : 0),
                'employee_id' => $row['USERID']
            ];
        }
        $auto_check = array_chunk($result_array, 1000);
        foreach ($auto_check as $value) {
            AutoCheck::insert($value);
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $end : $start;
    }

    public function holidays($start) {
        $query = new Query('HOLIDAYS', $this->dbh);
        $query->where('HOLIDAYID', '>', $start);
        $result = $query->get('HOLIDAYID,STARTTIME,DURATION');
        foreach ($result as $row) {
            $start_time = strtotime($row['STARTTIME']);
            $duration = $row['DURATION'] - 1;
            $end_time = strtotime("+$duration days", $start_time);
            Holiday::create(array(
                'id' => $row['HOLIDAYID'],
                'start' => $row['STARTTIME'],
                'duration' => $row['DURATION'],
                'end' => date('Y-m-d H:i:s', $end_time)
            ));
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['HOLIDAYID'] : $start;
    }

    public function user_speday($start) {
        $query = new Query('USER_SPEDAY', $this->dbh);
        $time = strtotime($start);
        $startTime = date('Y-m-d H:i:s', strtotime('+1 seconds', $time));
        $query->where('DATE', '>=', $startTime);
        $query->order('DATE,STARTSPECDAY');
        $result = $query->get();
        $result_array = [];
        foreach ($result as $row) {
            $result_array[] = [
                'start_date' => $row['STARTSPECDAY'],
                'end_date' => $row['ENDSPECDAY'],
                'reason' => (isset($row['YUANYING']) ? $row['YUANYING'] : ''),
                'employee_id' => $row['USERID'],
                'absence_category_id' => $row['DATEID']
            ];
        }
        $absence = array_chunk($result_array, 1000);
        foreach ($absence as $value) {
            Absence::insert($value);
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['DATE'] : $start;
    }

}
