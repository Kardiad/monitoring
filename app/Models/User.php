<?php

namespace Models;

use Models\BaseModel;

class User extends BaseModel {

    protected $table = 'users';

    protected $allowedFields = ['username', 'pwd'];

    public function getUser($username, $pass) {

        $sql = $this->sqlea([], $this->table, " username =  ? AND pwd = ? ;", [], "select");

        return $this->prepare($sql, [$username, $pass]);

    }

}