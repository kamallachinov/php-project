<?php
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/db/db-connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/utils/response-handler/response-handler.php";

try {
    $sql_query = "SELECT * FROM dashboard_data";
    $result = $conn->query($sql_query);

    if ($result &&  $result->num_rows > 0) {
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        var_dump($data);
        ResponseHandler::SUCCESS_RESPONSE("Found items", $data, 200);
    } else {
        ResponseHandler::ERROR_RESPONSE("No records found", [], 404);
    }
} catch (Exception $e) {
    ResponseHandler::ERROR_RESPONSE("An error occurred: " . $e->getMessage(), [], 500);
}