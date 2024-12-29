<?php
$currentPath = basename($_SERVER['REQUEST_URI']);
?>

<nav class="bg-gray-200 border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Kamal Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-900">kamal</span>
        </a>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4    md:flex-row md:space-x-8  ">
                <?php foreach($navbarItems as $item): ?>
                <li>
                    <a href="<?= $item['path'] ?>"
                        class="
                            <?= (basename($currentPath) == basename($item['path'])) ? 'text-red-700 underline' : 'text-gray-900' ?>
                            block py-2 px-3 bg-transparent rounded md:p-0
                        "
                    >
                        <?= $item['path_name'] ?>
                    </a>
                </li>
                <?php endforeach; ?>
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
        url: "/php-prj/controllers/auth/logout.php",
        type: "POST",
        success: function() {
            window.location.href = "/php-prj/views/auth/login.view.php";
        },
        error: function() {
            console.error("Error occured!")
        }
    })
}
</script>