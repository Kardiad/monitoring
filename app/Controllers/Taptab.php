<?php

namespace Controllers;

class Taptab extends BaseController {

    public function __construct($route) {

        $this->$route();
        
    }

    public function taptab() {

        $data = [
            'currentPage' => 'taptab'
        ];

        template('main.content/taptab', $data);

    }

}