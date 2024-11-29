<?php
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/db/db-connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/utils/response-handler/response-handler.php";

$sql = "SELECT * FROM dashboard_data";
$result = $conn->query($sql);

$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    ResponseHandler::SUCCESS_RESPONSE("Found items", $data, 200);
} else {
    ResponseHandler::ERROR_RESPONSE("No items found", [], 404);
}

$conn->close();
