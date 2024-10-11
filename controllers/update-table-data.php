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
$response = ['message' => '', 'errors' => $editErrors];

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === "updateAction") {

    $imageUrl = isset($_POST['imageUrl']) ? trim(htmlspecialchars($_POST['imageUrl'])) : '';
    $title = isset($_POST['title']) ? trim(htmlspecialchars($_POST['title'])) : '';
    $desc = isset($_POST['desc']) ? trim(htmlspecialchars($_POST['desc'])) : '';

    $editErrors['imageUrl'] = empty($imageUrl) ? "Image URL field cannot be empty!" : '';
    $editErrors['title'] = empty($title) ? "Title field cannot be empty!" : '';
    $editErrors['desc'] = empty($desc) ? "Description field cannot be empty!" : '';

    if (empty($editErrors['imageUrl']) && empty($editErrors['title']) && empty($editErrors['desc'])) {
        $id = $_POST['id']; 
        $sql = "UPDATE `dashboard_data` SET `imageUrl` = ?, `Title` = ?, `Description` = ? WHERE `id` = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("sssi", $imageUrl, $title, $desc, $id);

            if ($stmt->execute()) {
                $response['message'] = "Record was successfully updated!";
            } else {
                $response['message'] = "Error updating record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $response['message'] = "Error preparing update statement: " . $conn->error;
        }
    } else {
        $response['errors'] = $editErrors;
        $response['message'] = "Validation errors occurred.";
    }
    
    header('Content-Type: application/json');
    echo json_encode($response); 
} else {
    // header('Content-Type: application/json'); 
    echo json_encode(['message' => 'Invalid request method.']); 
}