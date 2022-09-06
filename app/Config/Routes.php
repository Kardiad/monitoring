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
                new Account('login');
                break;

            case 'logout':
                new Account('logout');
                break;

            case 'monitoring':
                new Monitoring('monitoring');
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