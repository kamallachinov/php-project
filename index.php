<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('config.php');
require_once(APP_DIR . '/db/db-connection.php');

require_once(APP_DIR . '/controllers/Controller.php');

$controller = ucfirst($_GET['controller'] ?? 'Home');

$controllerPath = APP_DIR . '/controllers/' . $controller . '.php';

if (file_exists($controllerPath)) {
    require_once($controllerPath);
} else {
    require_once(APP_DIR . '/controllers/NotFound.php');
}


//require_once(APP_DIR . "/views/home.view.php");

//header(APP_NAME .  "Location: /views/home.view.php");


// $isAuthenticated = $_SESSION['isAuthenticated'] ?? false;

// if ($isAuthenticated) {
//     header(APP_NAME .  "Location: /views/auth/login.view.php");
//     require(APP_NAME . "/views/auth/login.view.php");
// } else {
//     header(APP_NAME .  "Location: /views/home.view.php");
//     require APP_NAME . "/views/home.view.php";
// }