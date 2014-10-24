<?php

class AccessDB {

    private $dbh;

    public function __construct() {
        try {
            $this->dbh = new PDO('odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=' . public_path() . '\att2000.mdb');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage() . "\n";
        }
    }

    public function get_dbh() {
        return $this->dbh;
    }

}
