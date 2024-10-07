<?php require "partials/head.php" ?>
<?php require "partials/nav.php" ?>
<?php require "../../php-prj/db/db-connection.php" ?>

<?php
// 1) Created the table
$sql = "CREATE TABLE IF NOT EXISTS dashboard_data (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    imageUrl VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
)";

    if (mysqli_query($conn, $sql)) {
//        echo "Table 'dashboard_data' created successfully.<br>";
    } else {
//        echo "Error creating table: " . mysqli_error($conn);
    }

    ?>

<main class="">


<!--    --><?php
//    // 3): Fetch and display the data
//    $fetch_sql = "SELECT * FROM dashboard_data";
//    $result = mysqli_query($conn, $fetch_sql);
//
//    if (mysqli_num_rows($result) > 0) {
//        echo "<table class='table-auto border-collapse border border-gray-400 w-full'>";
//        echo "<thead><tr><th class='border px-4 py-2'>Image URL</th><th class='border px-4 py-2'>Password</th><th class='border px-4 py-2'>Role</th></tr></thead>";
//        echo "<tbody>";
//
//        while ($row = mysqli_fetch_assoc($result)) {
//            echo "<tr>";
//            echo "<td class='border px-4 py-2'>" . $row['imageUrl'] . "</td>";
//            echo "<td class='border px-4 py-2'>" . $row['password'] . "</td>";
//            echo "<td class='border px-4 py-2'>" . $row['role'] . "</td>";
//            echo "</tr>";
//        }
//
//        echo "</tbody>";
//        echo "</table>";
//    } else {
//        echo "No data available.";
//    }
//    mysqli_close($conn);
//    ?>

    <section class="dashboard-section my-12">
        <h2 class="text-center text-xl font-bold mb-3 underline">Hello. Welcome to the dashboard page!</h2>

        <div class="container mx-auto px-4">
            <button id="openModal" class="bg-green-400 px-2 py-2 rounded text-slate-50 mb-2">Add new item</button>

            <!-- modal component -->
            <?php include './components/add-new-item-modal.php'; ?>

            <table class="min-w-full table-auto bg-gray-800 text-white">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Image URL</th>
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Edit</th>
                    <th class="px-4 py-2 text-left">Delete</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                <?php
                $fetch_sql = "SELECT * FROM dashboard_data";
                if ($result = $conn->query($fetch_sql)) {
                    while ($row = $result->fetch_assoc()) {
                        $imageUrl = $row['imageUrl'];
                        $title = $row['Title'];
                        $desc = $row['Description'];
                        $id = $row['id'];
                        ?>
                        <tr class="bg-gray-900 hover:bg-gray-700">
                            <td class="px-4 py-2"><?php echo $imageUrl; ?></td>
                            <td class="px-4 py-2"><?php echo $title; ?></td>
                            <td class="px-4 py-2"><?php echo $desc; ?></td>
                            <td class="px-4 py-2">
                                <a href="updatedata.php?id=<?php echo $id; ?>" class="text-blue-400 hover:underline">Edit</a>
                            </td>
                            <td class="px-4 py-2">
                                <a href="deletedata.php?id=<?php echo $id; ?>" class="text-red-400 hover:underline">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>

</main>

<?php require "partials/footer.php" ?>
