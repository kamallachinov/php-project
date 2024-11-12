<?php

define('APP_NAME', dirname(__FILE__));
header(APP_NAME .  "Location: /views/home.view.php");
require(APP_NAME . "/views/home.view.php");


// $isAuthenticated = $_SESSION['isAuthenticated'] ?? false;

// if ($isAuthenticated) {
//     header(APP_NAME .  "Location: /views/auth/login.view.php");
//     require(APP_NAME . "/views/auth/login.view.php");
// } else {
//     header(APP_NAME .  "Location: /views/home.view.php");
//     require APP_NAME . "/views/home.view.php";
// }