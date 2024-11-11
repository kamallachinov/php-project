<?php
define('APP_NAME', dirname(__FILE__));

require  __DIR__ .  '/controllers/auth/login.php';

if ($isAuthenticated) {
    header(APP_NAME .  "Location: /views/auth/login.view.php");
    require(APP_NAME . "/views/auth/login.view.php");
} else {
    require APP_NAME . "/views/home.view.php";
}