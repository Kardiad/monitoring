<?php

namespace Models;

class User extends BaseModel {

    protected $table = 'users';

    protected $allowedFields = ['username', 'pwd'];

    public function validUser($username, $pwd) {

        $user = $this->getUser($username, $pwd);

        if (isset($user)) {

            return true;

        }

        return false;

    }

    function getUser($username, $pwd) {
        $sql = "select * from users where username = ? and pwd = ?;";
        $stmt = $this->prepare($sql);
        $stmt->bind_param("ss", $u, $p);
        $u = $username;
        $p = $pwd;
        $stmt->execute();
        $result = $stmt->get_result();

        //$sql = "select * from users where username = '$username' and pwd = '$pwd'";

        //$result = $this->conn->query($sql);

        return $result->fetch_assoc();

    }

/*
    public function getUser($username = null) {

        if (isset($username)) {

            // metodo para devolver un solo username

            $user = $this->select($this->table, $this->allowedFields, ['username' => $username]);

            return $user;

        }

        // metodo para devolver todos los usuarios

    }
*/
}