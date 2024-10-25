<?php
session_start();
require "../db/db-connection.php";
require "../utils/response-handler/response-handler.php";
$responseHandler = new ResponseHandler();

$editErrors = [
    'imageUrl' => '',
    'title' => '',
    'desc' => ''
];

$id = $_POST['id'];
$newImageUrl = $_POST['imageUrl'];
$newTitle = $_POST['title'];
$newDesc = $_POST['desc'];
$postAction = $_POST['action'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === "updateAction") {

    $editErrors['imageUrl'] = empty($newImageUrl) ? "Image URL field cannot be empty!" : null;
    $editErrors['title'] = empty($newTitle) ? "Title field cannot be empty!" : null;
    $editErrors['desc'] = empty($newDesc) ? "Description field cannot be empty!" : null;

    $sql_query = "SELECT * FROM `dashboard_data` WHERE `id` = ? ";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentImageUrl = $row['imageUrl'];
        $currentTitle = $row['Title'];
        $currentDescription = $row['Description'];

        if (
            $newImageUrl === $currentImageUrl &&
            $newTitle === $currentTitle &&
            $newDesc === $currentDescription
        ) {
            echo $responseHandler->ERROR_RESPONSE("No changes detected. Nothing to update.");
        } else {
            $update_query = "UPDATE dashboard_data SET imageUrl = ?, Title = ?, Description = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("sssi", $newImageUrl, $newTitle, $newDesc, $id);

            if (!empty($newImageUrl) && !empty($newDesc) && !empty($newTitle)) {
                if ($update_stmt->execute()) {
                    echo $responseHandler->SUCCESS_RESPONSE("Record updated successfully.", [
                        'imageUrl' => $newImageUrl,
                        'title' => $newTitle,
                        'description' => $newDesc
                    ]);
                } else {
                    echo $responseHandler->ERROR_RESPONSE("An error occurred while updating the record.");
                }
            } else {
                $_SESSION['editValidationErrors'] = $editErrors;
                echo $responseHandler->ERROR_RESPONSE("Validation errors occurred.", $editErrors);
            }
        }
    } else {
        echo $responseHandler->ERROR_RESPONSE("No record found for the specified ID.");
    }
} else {
    echo $responseHandler->ERROR_RESPONSE("Invalid request method or action.");
}
