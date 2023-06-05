<?php

namespace app\database;

use mysqli;

class connection{
    private $hostName = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'scandiweb_task';
    protected $con;

    public function __construct()
    {
        $this->con = new mysqli($this->hostName,$this->username,$this->password,$this->database);
        
        // if($this->con->connect_error){
        //     die('connect faild :' . $this->con->connect_error);
        // }
        // echo "connection successfully";
    }

    public function runDML($query) :bool {
        $result = $this->con->query($query);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function runDQL($query){
        $result = $this->con->query($query);
        return $result;
         
    }

    public function __destruct()
    {
        $this->con->close();
    }
}

