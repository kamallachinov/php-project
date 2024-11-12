<?php
$pageTitle = "Detailed page";
require "../../db/db-connection.php";
require "../../controllers/get-single-data.php";
require "../partials/nav.php";
require "../partials/head.php";
?>


<div class="container mx-auto my-8 p-4 bg-white rounded-lg shadow">
    <img class="rounded-lg w-full object-cover h-64" src="<?php echo htmlspecialchars($imageUrl); ?>"
        alt="<?php echo htmlspecialchars($title); ?>" />

    <h1 class="mt-4 text-3xl font-bold text-gray-900"><?php echo htmlspecialchars($title); ?></h1>

    <p class="mt-2 text-gray-700"><?php echo nl2br(htmlspecialchars($desc)); ?></p>

    <a href="../../ "
        class="mt-4 inline-block px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
        Back to Home
    </a>
</div>

<?php require "../partials/footer.php"; ?>