<?php

namespace Controllers;
use Models\User;

class Account extends BaseController {

    public function __get($route) {

        $this->$route();

    }

    public function login() {

        if (loggedIn()) {

            return $this->index();

        } else if (isset($_POST['username']) && isset($_POST['pwd'])) {
    
            $username = $this->validate($_POST['username']);
    
            $pwd = $this->validate($_POST['pwd']);
    
            if (model(User::class)->getUser([$username, $pwd])) {

                $_SESSION[session_id()]['user']['username'] = $username;

                return $this->index();

            }

        }

        template('account/login', ['currentPage' => 'login']);

    }

    public function pwdReset() {

        if(isset($_COOKIE['userNewPwd'])){
            
            setcookie('userNewPwd', null, time()+60);

        }
        if (isset($_POST['username']) && isset($_POST['email'])) {
    
            $username = $this->validate($_POST['username']);
    
            $email = $this->validate($_POST['email']);

            if (!model(User::class)->getUserByEmail([$username, $email]) == false) {
    
                pwdReset();
    
            }

        }
            
        template('account/pwd.reset', ['currentPage' => 'pwdReset']);

        if (isset($_COOKIE['userNewPwd'])){
            
            setcookie('userNewPwd', null, time()-60);

        }

    }

    public function newPassword() {

        $codigo = $_POST['code'];

        if ($_COOKIE['temporaryCode'] === $codigo) {

                setcookie('temporaryCode', null, time()-60);

                template('account/new.pwd', ['title' => 'pwdReset']);

        } else if (isset($_POST['pwd1']) && isset($_POST['pwd2'])) {

            $pwd = $this->validate($_POST['pwd1']);

            $newpwd = $this->validate($_POST['pwd2']);

            if ($pwd === $newpwd) {

                $user = $_COOKIE['user'];

                model(User::class)->updatePass([$pwd, $user]);
                
                setcookie('user', null, time()-60);
                
                return $this->login();

            }

        }else{

            template('account/new.pwd', ['title' => 'pwdReset']);

        }


    }

    public function logout() {

            session_unset();

            session_destroy();

            $this->login();

    }

}   