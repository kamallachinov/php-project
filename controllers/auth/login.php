<?php
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
    error_log(print_r($_POST, true));
    if (empty($loginErrors['username']) && empty($loginErrors['password'])) {

        $sql = "SELECT * FROM `auth-data` WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();

                if ($password == $user['password']) {
                    $isAuthenticated = true;
                    $response['message'] = "Login successful! Welcome, " . htmlspecialchars($user['username']);
                } else {
                    $loginErrors['password'] = "Invalid password";
                }
            } else {
                $response['message'] = "Invalid username or password";
            }
            $stmt->close();
        } else {
            $response['message'] = "SQL error: " . $conn->error;
        }
        $response['errors'] = $loginErrors;
    }

    if (!empty($loginErrors['username']) || !empty($loginErrors['password'])) {
        $response['errors'] = $loginErrors;
    } else {
        $response['errors'] = [];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}








