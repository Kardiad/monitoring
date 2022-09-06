<?php

namespace Models;

class User extends BaseModel {

    protected $table = 'user';

    protected $allowedFields = ['usuario', 'pwd'];

    public function __construct() {

        $this->conn->connectDB();

    }

    public function validUser($username, $pwd) {

        $user = $this->getUser($username);

        if (isset($user) && $user['pwd'] === $pwd) {

            return true;

        }

        return false;

    }

    public function getUser($username = null) {

        if ($username!=null) {

            // metodo para devolver un solo username

            $user = $this->select($this->table, $username);

            return $user;

        }

        // metodo para devolver todos los usuarios

    }

}