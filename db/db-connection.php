<?php
$hostName = "localhost";
$userName = "root";
$password = "";
$dbName = "e-commerce-test";
$conn = new mysqli($hostName, $userName, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>