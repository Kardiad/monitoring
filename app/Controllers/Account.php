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

    public function pwdReset(){

        if(isset($_POST['username']) && $_POST['email']){

            $username = $this->validate($_POST['username']);

            $email = $this->validate($_POST['email']);

            if(!empty(model(User::class)->getUserByEmail([$username, $email]))){

                pwdResetMail();

                $_SESSION['enviado'] = 0;

                template('account/pwd.reset', ['currentPage' => 'pwdReset']);

            }else{

                template('account/pwd.reset', ['currentPage' => 'pwdReset']);

            }

        }else{

            template('account/pwd.reset', ['currentPage' => 'pwdReset']);

        }

    }


    public function newPassword(){

        if($_SESSION['enviado']==0 || !isset($_SESSION['enviado'])){

            $_SESSION['enviado']=1;
            
            $_SESSION['codigo']=$_GET['code'];
    
            $_SESSION['email']=$_GET['email'];

            template('account/pwd.reset', ['currentPage' => 'pwdReset']);
        }

        if(isset($_POST['confCode'])){

            if($_SESSION['codigo']==$_POST['confCode']){

                $_SESSION['enviado']=2;


                template('account/pwd.reset', ['currentPage' => 'pwdReset']);

            }else{

                if($_SESSION['email']==null && $_SESSION['codigo']==null){

                    $_SESSION['enviado']=404;

                    template('account/pwd.reset', ['currentPage' => 'pwdReset']);

                }else{

                    unset($_SESSION['email']);
    
                    unset($_SESSION['codigo']);
    
                    unset($_SESSION['enviado']);

                    template('account/pwd.reset', ['currentPage' => 'pwdReset']);
                    
                }

            }

        }else{

            if(isset($_POST['pwd1']) && $_POST['pwd2']){

                if($_POST['pwd1']==$_POST['pwd2']){
    
                    model(User::class)->updatePass([$_POST['pwd1'], $_SESSION['email']]);
    
                    unset($_SESSION['email']);
    
                    unset($_SESSION['codigo']);
    
                    unset($_SESSION['enviado']);
    
                    template('account/login', ['currentPage' => 'login']);
    
                }

            } else{

                template('account/pwd.reset', ['currentPage' => 'pwdReset']);

            }

        }

    }

    /*public function pwdReset() {

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


    }*/

    public function logout() {

            session_unset();

            session_destroy();

            $this->login();

    }

}   