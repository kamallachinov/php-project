<?php
require "../db/db-connection.php";

$imageUrl = '';
$title = '';
$desc = '';

$editErrors = [
    'imageUrl' => '',
    'title' => '',
    'desc' => ''
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submitEditModal']) && $_POST['action'] === "updateRecord") {

    $imageUrl = isset($_POST['imageUrl']) ? trim(htmlspecialchars($_POST['imageUrl'])) : '';
    $title = isset($_POST['title']) ? trim(htmlspecialchars($_POST['title'])) : '';
    $desc = isset($_POST['desc']) ? trim(htmlspecialchars($_POST['desc'])) : '';

    $editErrors['imageUrl'] = empty($imageUrl) ? "Image URL field cannot be empty!" : '';
    $editErrors['title'] = empty($title) ? "Title field cannot be empty!" : '';
    $editErrors['desc'] = empty($desc) ? "Description field cannot be empty!" : '';

    if (empty($editErrors['imageUrl']) && empty($editErrors['title']) && empty($editErrors['desc'])) {

        $id = $_POST['id']; 
        $sql = "UPDATE dashboard_data SET imageUrl = ?, Title = ?, Description = ? WHERE id = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("sssi", $imageUrl, $title, $desc, $id);

            if ($stmt->execute()) {
                echo "Record updated successfully!";
            } else {
                echo "Error updating record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing update statement: " . $conn->error;
        }
    } else {
        foreach ($editErrors as $field => $error) {
            if (!empty($error)) {
                echo $error . "<br>";
            }
        }
    }
} else {
    echo "Invalid request.";
}
?>