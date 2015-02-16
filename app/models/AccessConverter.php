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
        $starts[0] = $this->check_exact($starts[0]);
        $starts[1] = $this->check_inout($starts[1]);
        $starts[2] = $this->holidays($starts[2]);
        $starts[3] = $this->num_run_deil($starts[3]);
        $starts[4] = $this->schclass($starts[4]);
        $starts[5] = $this->user_of_run($starts[5]);
        $starts[6] = $this->user_speday($starts[6]);
        $starts[7] = $this->userinfo($starts[7]);
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
            Holiday::create([
                'id' => $row['HOLIDAYID'],
                'start' => $row['STARTTIME'],
                'duration' => $row['DURATION'],
                'end' => date('Y-m-d H:i:s', $end_time)
            ]);
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['HOLIDAYID'] : $start;
    }

    public function num_run_deil($start) {
        $query = new Query('NUM_RUN_DEIL', $this->dbh);
        $query->where('NUM_RUNID', '>', $start);
        $query->order('NUM_RUNID');
        $result = $query->get('NUM_RUNID,STARTTIME,ENDTIME,SDAYS,EDAYS,SCHCLASSID');
        foreach ($result as $row) {
            $allowance_id = 0;
            if ($row['SDAYS'] != 6) {
                $end = date_parse($row['ENDTIME']);
                $start = date_parse($row['STARTTIME']);
                $duration = (mktime($end['hour'], $end['minute']) - mktime($start['hour'], $start['minute'])) / 3600;
                if ($duration >= 8) {
                    $allowance_id = 1;
                } else if ($duration < 7) {
                    $allowance_id = 3;
                } else {
                    $allowance_id = 2;
                }
            }
            WeeklySchedule::create([
                'id' => $row['NUM_RUNID'],
                'start_day' => $row['SDAYS'],
                'end_day' => $row['EDAYS'],
                'daily_schedule_id' => $row['SCHCLASSID'],
                'allowance_id' => $allowance_id
            ]);
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['NUM_RUNID'] : $start;
    }

    public function schclass($start) {
        $query = new Query('SCHCLASS', $this->dbh);
        $query->where('SCHCLASSID', '>', $start);
        $query->order('SCHCLASSID');
        $result = $query->get('SCHCLASSID,SCHNAME,STARTTIME,ENDTIME');
        foreach ($result as $row) {
            DailySchedule::create([
                'id' => $row['SCHCLASSID'],
                'name' => $row['SCHNAME'],
                'start_time' => $row['STARTTIME'],
                'end_time' => $row['ENDTIME']
            ]);
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['SCHCLASSID'] : $start;
    }

    public function user_of_run($start) {
        $query = new Query('USER_OF_RUN', $this->dbh);
        $query->where('STARTDATE', '>', $start);
        $query->order('STARTDATE');
        $result = $query->get('STARTDATE,ENDDATE,USERID,NUM_OF_RUN_ID');
        foreach ($result as $row) {
            Schedule::create([
                'start_date' => $row['STARTDATE'],
                'end_date' => $row['ENDDATE'],
                'employee_id' => $row['USERID'],
                'weekly_schedule_id' => $row['NUM_OF_RUN_ID']
            ]);
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['STARTDATE'] : $start;
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

    public function userinfo($start) {
        $query = new Query('USERINFO', $this->dbh);
        $query->where('USERID', '>', $start);
        $query->order('USERID');
        $result = $query->get('USERID,SSN,Name,Gender,BIRTHDAY,street,DEFAULTDEPTID');
        foreach ($result as $row) {
            Employee::create([
                'id' => $row['USERID'],
                'ssn' => $row['SSN'],
                'name' => $row['Name'],
                'is_male' => $row['Gender'] == 'Male' ? 1 : 0,
                'birthday' => $row['BIRTHDAY'],
                'street' => $row['street'],
                'department_id' => $row['DEFAULTDEPTID']
            ]);
        }
        $size = count($result);
        $this->num_data += $size;
        return $size > 0 ? $result[$size - 1]['USERID'] : $start;
    }

}
