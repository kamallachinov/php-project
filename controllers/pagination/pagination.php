<?php
require_once('../../config.php');
// print(APP_DIR);
require_once(APP_DIR . '/db/db-connection.php');
require_once(APP_DIR . '/utils/response-handler/response-handler.php');

// Get page size and page number from the query string
$pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 3;
$pageNumber = isset($_GET['pageNumber']) ? (int)$_GET['pageNumber'] : 1;

// Validate input
$pageSize = max(1, $pageSize);
$pageNumber = max(1, $pageNumber);

// Calculate the starting index for the current page
$startIndex = ($pageNumber - 1) * $pageSize;

// Get total data count
$totalDataCountQuery = "SELECT COUNT(*) AS total FROM dashboard_data";
$totalDataResult = $connection->query($totalDataCountQuery);
$totalDataCountRow = $totalDataResult->fetch_assoc();
$totalDataCount = intval($totalDataCountRow['total']);

// Calculate total pages
$pageCount = ceil($totalDataCount / $pageSize);

// Fetch paginated data from the database
$dataQuery = "SELECT * FROM dashboard_data LIMIT ?, ?";
$stmt = $conn->prepare($dataQuery);
$stmt->bind_param("ii", $startIndex, $pageSize);
$stmt->execute();
$result = $stmt->get_result();
$paginatedData = $result->fetch_all(MYSQLI_ASSOC);

$response = [
    "totalDataCount" => $totalDataCount,
    "pageCount" => $pageCount,
    "paginatedData" => $paginatedData
];

echo ResponseHandler::SUCCESS_RESPONSE("Success", $response, 200);