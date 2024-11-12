<?php
session_start();
require __DIR__ . '/../../db/db-connection.php';
require __DIR__ . "/../../utils/response-handler/response-handler.php";

$responseHandler = new ResponseHandler();
$loginErrors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "loginAction") {

    $username = trim($_POST['username'] ?? "");
    $password = trim($_POST['password'] ?? "");

    if (empty($username)) {
        $loginErrors['username'] = 'Username is required';
    }
    if (empty($password)) {
        $loginErrors['password'] = 'Password is required';
    }

    if (!empty($loginErrors)) {
        echo $responseHandler->ERROR_RESPONSE("Validation errors", $loginErrors, 400);
        exit();
    }

    $sql = "SELECT * FROM `auth-data` WHERE username = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['isAuthenticated'] = true;
                echo $responseHandler->SUCCESS_RESPONSE("Login successful! Welcome, " . htmlspecialchars($user['username']), [], 200);
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username']
                ];
                header('Location:  ../../index.php');
            } else {
                $loginErrors['password'] = "Invalid username or password";
                echo $responseHandler->ERROR_RESPONSE("Validation errors", $loginErrors, 401);
            }
        } else {
            $loginErrors['username'] = "Invalid username or password";
            echo $responseHandler->ERROR_RESPONSE("Validation errors", $loginErrors, 401);
        }
        $stmt->close();
    } else {
        echo $responseHandler->ERROR_RESPONSE("SQL error: " . $conn->error, [], 500);
    }
} else {
    echo $responseHandler->ERROR_RESPONSE("Invalid request method", [], 405);
}