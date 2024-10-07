<?php
 require "../db/db-connection.php";

    if (isset($_POST['submit'])) {
        $imageUrl = $_POST['imageUrl'];
        $title = $_POST['title'];
        $desc = $_POST['description'];

        if ($imageUrl !== "" && $title !== "" && $desc !== "") {

            $stmt = $conn->prepare("INSERT INTO dashboard_data (imageUrl, title, description) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $imageUrl, $title, $desc);

            if ($stmt->execute()) {
                header("Location: ../views/dashboard.view.php");  // Correct path to redirect
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        } else {
            echo "imageUrl, title, and description cannot be empty!";
        }
    } else {
        echo "Failed to connect to the database!";
    }
    $conn->close();

?>
