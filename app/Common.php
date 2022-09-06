<?php

if (! function_exists('view')) {
    /**
     * ---------------------------------------------------------------
     * GET A VIEW
     * ---------------------------------------------------------------
     * First parameter will be the page to include. Second parameter,
     * if not null, will be saved in global $_SESSION data
     */
    function view($view, array $data = null) {

        if (isset($data) && is_array($data)) {

            foreach ($data as $k => $v) {

                $_SESSION[$k] = $v;

            }

        }

        $page = VIEWDIR . $view . '.php';

        if (is_file($page)) {

            include $page;

        }

    }

}

if (! function_exists('template')) {
    /**
     * ---------------------------------------------------------------
     * DEFAULT TEMPLATE FOR VIEWS
     * ---------------------------------------------------------------
     * First parameter will be treated as a page view and included
     * widh the header and footer view using global view() function.
     * The second parameter wether is null or not will be passed to
     * the first view() function
     * 
     * @param string $view
     * @param array $data
     */
    function template($view, array $data = null) {

        view('templates/header', $data);

        view($view, $data);

        view('templates/footer');
    
    }

}

if (! function_exists('model')) {
    /**
     * ---------------------------------------------------------------
     * CREATE MODEL OBJECT
     * ---------------------------------------------------------------
     * 
     * Creates a model object with the parameter given.
     * 
     * This method expects you type the classname of the model like:
     * 'ModelName::class', separating the elements in an array by the 
     * char '\' and creating then a string starting with the models
     * namespace followed by the last element of the array.
     * 
     * Would be better to just receive the single name of the Model
     * like: 'ModelName' ? Yes. Am I going to change it? Nope.
     * 
     * @param string $model
     * 
     * @return instance
     * 
     * @template object of Model
     */
    function model($model) {

        $class = explode('\\', $model);

        $model = "\\Models" . "\\" . end($class);

        return new $model;

    }

}

if (! function_exists('get')) {
    /**
     * ---------------------------------------------------------------
     * GET GLOBAL PARAMETERS
     * ---------------------------------------------------------------
     * 
     * Returns value of param given from $_GET global or null if it's 
     * not set.
     * 
     * @param string $param
     * 
     * @return null|mixed
     */
    function get($param) {
    
        if (isset($_GET[$param])) {
    
            return $_GET[$param];
    
        }
    
        return null;
    
    }

}

if (! function_exists('esc')) {
    /**
     * ---
     * Get a parameter from session
     * -
     * Returns the value of param given from $_SESSION global. Returns
     * null if the param is not set.
     * 
     * @param string $param
     * 
     * @return null|mixed
     */
    function esc($param) {

        if (isset($_SESSION[$param])) {

            return $_SESSION[$param];

        }

        return null;
        
    }
}

if (! function_exists('loggedIn')) {

    function loggedIn() {

        if (empty($_SESSION[session_id()]['username'])) {
    
            return true;
        
        }

        return false;

    }

}