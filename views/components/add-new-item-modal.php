<?php
require "../controllers/add-table-data.php";
// require "../utils/modal-viewer/modal-viewer.js";
$showModal = !empty($addErrors['imageUrl']) || !empty($addErrors['title']) || !empty($addErrors['desc']);
?>

<div id="modal"
    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center <?= $showModal ? '' : 'hidden'; ?>">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4">Add New Item</h2>

        <?php if (!empty($dbError)): ?>
        <p class="text-red-600"><?= htmlspecialchars($dbError) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-4">
                <label for="imageUrl" class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="text" id="imageUrl" name="imageUrl" value="<?= htmlspecialchars($imageUrl) ?>"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                <?php if (!empty($addErrors['imageUrl'])): ?>
                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($addErrors['imageUrl']) ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($title) ?>"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                <?php if (!empty($addErrors['title'])): ?>
                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($addErrors['title']) ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"><?= htmlspecialchars($desc) ?></textarea>
                <?php if (!empty($addErrors['desc'])): ?>
                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($addErrors['desc']) ?></p>
                <?php endif; ?>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeModal"
                    class="mr-2 bg-gray-400 px-3 py-2 rounded text-white">Cancel</button>
                <button type="submit" name="post-data-submit"
                    class="bg-blue-500 px-3 py-2 rounded text-white">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="../utils/modal-viewer/modal-viewer.js"></script>
<script>
document.getElementById('openModal')?.addEventListener('click', () => modalViewer('modal', true));
document.getElementById('closeModal')?.addEventListener('click', () => modalViewer('modal', false));
</script>