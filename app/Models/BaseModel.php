<?php

namespace Models;

use mysqli;
use mysqli_sql_exception;

class BaseModel {

    // aqui ira la conexion a la base de datos y el consiguiente control de errores

    private $host = 'localhost';

    private $user = 'root';

    private $pwd = '';

    private $db = 'monitoringtest';

    private $conn;

    /**
     * ---
     * BASE MODEL CONSTRUCT
     * -
     * 
     * Attempts to connect to database through MySQLi
     */
    public function __construct() {

        $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->db);

        if($this->conn->connect_error) {

            die("Connection to database failed: " . $this->conn->connect_error);

        }

    }

    function prepare($sql) {

        return $this->conn->prepare($sql);
        
    }

}