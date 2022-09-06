<?php

namespace Models;
use Models\BaseModel;
use PDO;

class User extends BaseModel {

    protected $table = 'users';

    protected $allowedFields = ['username', 'pwd'];

    public function getUser($username, $pass) {
        $sql = "select * from users where username = ? and pwd = ?";
        $result = $this->prepara($sql, [$username, $pass]);
        return $result;
    }
}