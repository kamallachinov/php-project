<?php
require "../db/db-connection.php";

$imageUrl = '';
$title = '';
$desc = '';

$addErrors = [
    'imageUrl' => '',
    'title' => '',
    'desc' => ''
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post-data-submit'])) {
    $imageUrl = $_POST['imageUrl'] ?? '';
    $title = $_POST['title'] ?? '';
    $desc = $_POST['description'] ?? '';

    if (empty($imageUrl)) {
        $addErrors['imageUrl'] = "Image URL is required";
    }
    if (empty($title)) {
        $addErrors['title'] = "Title is required";
    }
    if (empty($desc)) {
        $addErrors['desc'] = "Description is required";
    }

    if (empty($addErrors['imageUrl']) && empty($addErrors['title']) && empty($addErrors['desc'])) {
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