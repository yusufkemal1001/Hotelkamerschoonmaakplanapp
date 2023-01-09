<?php
session_start();
class Dbh {
    public $host = "localhost";
    public $user = "root";
    public $pwd = "root";
    public $dbName = "Hotelkamerschoonmaakplanapp";
    public $conn;

    public function __construct(){
        $this->conn= mysqli_connect($this->host,$this->user,$this->pwd,$this->dbName );
    }
}