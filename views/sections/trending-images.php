<?php
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/db/db-connection.php";


$sql_query = "SELECT * FROM dashboard_data";

if ($result = $conn->query($sql_query)) {
    echo '<div class="wrapper py-8 container mx-auto flex justify-center items-start flex-wrap gap-4">';

    while ($row = $result->fetch_assoc()) {
        $imageUrl = $row['imageUrl'];
        $title = $row['Title'];
        $desc = $row['Description'];
        $id = $row['id'];
?>

<div
    class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 min-w-[400px] min-h-[430px]">
    <a href="#">
        <img class="rounded-t-lg w-full object-cover h-[220px]" src="<?php echo $imageUrl; ?>" alt="" />
    </a>
    <div class="p-5">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                <?php echo $title; ?>
            </h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            <?php echo $desc; ?>
        </p>
        <a href="./views/components/detailed-data.php?id=<?php echo $id; ?>"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Read more
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a>
    </div>
</div>

<?php
    }
    echo '</div>';
} else {
    echo "No records found.";
}
?>