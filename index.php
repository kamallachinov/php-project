<?php

require  __DIR__ .  '/controllers/auth/login.php';


if($isAuthenticated){
    header("Location: ./views/auth/login.view.php");
    require "./views/auth/login.view.php";
}else{
    require "./views/home.view.php";
}
?>