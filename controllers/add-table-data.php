<?php
require "../db/db-connection.php";

$imageUrl = '';
$title = '';
$desc = '';

$errors = [
    'imageUrl' => '',
    'title' => '',
    'desc' => ''
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $imageUrl = $_POST['imageUrl'] ?? '';
    $title = $_POST['title'] ?? '';
    $desc = $_POST['description'] ?? '';

    if (empty($imageUrl)) {
        $errors['imageUrl'] = "Image URL is required";
    }
    if (empty($title)) {
        $errors['title'] = "Title is required";
    }
    if (empty($desc)) {
        $errors['desc'] = "Description is required";
    }

    if (empty($errors['imageUrl']) && empty($errors['title']) && empty($errors['desc'])) {
        $stmt = $conn->prepare("INSERT INTO dashboard_data (imageUrl, title, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $imageUrl, $title, $desc);

        if ($stmt->execute()) {
            $imageUrl = '';
            $title = '';
            $desc = '';
        } else {
            $dbError = "Something went wrong. Please try again later.";
        }

        $stmt->close();
    }
}

?>