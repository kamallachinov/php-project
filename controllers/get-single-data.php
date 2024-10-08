<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_query = "SELECT * FROM dashboard_data WHERE id = ?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imageUrl = $row['imageUrl'];
        $title = $row['Title'];
        $desc = $row['Description'];
    } else {
        echo "No data found for the specified ID.";
        exit;
    }
} else {
    echo "ID parameter is missing.";
    exit;
}