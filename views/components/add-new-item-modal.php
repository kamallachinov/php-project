<div id="modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4">Add New Item</h2>
        <form method="POST" action="/php-prj/controllers/add-table-data.php">
            <div class="mb-4">
                <label for="imageUrl" class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="text" id="imageUrl" name="imageUrl" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeModal" class="mr-2 bg-gray-400 px-3 py-2 rounded text-white">Cancel</button>
                <button type="submit" name="submit" class="bg-blue-500 px-3 py-2 rounded text-white">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('modal');
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');

    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
</script>
