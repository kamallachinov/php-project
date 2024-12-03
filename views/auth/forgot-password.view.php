<?php
session_start();
$pageTitle = "Forgot Password";

require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/views/partials/head.php";
?>

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-900 text-center mb-6">Forgot Password</h1>

        <form method="POST" action="/php-prj/controllers/auth/forgot-password.php" action="send-password-reset">
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" name="resetPassword" id="resetPasswordBtn"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">
                Reset Password
            </button>
        </form>

        <p class="text-sm text-gray-600 mt-4 text-center">
            Remembered your password?
            <a href="/php-prj/views/auth/login.view.php" class="text-blue-500 hover:underline">Login</a>
        </p>
    </div>
</div>

<!-- jQuery library (required) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- TOASTR SCRIPTS & SWEET ALERT-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    resetPasswordBtn.addEventListener("click", function(event) {
        event.preventDefault();

        const email = document.getElementById("email").value;

        $.ajax({
            url: "/php-prj/controllers/reset-password/send-password-reset-mail.php",
            type: "POST",
            data: {
                email: email
            },
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success"
                });
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Something went wrong, please try again.",
                    icon: "error"
                });
            }
        });
    });
</script>