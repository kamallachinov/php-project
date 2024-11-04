    <?php
    require "../../db/db-connection.php";
    require "../../utils/response-handler/response-handler.php";


    $responseHandler = new ResponseHandler();
    $registerErrors = [];

    if (!isset($_POST["action"]) == "register") {
        echo $responseHandler->ERROR_RESPONSE("Register action not set", [], 400);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == "register") {
        $username = trim($_POST['username']) ?? "";
        $email = trim($_POST['email']) ?? "";
        $password = trim($_POST['password']) ?? "";
        $confirm_password = trim($_POST['confirm_password']) ?? "";

        if (empty($username)) $registerErrors['username'] = 'Username is required';
        if (empty($email)) $registerErrors['email'] = 'Email is required';
        if (empty($password)) $registerErrors['password'] = 'Password is required';
        if (empty($confirm_password)) $registerErrors['confirm_password'] = "Confirm password is required";
        else if ($password !== $confirm_password) $registerErrors['confirm_password'] = "Passwords did not match.";

        if (empty($registerErrors)) {
            $checkEmailStmt = $conn->prepare("SELECT id FROM `auth-data` WHERE email = ?");
            $checkEmailStmt->bind_param("s", $email);

            if ($checkEmailStmt->execute()) {
                $checkEmailStmt->bind_result($id);

                if ($checkEmailStmt->fetch()) {
                    $registerErrors['email'] = "Email is already registered.";
                }
            } else {
                echo $responseHandler->ERROR_RESPONSE("Error executing query: " . $conn->error, [], 500);
            }

            $checkEmailStmt->close();
        }

        if (empty($registerErrors)) {
            $sql = $conn->prepare("INSERT INTO `auth-data` (username, email, password) VALUES (?, ?, ?)");
            $sql->bind_param("sss", $username, $email, $password);

            if ($sql->execute()) {
                echo $responseHandler->SUCCESS_RESPONSE("Registered successfully", [], 201);
                header("Location: ../../views/dashboard.view.php");
            } else {
                echo $responseHandler->ERROR_RESPONSE("Error registering data", [], 500);
            }
            $sql->close();
        } else {
            echo $responseHandler->ERROR_RESPONSE("Validation errors", $registerErrors, 400);
        }
    } else {
        echo $responseHandler->ERROR_RESPONSE("Invalid request method", [], 405);
    }