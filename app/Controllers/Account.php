<?php

namespace Controllers;



class Account extends BaseController {

    public function __get($route) {

        $this->$route();

    }

    public function login() {

        if (isset($_GET['username']) && isset($_GET['pwd'])) {

            $username = $this->validate(get('username'));
    
            $pwd = $this->validate(get('pwd'));
    
            $model = model(User::class);
    
            if ($model->validUser($username, $pwd)) {

                echo 'asdasd';

                $_SESSION[session_id()]['username'] = $username;

            }

        }

        template('account/login', ['currentPage' => 'login']);

    }

    public function loginCheck() {


    }

}