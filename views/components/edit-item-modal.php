<?php require "../db/db-connection.php";?>

<div id="editModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center ">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4">Edit item</h2>

        <?php if (!empty($dbError)): ?>
        <p class="text-red-600"><?= htmlspecialchars($dbError) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-4">
                <label for="imageUrl" class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="text" id="imageUrl" name="imageUrl" value="<?= htmlspecialchars($imageUrl) ?>"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                <!-- <?php if (!empty($errors['imageUrl'])): ?>
                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['imageUrl']) ?></p>
                <?php endif; ?> -->
            </div>
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($title) ?>"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                <!-- <?php if (!empty($errors['title'])): ?>
                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['title']) ?></p>
                <?php endif; ?> -->
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"><?= htmlspecialchars($desc) ?></textarea>
                <!-- <?php if (!empty($errors['desc'])): ?>
                 <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($errors['desc']) ?></p>
                <?php endif; ?> -->
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeEditModal"
                    class="mr-2 bg-gray-400 px-3 py-2 rounded text-white">Cancel</button>
                <button type="submit" name="submit" class="bg-blue-500 px-3 py-2 rounded text-white">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, imageUrl, title, description) {
    const modal = document.getElementById('editModal');
    const imageUrlField = document.getElementById('imageUrl');
    const titleField = document.getElementById('title');
    const descriptionField = document.getElementById('description');

    imageUrlField.value = imageUrl;
    titleField.value = title;
    descriptionField.value = description;

    modal.classList.remove('hidden');
}

document.getElementById('closeEditModal').addEventListener('click', function() {
    document.getElementById('editModal').classList.add('hidden');
});
</script>