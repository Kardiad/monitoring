<?php

namespace Models;

use PDO;

class BaseModel {

    // aqui ira la conexion a la base de datos y el consiguiente control de errores

    private $host = 'localhost';

    private $user = 'root';

    private $pwd = '';

    private $db = 'monitoringtest';

    protected $conn;

    /**
     * ---
     * BASE MODEL CONSTRUCT
     * -
     * 
     * Attempts to connect to database through PDO
     */
    public function __construct() {

        try{
            $this->conn = new PDO('mysql:dbname='.$this->db.';host:'.$this->host, $this->user, $this->pwd);
        }catch(PDOException $e){
            die("Connection to database failed: " . $e->getMessage());

        }

    }

    /**
     * --
     * FUNCION PARA LANZAR CONSULTAS PRECONSTRUIDAS
     * -
     * 
     * Esta funcion lo que hace es coger una consulta y con un array
     * de params que son string te devuelve el resultado
    */
    function prepara($sql, $params) {
         $stmt = $this->conn->prepare($sql);
         $stmt->execute($params);
         return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}