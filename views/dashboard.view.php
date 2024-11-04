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

            <!-- Add New Item Modal component -->
            <?php include './components/add-new-item-modal.php'; ?>

            <div class="overflow-y-auto overflow-x-hidden max-h-[400px]">
                <table class="min-w-full table-auto bg-gray-800 text-white  ">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Image URL</th>
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Description</th>
                            <th class="px-4 py-2 text-left">Edit</th>
                            <th class="px-4 py-2 text-left">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700 max-h-[500px] overflow-y-scroll" style="height: 50px;">

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Edit Item Modal Component -->
    <?php include './components/edit-item-modal.php'; ?>
</main>

<!--Footer Component -->
<?php require "partials/footer.php" ?>

<!-- Modal Viewer -->
<script src="../../php-prj/utils/modal-viewer/modal-viewer.js"></script>

<!--Form error handler -->
<script src="../../php-prj/utils/form-error-handler/form-error-handler.js"></script>

<script>
const editModalWrapper = document.getElementById('editModal');
const imageUrlFieldEditModal = document.getElementById('imageUrlEditModal');

const updateItemFields = [{
        id: "imageUrlEditModal",
        label: "Image URL"
    },
    {
        id: "titleEditModal",
        label: "Title"
    },
    {
        id: "descEditModal",
        label: "Description"
    }
];

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
        document.getElementById('descEditModal').value = description;

        document.getElementById('submit-edit-btn').setAttribute('data-id', id);

        modalViewer('editModal', true);
    }


    if (event.target.classList.contains('delete-btn')) {
        const id = event.target.getAttribute('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "Think twice before deletion",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteData(id);
            }
        });

    }
});

document.getElementById("submit-edit-btn").addEventListener("click", function(e) {
    e.preventDefault();
    const isValid = validateFormFields(updateItemFields);
    const id = document.getElementById("submit-edit-btn").getAttribute('data-id');

    if (isValid) {
        const data = {
            id: Number(id),
            imageUrl: imageUrlFieldEditModal.value.trim(),
            title: document.getElementById('titleEditModal').value.trim(),
            desc: document.getElementById('descEditModal').value.trim()
        }
        update_data(data);
    } else {
        toastr.error("Please fill in all fields.");
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
            toastr.success(data);

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
            toastr.success(response.message);
            fetchData();
            resetForm(postNewItemFields);
            modalViewer("editModal", false);
        },
        error: function(error) {
            if (error.responseJSON) {
                toastr.error(error.responseJSON.error) || "An unexpected error occurred.";
                const errors = error.responseJSON.errorData || {};
                formErrorHandler(errors, data.submitButtonId);
            } else {
                toastr.error("An unexpected error occurred.");
            }
            modalViewer("editModal", true);
        }
    });
}
</script>