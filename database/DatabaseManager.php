<?php

/**
 * Created by PhpStorm.
 * User: jssan
 * Date: 11/12/2018
 * Time: 10:35
 */

class DatabaseManager {

    protected $conn;
    private $host;
    private $password;
    private $database;
    private $user;

    /**
     * DatabaseManager constructor.
     * @param string $host doisdadsadas
     * @param string $database
     * @param string $user
     * @param string $password
     */
    public function __construct($host = "localhost", $database = "aw2", $user = "root", $password = "") {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
    }

    public function executeUpdate(mysqli_stmt $stmt) {

        if ($this->conn->error) {
            $time = date("d/m/y h:m:s", time());
            self::log("Execute-update({$time}):\n ");
            self::log($this->conn->error . '\n');
        }
    }

    public function executeQuery($q) {
        $result = $this->conn->query($q);
        if (!$result) {
            $time = date("d/m/y h:m:s", time());
            self::log("Execute-query({$time}):\n ");
            self::log($this->conn->error . '\n');
            return 0;
        } else return $result;
    }

    public static function log($str) {
        file_put_contents('database.log', $str, FILE_APPEND);
    }

}