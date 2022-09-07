<?php

namespace Config;

use \Controllers\Account;
use \Controllers\BaseController;
use \Controllers\Monitoring;
use \Controllers\Taptab;

class Routes {

    public function __get($route) {
        
        switch($route) {

            case 'login':
            case 'logout':
            case 'pwdReset':
            case 'newPassword':
                new Account($route);
                break;

            case 'monitoring':
                new Monitoring($route);
                break;

            case 'taptab':
                new Taptab($route);
                break;

            default:
                new BaseController('index');
                break;

        }

    }

}