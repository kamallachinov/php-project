<?php

$pageTitle = "Detailed page";
require_once "../../db/db-connection.php";

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
?>

<?php   require "../partials/nav.php"?>
<?php   require "../partials/head.php"?>

<div class="container mx-auto my-8 p-4 bg-white rounded-lg shadow">
    <img class="rounded-lg w-full object-cover h-64" src="<?php echo htmlspecialchars($imageUrl); ?>" alt="<?php echo htmlspecialchars($title); ?>" />

    <h1 class="mt-4 text-3xl font-bold text-gray-900"><?php echo htmlspecialchars($title); ?></h1>

    <p class="mt-2 text-gray-700"><?php echo nl2br(htmlspecialchars($desc)); ?></p>

    <a href="../../ " class="mt-4 inline-block px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
        Back to Home
    </a>
</div>

<?php   require "../partials/footer.php"?>
