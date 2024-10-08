<?php 
require "../db/db-connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "dltRecord") {
  if (isset($_POST['id'])) {
      $id = $_POST['id'];
      $sql = "DELETE FROM `dashboard_data` WHERE `id` = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      if ($stmt->affected_rows > 0) {
          echo "Record deleted successfully.";
      } else {
          echo "Error deleting record: " . $conn->error;
      }
  } else {
      echo "ID not provided.";
  }
}

$conn->close();
?>