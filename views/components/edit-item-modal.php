<?php
require "../db/db-connection.php";

?>
<div id="editModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden ">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4">Edit item</h2>

        <?php if (!empty($dbError)): ?>
            <p class="text-red-600"><?= htmlspecialchars($dbError) ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-4">
                <label for="imageUrl" class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="text" id="imageUrlEditModal" name="imageUrl"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="titleEditModal" name="title" value="<?= htmlspecialchars($title) ?>"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="descEditModal" name="desc" rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"><?= htmlspecialchars($desc) ?></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeEditModal"
                    class="mr-2 bg-gray-400 px-3 py-2 rounded text-white">Cancel</button>
                <button type="submit" id="submit-edit-btn" name="submitEditModal"
                    class="bg-blue-500 px-3 py-2 rounded text-white cursor-pointer">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="../utils/modal-viewer/modal-viewer.js"></script>
<script>
    document.getElementById('closeEditModal')?.addEventListener('click', () => {
        modalViewer('editModal', false)
    });
</script>