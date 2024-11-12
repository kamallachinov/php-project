<?php
require "../db/db-connection.php";
require "../utils/response-handler/response-handler.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "dltRecord") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM `dashboard_data` WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo  $response = ResponseHandler::SUCCESS_RESPONSE("Record deleted successfully.", [], 200);
        } else {
            echo  $response = ResponseHandler::ERROR_RESPONSE("Error deleting record: " . $conn->error, [], 404);
        }
    } else {
        echo  $response = ResponseHandler::ERROR_RESPONSE("ID not provided.", [], 404);
    }
}
$conn->close();