<?php

namespace Controllers;

class BaseController {

    public function __construct($route) {

        $this->$route();
        
    }

    /**
     * ---
     * Default INDEX
     * -
     * Esta sera la llamada por defecto. Si el usuario esta loggeado ya lo redirigira
     * a la pagina de monitoring, y si no, a la de loggeo.
     */
    public function index() {

        if (loggedIn()) {

            new Monitoring('monitoring');

        }

        new Account('login');

    }

    public function validate($request) {

            $r = trim($request);

            $r = htmlspecialchars($r);

        return $request;

    }

}