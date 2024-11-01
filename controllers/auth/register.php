<?php
require "../../db/db-connection.php";
require "../../utils/response-handler/response-handler.php";

$responseHandler = new ResponseHandler();

$registerErrors = [];

if (isset($_POST["register"]) && $_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == "register") {
    $username = trim($_POST['username']) ?? "";
    $email = trim($_POST['email']) ?? "";
    $password = trim($_POST['password']) ?? "";
    $confirm_password = trim($_POST['confirm_password']) ?? "";

    if (empty($username)) {
        $registerErrors['username'] = 'Username is required';
    }
    if (empty($email)) {
        $registerErrors['email'] = 'Email is required';
    }
    if (empty($password)) {
        $registerErrors['password'] = 'Password is required';
    }
    if (empty($confirm_password)) {
        $registerErrors['confirm_password'] = 'Confirm password is required';
    }

    if (empty($registerErrors)) {
        $sql = $conn->prepare("INSERT INTO `auth-data` (username, email, password, confirm_password) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $username, $email, $password, $confirm_password);

        if ($sql->execute()) {
            echo $responseHandler->SUCCESS_RESPONSE("Registered successfully", [], 201);
        } else {
            echo   $responseHandler->ERROR_RESPONSE("Error registering data", [], 500);
        }
        $sql->close();
    } else {
        echo $responseHandler->ERROR_RESPONSE("Validation errors", $registerErrors, 400);
    }
}