<?php
require "partials/head.php";
require "partials/nav.php";
require "../../php-prj/db/db-connection.php";
?>

<main>
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
    <!-- Edit Item Modal Component -->
    <?php include './components/edit-item-modal.php'; ?>
</main>

<!-- jQuery library (required) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../utils/modal-viewer/modal-viewer.js"></script>
<script>
    const editModalWrapper = document.getElementById('editModal');
    const imageUrlFieldEditModal = document.getElementById('ImageUrlEditModal');

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
                            <button href="#" class="text-blue-400 hover:underline update-btn"  data-id="${row.id}" data-image="${row.imageUrl}" data-title="${row.Title}" data-description="${row.Description}">Edit</button>
                        </td>
                        <td class="px-4 py-2">
                            <a href="#" class="text-red-400 hover:underline delete-btn" data-id="${row.id}">Delete</a>
                        </td>`
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
        if (event.target.classList.contains('update-btn')) {
            const id = event.target.getAttribute('data-id');
            const imageUrl = event.target.getAttribute('data-image');
            const title = event.target.getAttribute('data-title');
            const description = event.target.getAttribute('data-description');

            imageUrlFieldEditModal.value = imageUrl;
            document.getElementById('titleEditModal').value = title;
            document.getElementById('descriptionEditModal').value = description;

            document.getElementById('submit-edit-btn').setAttribute('data-id', id);

            modalViewer('editModal', true);
        }
    });

    document.getElementById("submit-edit-btn").addEventListener("click", function(e) {
        e.preventDefault();

        const id = document.getElementById("submit-edit-btn").getAttribute('data-id');
        const data = {
            id: Number(id),
            imageUrl: imageUrlFieldEditModal.value,
            title: document.getElementById('titleEditModal').value,
            desc: document.getElementById('descriptionEditModal').value
        }

        update_data(data);
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
                alert(data);
                fetchData();
            },
            error: function(error) {
                console.error('Error deleting record:', error);
            }
        })
    }

    function update_data(data) {
        let action = "updateAction";
        $.ajax({
            url: "../controllers/update-table-data.php",
            type: "POST",
            data: {
                id: data.id,
                imageUrl: data.imageUrl,
                title: data.title,
                desc: data.desc,
                action: action,
            },
            success: function(response) {
                alert(response.message);
                fetchData();
                modalViewer("editModal", false)
            },
            error: function(error) {
                console.error('Error updating record:', error);
                alert("An error occurred while updating the record. Please try again.");
                modalViewer("editModal", false)
            }
        });
    }
</script>

<?php require "partials/footer.php" ?>