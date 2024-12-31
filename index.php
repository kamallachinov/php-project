<?php

define('APP_NAME', dirname(__FILE__));
require(APP_NAME . "/views/home.view.php");
header(APP_NAME .  "Location: /views/home.view.php");