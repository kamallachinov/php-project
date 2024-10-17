<?php
    $isAuth = false;
if(!$isAuth){
    header("Location: ./views/auth/login.view.php");
    require "./views/auth/login.view.php";
}else{
    require "./views/home.view.php";
}
?>


