<?php

require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/db/db-connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/utils/response-handler/response-handler.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_password = $_POST['newPassword'];
    $confirm_new_password = $_POST['confirmPassword'];
    $token = $_GET['token'];

    if (empty($new_password) || empty($confirm_new_password)) {
        ResponseHandler::ERROR_RESPONSE("Password fields cannot be empty.", [], 400);
    }
    if ($new_password !== $confirm_new_password) {
        ResponseHandler::ERROR_RESPONSE("Passwords do not match.", [], 400);
    }

    $stmt = $conn->prepare("SELECT email, reset_token_expiry FROM `auth-data` WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        ResponseHandler::ERROR_RESPONSE("Invalid or expired token.", [], 400);
    }

    $user = $result->fetch_assoc();
    $email = $user['email'];
    $token_expiry = $user['reset_token_expiry'];

    if (time() > $token_expiry) {
        ResponseHandler::ERROR_RESPONSE("Token has expired.", [], 400);
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE `auth-data` SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        ResponseHandler::SUCCESS_RESPONSE("Password has been reset successfully.", [], 200);
    } else {
        ResponseHandler::ERROR_RESPONSE("Failed to reset password. Please try again later.", [], 500);
    }
} else {
    ResponseHandler::ERROR_RESPONSE("Invalid request method.", [], 405);
}
