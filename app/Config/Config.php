<?php

namespace Config;

/**
 * ---------------------------------------------------------------
 * REQUIRE CONFIG
 * ---------------------------------------------------------------
 */

require_once('Routes.php');

require_once('Paths.php');

/**
 * ---------------------------------------------------------------
 * REQUIRE COMMON
 * ---------------------------------------------------------------
 */

require APPDIR . 'Common.php';

/**
 * ---------------------------------------------------------------
* REQUIRE CONTROLLERS
* ---------------------------------------------------------------
*/

require_once(APPDIR . "Controllers" . DIRECTORY_SEPARATOR . "BaseController.php");
// todos cogen herencia de BaseController asi que tienen que ir detras

require_once(APPDIR . "Controllers" . DIRECTORY_SEPARATOR . "Account.php");

require_once(APPDIR . "Controllers" . DIRECTORY_SEPARATOR . "Monitoring.php");

require_once(APPDIR . "Controllers" . DIRECTORY_SEPARATOR . "Taptab.php");

/**
 * ---------------------------------------------------------------
* REQUIRE MODELS
* ---------------------------------------------------------------
*/

require_once(APPDIR . "Models" . DIRECTORY_SEPARATOR . "BaseModel.php");
// BaseModel tiene que ir el primero porque los demas heredan de el

require_once(APPDIR . "Models" . DIRECTORY_SEPARATOR . "ServerData.php");

require_once(APPDIR . "Models" . DIRECTORY_SEPARATOR . "User.php");