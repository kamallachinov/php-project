<?php
require "../db/db-connection.php";
require "../utils/response-handler/response-handler.php";
$responseHandler = new ResponseHandler();

$editErrors = [
    'imageUrl' => '',
    'title' => '',
    'desc' => ''
];

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
            $stmt->bind_param("sssi", $imageUrl, $title, $desc, $id);

            if ($stmt->execute()) {
                echo $responseHandler->SUCCESS_RESPONSE("Record was successfully updated!", [
                    'imageUrl' => $imageUrl,
                    'title' => $title,
                    'description' => $desc
                ]);
            } else {
                echo $responseHandler->ERROR_RESPONSE("Error updating record.", $stmt->error);
            }

            $stmt->close();
        } else {
            echo $responseHandler->ERROR_RESPONSE("Error preparing update statement.", $conn->error);
        }
    } else {
        echo $responseHandler->ERROR_RESPONSE("Validation errors occurred.", $editErrors);
    }
} else {
    echo ("Invalid request method or action.");
}
