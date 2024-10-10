<?php
include(__DIR__ . "/../../db/db-connection.php");
$currentPath = basename($_SERVER['REQUEST_URI']); 

$stmt = $conn->prepare("SELECT * FROM `navbar-items`");
$stmt->execute();
$result = $stmt->get_result();
?>

<nav class="bg-gray-200 border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-900">Flowbite</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-900 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 ">
                <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <a href="<?= htmlspecialchars($row['path']) ?>"
                        class="block py-2 px-3 <?= (basename($currentPath) == basename($row['path'])) ? 'text-red-700 underline' : 'text-gray-900' ?> bg-transparent rounded md:p-0">
                        <?= htmlspecialchars($row['path_name']) ?>
                    </a>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</nav>