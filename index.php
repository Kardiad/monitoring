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

$now = time();

if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}

// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 3600;

// start app
$routes = new Config\Routes;

//var_dump($_GET);
//var_dump($_SESSION);

$url = array_keys($_GET)[0] ?? 'monitoring';

$routes->$url;

