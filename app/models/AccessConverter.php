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
        foreach ($result as $row) {
            ManualCheck::create(array(
                'date_time' => $row['CHECKTIME'],
                'is_in' => ($row['CHECKTYPE'] == 'I' ? 1 : 0),
                'employee_id' => $row['USERID']
            ));
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['EXACTID'] : $start;
    }

    public function check_inout($start) {
        $query = new Query('CHECKINOUT', $this->dbh);
        $query->where('CHECKTIME', '>', $start);
        $query->order('CHECKTIME');
        $result = $query->get('USERID,CHECKTIME,CHECKTYPE');
        foreach ($result as $row) {
            AutoCheck::create(array(
                'date_time' => $row['CHECKTIME'],
                'is_in' => ($row['CHECKTYPE'] == 'I' ? 1 : 0),
                'employee_id' => $row['USERID']
            ));
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['CHECKTIME'] : $start;
    }

    public function user_speday($start) {
        $query = new Query('USER_SPEDAY', $this->dbh);
        $query->where('DATE', '>', $start);
        $query->order('DATE');
        $result = $query->get();
        foreach ($result as $row) {
            Absence::create(array(
                'start_date' => $row['STARTSPECDAY'],
                'end_date' => $row['ENDSPECDAY'],
                'reason' => (isset($row['YUANYING']) ? $row['YUANYING'] : ''),
                'employee_id' => $row['USERID'],
                'absence_category_id' => $row['DATEID']
            ));
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['DATE'] : $start;
    }

}
