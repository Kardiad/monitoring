<?php

/**
 * ---------------------------------------------------------------
 * PUBLIC DIRECTORY NAME
 * ---------------------------------------------------------------
 * @var string
 */
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

/**
 * ---------------------------------------------------------------
 * APP DIRECTORY NAME
 * ---------------------------------------------------------------
 *
 * @var string
 */
define('APPDIR', __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR);

require_once(APPDIR . 'Config/Config.php');

// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600);

session_start();

// start app
$routes = new Config\Routes;

//var_dump($_GET);
//var_dump($_SESSION);

$url = array_keys($_GET)[0] ?? 'index';

$routes->$url;

