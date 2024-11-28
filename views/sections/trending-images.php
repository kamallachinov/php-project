<?php
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/db/db-connection.php";
$sql_query = "SELECT * FROM dashboard_data";
$result = $conn->query($sql_query);


if ($result && $result->num_rows > 0) {
    echo '<div class="wrapper py-8 container mx-auto flex justify-center items-start flex-wrap gap-4" id="trendingImages">';
    while ($row = $result->fetch_assoc()) {
        $imageUrl = $row['imageUrl'];
        $title = $row['Title'];
        $desc = $row['Description'];
        $id = $row['id'];
        include $_SERVER['DOCUMENT_ROOT'] . "/php-prj/components/card/trending-image-card.php";
    }
    echo '</div>';
} else {
    echo "No records found.";
}
