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

    /**
     * ---
     * Get Connection
     * -
     * 
     * Returns current database connection
     * 
     * @return \mysqli 
     */
    public function getConn() {

        return $this->conn;

    }

    /**
     * ---
     * SELECT FROM DATABASE
     * -
     * 
     * Returns an array with the results from a SELECT query.
     * Returns all rows from a table if $table is the only parameter given.
     * Fields and conditions will be set in the query if not null. Bools 
     * $and and $like will modify these conditions
     * 
     * @param string $table
     * @param ?array $fields
     * @param ?array|null $conditions
     * @param bool $and
     */
    public function select(string $table, array $fields = null, array $conditions = null, bool $and = true, bool $like = false) {

        if (isset($fields) && is_array($fields)) {

            $sql = "select" . $this->selectFields($fields) . " from $table";
    
            if(isset($conditions) && is_array($conditions)) {
    
                $sql .= " where" . $this->selectConditions($conditions, $and, $like);
    
            }

        } else {

            $sql = "select * from $table limit 10";

        }

        try {
            
            return $this->queryResults($sql);

        } catch (mysqli_sql_exception $e) {

            echo "Ocurrio una excepcion en un SELECT de la funcion select() del BaseModel:\n" . $e->getMessage();

        }

    }

    /**
     * ---
     * RESULTS FROM QUERY
     * -
     * 
     * Returns null if the connection fails, or an array with the query
     * results if it's successfull.
     * 
     * @param mixed $sql
     * 
     * @return array
     */
    public function queryResults($sql): array {

        $array = [];

        if ($result = $this->conn->query($sql)) {

            if ($result->num_rows > 0) {
    
                while($row = $result->fetch_assoc()) {

                    $array[$row['username']] = $row;
    
                }

                return $array;
    
            }

        }

        return null;

    }

    /**
     * ---
     * QUERY FIELDS INTO STRING
     * -
     * 
     * From an array of fields received it will separate it to make
     * a string and return this string. In case of not receiving an
     * array it will return an empty string
     * 
     * @param array $fields
     * 
     * @return string
     */
    public function selectFields(array $fields) {

        if (isset($fields) && is_array($fields)) {

            $sql = "";
            
            $flength = count($fields);

            for ($i = 0; $i < $flength; $i++) {

                if ($i == $flength - 1) {

                    $sql .= " " . $fields[$i];

                } else {

                    $sql .= " " . $fields[$i] . ",";

                }

            }

            return $sql;
        
        }

        return "";

    }

    /**
     * ---
     * QUERY CONDITIONS INTO STRING
     * -
     * Receiving an array with the conditions it will set the part of sql conditions
     * and return it as a string.
     * 
     * @param array $conditions
     * @param bool $and
     * @param bool $like
     * 
     * @return string
     */
    public function selectConditions(array $conditions, bool $and = true, bool $like = false) {

        $sql = "";

        $keys = array_keys($conditions);

        for ($i = 0; $i < count($conditions); $i++) {

            if ($like === false) {

                $sql .= " " . $keys[$i] . " = '" . $conditions[$keys[$i]] . "'";

            } else {

                $sql .= " " . $keys[$i] . " like %'" . $conditions[$keys[$i]] . "%'";

            }

            if ($i < count($conditions) - 1 && $and === true) {

                $sql .= " and";

            } else if ($i < count($conditions) - 1 && $and === false) {

                $sql .= " or";

            }

        }

        return $sql;

    }

}