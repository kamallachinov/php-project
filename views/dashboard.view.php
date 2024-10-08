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

    <section class="dashboard-section my-12">
        <h2 class="text-center text-xl font-bold mb-3 underline">Hello. Welcome to the dashboard page!</h2>

        <div class="container mx-auto px-4">
            <button id="openModal" class="bg-green-400 px-2 py-2 rounded text-slate-50 mb-2">Add new item</button>

            <!-- modal component -->
            <?php include './components/add-new-item-modal.php'; ?>

            <table class="min-w-full table-auto bg-gray-800 text-white max-h-[500px]">
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

                </tbody>
            </table>
        </div>
    </section>

</main>

<!-- jQuery library (required) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
function fetchData() {
    $.ajax({
        url: "../controllers/get-data.php",
        type: "GET",
        success: function(data) {
            let tableBody = document.querySelector('table tbody');
            tableBody.innerHTML = '';

            let rows = JSON.parse(data);

            rows.forEach(row => {
                let tr = document.createElement('tr');
                tr.className = "bg-gray-900 hover:bg-gray-700";
                tr.innerHTML = `
                    <td class="px-4 py-2">${row.imageUrl}</td>
                    <td class="px-4 py-2">${row.Title}</td>
                    <td class="px-4 py-2">${row.Description}</td>
                    <td class="px-4 py-2">
                        <a href="#" class="text-blue-400 hover:underline update-btn" data-id="${row.id}" data-image="${row.imageUrl}" data-title="${row.title}" data-description="${row.description}">Edit</a>
                    </td>
                    <td class="px-4 py-2">
                        <a href="#" class="text-red-400 hover:underline delete-btn" data-id="${row.id}">Delete</a>
                    </td>`;
                tableBody.appendChild(tr);
            });
        },
        error: function(error) {
            console.error('There was a problem:', error);
        }
    });
}
fetchData();
document.querySelector('table').addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-btn')) {
        const id = event.target.getAttribute('data-id');
        deleteData(id);
        fetchData();
    }
});

function deleteData(id) {
    let action = "dltRecord";
    $.ajax({
        url: "../controllers/delete-table-data.php",
        type: "POST",
        data: {
            action: action,
            id: id
        },
        success: function(data) {
            alert(data)
        },
        error: function(error) {
            console.error('Error deleting record:', error);
        }
    })
}
</script>

<?php require "partials/footer.php" ?>