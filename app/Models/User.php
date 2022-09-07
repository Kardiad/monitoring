<?php

namespace Models;

use Models\BaseModel;

class User extends BaseModel {

    protected $table = 'users';

    protected $allowedFields = ['username', 'pwd'];

    public function getUser($params) {

        $sql = $this->sqlea([], $this->table, " username =  ? AND pwd = ? ;", [], "select");

        return $this->prepare($sql, $params);

    }

    public function getUserByEmail($params){

        $sql = $this->sqlea([], $this->table, "username = ? AND email = ?;", [], "select");

        return $this->prepare($sql, $params);
    }


    public function updatePass($params){

        $sql = $this->sqlea(["pwd"], $this->table, " username = ? ", [], "update");

        return $this->prepare($sql, $params);
    }

}