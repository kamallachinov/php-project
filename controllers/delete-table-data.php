<?php 
require "../db/db-connection.php";

$method = $_SERVER['REQUEST_METHOD'];
$id =  mysqli_real_escape_string($conn, $_GET["id"]);

if( $method === "DELETE"){
    $sql_delete_query = "DELETE FROM `dashboard_data` WHERE `id` = $id";
    
    if (mysqli_query($conn, $sql_delete_query)) {
        echo "Record deleted successfully";
        header('Location: "http://localhost/php-prj/views/dashboard.view.php"');
        exit;
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    $conn->close();
}

?>