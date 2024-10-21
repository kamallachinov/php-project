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
                <li>
                    <form action="" method="POST">
                        <button class="btn btn-danger" id="logoutBtn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- jQuery library (required) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
document.getElementById("logoutBtn").addEventListener("click", (e) => {
    e.preventDefault();
    logout();
})


function logout() {
    $.ajax({
        url: "../../php-prj/controllers/auth/logout.php",
        type: "POST",
        success: function() {
            console.log("User logged out sucessfully!");
            window.location.href = "/php-prj/views/auth/login.view.php";
        },
        error: function() {
            console.error("Error occured!")
        }
    })
}
</script>