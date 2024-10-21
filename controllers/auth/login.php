<?php
session_start();  
require __DIR__ . '/../../db/db-connection.php';

$isAuthenticated = false;
$loginErrors = [];
$response = ['message' => '', 'errors' => $loginErrors];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "loginAction") {

    $username = trim($_POST['username'] ?? "");
    $password = trim($_POST['password'] ?? "");

    if (empty($username)) {
        $loginErrors['username'] = 'Username is required';
    }
    if (empty($password)) {
        $loginErrors['password'] = 'Password is required';
    }

    if (empty($loginErrors['username']) && empty($loginErrors['password'])) {

        $sql = "SELECT * FROM `auth-data` WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            print_r($stmt);

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();

                if ($password == $user['password']) {
                    $isAuthenticated = true;
                    $_SESSION['message'] = "Login successful! Welcome, " . htmlspecialchars($user['username']);
                    header('Location: ../../views/dashboard.view.php'); 
                    exit();
                } else {
                    $loginErrors['password'] = "Invalid username or password";
                }
            } else {
                $loginErrors['username'] = "Invalid username or password";
            }
            $stmt->close();
        } else {
            $_SESSION['message'] = "SQL error: " . $conn->error;
        }
    }

    $_SESSION['loginErrors'] = $loginErrors;
    $_SESSION['oldInputs'] = ['username' => $username];
    
    header('Location: ../../views/auth/login.view.php');
    exit();
}