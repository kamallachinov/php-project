<?php

require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/db/db-connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/utils/response-handler/response-handler.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // $query = "UPDATE `auth-data`  "






}
