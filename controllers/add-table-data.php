<?php
require "../db/db-connection.php";
require "../utils/response-handler/response-handler.php";

$addErrors = [
    'imageUrl' => '',
    'title' => '',
    'desc' => ''
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === "postAction") {
    $imageUrl = isset($_POST['imageUrlFieldPostModal']) ? trim(htmlspecialchars($_POST['imageUrlFieldPostModal'])) : '';
    $title = isset($_POST['titleFieldPostModal']) ? trim(htmlspecialchars($_POST['titleFieldPostModal'])) : '';
    $desc = isset($_POST['descriptionFieldPostModal']) ? trim(htmlspecialchars($_POST['descriptionFieldPostModal'])) : '';

    $addErrors['imageUrl'] = empty($imageUrl) ? "Image URL field cannot be empty!" : '';
    $addErrors['title'] = empty($title) ? "Title field cannot be empty!" : '';
    $addErrors['desc'] = empty($desc) ? "Description field cannot be empty!" : '';

    if (empty($addErrors['imageUrl']) && empty($addErrors['title']) && empty($addErrors['desc'])) {
        $stmt = $conn->prepare("INSERT INTO dashboard_data (imageUrl, title, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $imageUrl, $title, $desc);

        if ($stmt->execute()) {
            echo  $response = ResponseHandler::SUCCESS_RESPONSE("Posted successfully", [
                'imageUrl' => $imageUrl,
                'title' => $title,
                'description' => $desc
            ]);
            $imageUrl = '';
            $title = '';
            $desc = '';
        } else {
            $dbError = "Something went wrong. Please try again later.";
            echo  ResponseHandler::ERROR_RESPONSE("Error posting data", $dbError, 500);
        }
        $stmt->close();
    } else {
        echo ResponseHandler::ERROR_RESPONSE("Validation errors", $addErrors, 400);
    }
}