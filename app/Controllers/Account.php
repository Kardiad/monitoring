<?php

namespace Controllers;
use Models\User;


class Account extends BaseController {

    public function __get($route) {

        $this->$route();

    }

    public function login() {

        if (loggedIn()) {
            
            template('page-main-content/monitoring', ['currentPage' => 'monitoring']);

        } else {

            if (isset($_POST['username']) && isset($_POST['pwd'])) {
    
                $username = $this->validate($_POST['username']);
        
                $pwd = $this->validate($_POST['pwd']);
        
                $modelUser = new User();

                $user = $modelUser->getUser($username, $pwd);
        
                if (!empty($user)) {
    
                    $_SESSION[session_id()]['username'] = $username;
            
                    template('page-main-content/monitoring', ['currentPage' => 'monitoring']);
    
                }
    
            } else {
    
                template('account/login', ['currentPage' => 'login']);
    
            }

        }

    }

    public function logout() {

            session_unset();

            session_destroy();

            $this->login();

    }

}