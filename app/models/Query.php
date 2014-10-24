<?php

class Query {

    private $dbh;

    /**
     * @access private
     * @var String $table
     */
    private $table;

    /**
     * @access private
     * @var Array $where
     */
    private $where = array();

    /**
     * @access private
     * @var int $limit
     */
    private $limit;

    /**
     * Bindings for where sql statement
     * @access private
     * @var Array $bindings
     */
    private $bindings = array();
    private $order;

    /**
     * Constructor
     * @access public
     * @param String $table
     */
    public function __construct($table, $dbh) {
        $this->table = $table;
        $this->dbh = $dbh;
    }

    /**
     * Adding an element in the where array with the value
     * to the bindings
     * @access public
     * @param String $key
     * @param String $oper
     * @param String $value
     * @return void
     */
    public function where($key, $oper, $value) {
        $this->where[] = "AND $key $oper ?";
        $this->bindings[] = $value;
    }

    /**
     * Adding an element in the where array with the value
     * to the bindings
     * @access public
     * @param String $key
     * @param String $oper
     * @param String $value
     * @return void
     */
    public function or_where($key, $oper, $value) {
        $this->where[] = "OR $key $oper ?";
        $this->bindings[] = $value;
    }

    /**
     * Setting the limit value
     * @access public
     * @param String $key
     * @param String $oper
     * @param String $value
     * @return void
     */
    public function limit($limit = 10) {
        $this->limit = $limit;
    }

    public function order($order) {
        $this->order = $order;
    }

    /**
     * Getting PDOStatement for this query
     * @access public
     * @param String $columns
     * @return Array of mixed depend on fetch mode
     */
    public function get($columns = "*", $fetch_mode = PDO::FETCH_ASSOC, $class_name = '') {
        $sql = "SELECT" . $this->getLimit() . "$columns FROM $this->table " . $this->getWhere() . $this->getOrder();
        // Prepare to be executed
        $sth = $this->dbh->prepare($sql);
        // Set fetch mode
        if ($fetch_mode == PDO::FETCH_CLASS)
            $sth->setFetchMode($fetch_mode, $class_name);
        else
            $sth->setFetchMode($fetch_mode);
        // Bind parameters
        for ($i = 1; $i <= count($this->bindings); $i ++) {
            $sth->bindParam($i, $this->bindings[$i - 1]);
        }
        // Execute the sql statement
        $sth->execute();
        // return all fetched
        return $sth->fetchAll();
    }

    /**
     * Get where statement
     * @access private
     * @return String
     */
    private function getWhere() {
        // If where is empty return empty string
        if (empty($this->where))
            return '';
        // Implode where pecices then remove the first AND or OR
        return ' WHERE ' . ltrim(implode(" ", $this->where), "ANDOR");
    }

    /**
     * Get Limit statement
     * @access private
     * @return String
     */
    private function getLimit() {
        if (isset($this->limit))
            return " TOP $this->limit ";
        return ' ';
    }

    public function getOrder() {
        if (isset($this->order))
            return " ORDER BY $this->order";
        return '';
    }

}
