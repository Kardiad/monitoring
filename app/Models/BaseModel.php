<?php

namespace Models;

use PDO;
use PDOException;

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
     * @param sql : string
     * @param parms: array de strings para binding
     * @return resultado en vector asociativo
    */
    public function prepare($sql, $params) {

        $stmt = $this->conn->prepare($sql);

        for ($x = 0; $x < count($params); $x++) {

            $stmt->bindParam($x+1, $params[$x], $this->tipo($params[$x]));

        }

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    private function tipo($param) {

        switch (gettype($param)) {

            case "string":
                return PDO::PARAM_STR;

            case "integer":
                return PDO::PARAM_INT;

            //Esto es escalable, de momento meto estas

        }

    }

    /**
     * --
     * FUNCION PARA CONSTRUIR CONSULTAS
     * -
     * 
     * Esta funcion te va a permitir crear consultas automáticamente según params
     */

    public function sqlea($params, $tablaInicio, $paramsCondiciones, $paramsJoins, $tipo) {

        $sql = "";

        switch ($tipo) {

            case "select":
                if (empty($params)) {
                    $sql.="SELECT *";
                } else {
                    $sql .= "SELECT";
                    for ($x = 0; $x < count($params); $x++) {
                        if ($x == 0) {
                            $sql.=" " . $params[$x] . " ";
                        } else {
                            $sql.=" , " . $params[$x] . " ";
                        }
                    }
                }
                $sql.=" FROM ".$tablaInicio;
        
                if (!empty($paramsJoins)) {
                    for($x = 0; $x < count($paramsJoins); $x++){
                        $sql.=" JOIN ".$paramsJoins[$x][0]." ON ".$paramsJoins[$x][1]." = ".$paramsJoins[$x][2]."_".str_replace('.id', '', $paramsJoins[$x][1])." ";
                    }
                }
                if(!empty($paramsCondiciones)) {
                    $sql.=" WHERE ".$paramsCondiciones;
                }
                return $sql;

            case "update":
                if(!empty($params)){
                    $sql.=" UPDATE $tablaInicio SET";
                    for($x=0; $x<count($params); $x++){                    
                        if($x==0){
                            $sql.= " ".$params[$x]." = ? ";
                        }else{
                            $sql.= " , ".$params[$x]." = ? ";
                        }                    
                    }
                    if(!empty($paramsCondiciones)){
                        $sql.= " WHERE ".$paramsCondiciones;
                    }
                }
                return $sql;

            case "insert":
                if(!empty($params) && !empty($tablaInicio)){
                    $sql.="INSERT INTO ".$tablaInicio." ( ";
                    for($x=0; $x<count($params); $x++){
                        if($x==0){
                            $sql.=" ".$params[$x]." ";
                        }else{
                            $sql.=" , ".$params[$x]." ";
                        }
                    }
                    $sql.=" ) VALUES (";
                    for($x=0; $x<count($params); $x++){
                        if($x==0){
                            $sql.=" ? ";
                        }else{
                            $sql.=" , ? ";
                        }
                    }
                    $sql.=" ); ";
                }
                return $sql;

            case "delete":
                if(!empty($tablaInicio) && !empty($paramsCondiciones)){
                    $sql.="DELETE FROM ".$tablaInicio." WHERE ".$paramsCondiciones;
                }
                return $sql;

        }
        
    }

}