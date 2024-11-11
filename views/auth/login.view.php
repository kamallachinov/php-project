<?php
session_start();
$pageTitle = "Login page";
require "../partials/head.php";

$loginErrors = $_SESSION['loginErrors'] ?? [];
$oldInputs = $_SESSION['oldInputs'] ?? [];
$flashMessage = $_SESSION['message'] ?? '';

unset($_SESSION['loginErrors'], $_SESSION['oldInputs'], $_SESSION['message']);
?>

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-900 text-center mb-6">Login to Your Account</h1>

        <?php if (!empty($flashMessage)): ?>
        <div class="alert alert-primary " role="alert">
            <p class="text-success"><?= htmlspecialchars($flashMessage)  ?></p>
        </div>
        <?php endif; ?>

        <form method="POST" action="../../controllers/auth/login.php">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="usernameLogin" name="username" autofocus="autofocus" autocomplete="off"
                    autocorrect="off" autocapitalize="off" spellcheck="false"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 "
                    value="<?= htmlspecialchars($oldInputs['username'] ?? '') ?>">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="passwordLogin" name="password" autocomplete="off" autocorrect="off"
                    autocapitalize="off" spellcheck="false"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <input type="hidden" name="action" value="loginAction">
            <button type="submit" id="loginBtn"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">Login</button>
        </form>

        <p class="text-sm text-gray-600 mt-4 text-center">Don't have an account? <a href="../auth/register.view.php"
                class="text-blue-500 hover:underline">Sign Up</a></p>
    </div>
</div>


<!-- jQuery library (required) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<!-- TOASTR SCRIPTS & SWEET ALERT-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--Form error handler -->
<script src="../../utils/form-error-handler/form-error-handler.js"></script>

<script>
const loginItemFields = [{
        id: "usernameLogin",
        label: "Username"
    },
    {
        id: "passwordLogin",
        label: "Password"
    },
];

document.getElementById("loginBtn").addEventListener("click", (e) => {
    e.preventDefault();
    const isValid = validateFormFields(loginItemFields);

    if (isValid) {
        const data = {
            username: document.getElementById("usernameLogin").value.trim(),
            password: document.getElementById("passwordLogin").value.trim(),
        };
        login(data);
    } else {
        alert("Please fill in all fields.");
    }

})

function login(data) {
    const action = "loginAction"
    $.ajax({
        url: "../../controllers/auth/login.php",
        type: "POST",
        data: {
            username: data.username,
            password: data.password,
            action: action,
        },
        success: function(response) {
            toastr.success(response.message)
            resetForm(loginItemFields);
        },
        error: function(error) {
            if (error.responseJSON) {
                toastr.error(error.responseJSON.error) || "An unexpected error occurred.";
                const errors = error.responseJSON.errorData || {};
                console.log(errors)
                formErrorHandler(errors, "Register");
            } else {
                toastr.error("An unexpected error occurred.");
            }
        }
    })
}
</script>