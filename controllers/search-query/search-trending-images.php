<?php
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/db/db-connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/utils/response-handler/response-handler.php";

try {
    $searchQuery = isset($_GET['query']) ? "%" . $_GET['query'] . "%" : '%';

    $sql_query = "SELECT * FROM dashboard_data WHERE Title LIKE ?";
    $stmt = $conn->prepare($sql_query);
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("s", $searchQuery);
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute statement: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if (!$result) {
        throw new Exception("Failed to fetch results: " . $stmt->error);
    }

    $images = [];
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }

    if (empty($images)) {
        echo ResponseHandler::SUCCESS_RESPONSE("No results found.", [], 200);
    } else {
        echo ResponseHandler::SUCCESS_RESPONSE("Found items", $images, 200);
    }
} catch (Exception $e) {
    echo ResponseHandler::ERROR_RESPONSE("Error fetching items: " . $e->getMessage(), 500);
}
