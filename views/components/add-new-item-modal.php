<?php
require "../controllers/add-table-data.php";
$showModal = !empty($addErrors['imageUrl']) || !empty($addErrors['title']) || !empty($addErrors['desc']);
?>

<div id="postNewItemModal"
    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center <?= $showModal ? '' : 'hidden'; ?>">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4">Add New Item</h2>

        <?php if (!empty($dbError)): ?>
        <p class="text-red-600"><?= htmlspecialchars($dbError) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-4">
                <label for="imageUrl" class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="text" id="imageUrlPostModal" name="imageUrlFieldPostModal"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">

            </div>
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="titlePostModal" name="titleFieldPostModal"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">

            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="descPostModal" name="descriptionFieldPostModal" rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"></textarea>

            </div>
            <div class="flex justify-end">
                <button type="button" id="closeModal"
                    class="mr-2 bg-gray-400 px-3 py-2 rounded text-white">Cancel</button>
                <button type="submit" name="post-data-submit" class="bg-blue-500 px-3 py-2 rounded text-white"
                    id="add-new-item-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- jQuery library (required) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Toastify -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<!-- Modal Viewer -->
<script src="../../php-prj/utils/modal-viewer/modal-viewer.js"></script>

<!--Form error handler -->
<script src="../../php-prj/utils/form-error-handler/form-error-handler.js"></script>

<script>
const addItemBtn = document.getElementById("add-new-item-btn");
const imageUrlInput = document.getElementById("imageUrlPostModal");
const titleInput = document.getElementById("titlePostModal");
const descInput = document.getElementById("descPostModal");


addItemBtn.addEventListener("click", (e) => {
    e.preventDefault();
    const data = {
        imageUrl: imageUrlInput.value ?? "",
        title: titleInput.value ?? "",
        desc: descInput.value ?? ""
    };

    // if (!data.imageUrl || !data.title || !data.desc) {
    //     toastr.error("All fields are required.")
    //     return;
    // }

    postData(data);
})

function postData(data) {
    let action = "postAction";

    $.ajax({
        url: "../controllers/add-table-data.php",
        type: "POST",
        data: {
            action: action,
            imageUrlFieldPostModal: data.imageUrl,
            titleFieldPostModal: data.title,
            descriptionFieldPostModal: data.desc
        },
        success: function(response) {
            if (typeof response === "string") {
                response = JSON.parse(response);
            }
            clearForm();
            if (response.message) {
                toastr.success(response.message)
            }

            fetchData();
            modalViewer("postNewItemModal", false);
        },
        error: function(error) {
            if (error.responseJSON) {
                toastr.error(error.responseJSON.error);
                const errors = error.responseJSON.errorData || {};
                formErrorHandler(errors, "add-new-item-btn", "PostModal");
            } else {
                toastr.error("An unexpected error occurred.");
            }
            modalViewer("postNewItemModal", true);
        }
    })
}

function clearForm() {
    imageUrlInput.value = '';
    titleInput.value = '';
    descInput.value = '';
}

document.getElementById('openModal')?.addEventListener('click', () => modalViewer('postNewItemModal', true));
document.getElementById('closeModal')?.addEventListener('click', () => {
    modalViewer('postNewItemModal', false);
    clearForm();
    clearErrorMessages();
});
</script>