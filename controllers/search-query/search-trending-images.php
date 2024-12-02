<?php
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/db/db-connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/utils/response-handler/response-handler.php";

try {
    $searchQuery = isset($_GET['query']) ? "%" . $_GET['query'] . "%" : '%';
    $pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 3;
    $pageNumber = isset($_GET['pageNumber']) ? (int)$_GET['pageNumber'] : 1;

    // Validate input
    $pageSize = max(1, $pageSize);
    $pageNumber = max(1, $pageNumber);

    // Calculate the starting index for the current page
    $startIndex = ($pageNumber - 1) * $pageSize;

    // Get total data count for the search query
    $totalCountQuery = "SELECT COUNT(*) AS total FROM dashboard_data WHERE Title LIKE ?";
    $stmt = $conn->prepare($totalCountQuery);
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("s", $searchQuery);
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute statement: " . $stmt->error);
    }

    $totalCountResult = $stmt->get_result();
    $totalDataCountRow = $totalCountResult->fetch_assoc();
    $totalDataCount = intval($totalDataCountRow['total']);

    // Calculate total pages
    $pageCount = ceil($totalDataCount / $pageSize);

    // Fetch paginated data for the search query
    $dataQuery = "SELECT * FROM dashboard_data WHERE Title LIKE ? LIMIT ?, ?";
    $stmt = $conn->prepare($dataQuery);
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("sii", $searchQuery, $startIndex, $pageSize);
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute statement: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $paginatedData = $result->fetch_all(MYSQLI_ASSOC);

    $response = [
        "totalDataCount" => $totalDataCount,
        "pageCount" => $pageCount,
        "paginatedData" => $paginatedData,
    ];

    echo ResponseHandler::SUCCESS_RESPONSE("Found items", $response, 200);
} catch (Exception $e) {
    echo ResponseHandler::ERROR_RESPONSE("Error fetching items: " . $e->getMessage(), 500);
}
