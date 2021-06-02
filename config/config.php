<?php

class Database{

    // specify your own database credentials
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "w3schools";
    public $conn;

    // get the database connection

    public function getConnection(){

        $this->conn = null;

        try{

            $this->conn = new PDO("mysql:host=" .$this->host. ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");

        }catch(PDOException $exception){

            echo "Database could not be connected : ". $exception->getMessage();

        }

        return $this->conn;

    }


}


?>



 
