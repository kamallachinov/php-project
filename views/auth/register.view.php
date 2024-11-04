<?php require "../partials/head.php"; ?>

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-900 text-center mb-6">Create an Account</h1>

        <?php if (!empty($registerError)): ?>
        <p class="text-red-600 text-center mb-4"><?= htmlspecialchars($registerError) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="usernameRegister" name="username"
                    value="<?= htmlspecialchars($username ?? '') ?>"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($nameError) ? 'border-red-500' : ''; ?>">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="emailRegister" name="email" value="<?= htmlspecialchars($email ?? '') ?>"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($emailError) ? 'border-red-500' : ''; ?>">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="passwordRegister" name="password"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($passwordError) ? 'border-red-500' : ''; ?>">
            </div>

            <div class="mb-4">
                <label for="confirm_password" class="block text-gray-700">Confirm Password</label>
                <input type="password" id="confirm_passwordRegister" name="confirm_password"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($confirmPasswordError) ? 'border-red-500' : ''; ?>">

            </div>

            <button type="submit" name="register" id="registerBtn"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">Register</button>
        </form>

        <p class="text-sm text-gray-600 mt-4 text-center">Already have an account? <a href="../auth/login.view.php"
                class="text-blue-500 hover:underline">Login</a></p>
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
const registerItemFields = [{
        id: "usernameRegister",
        label: "Username"
    },
    {
        id: "emailRegister",
        label: "Email"
    },
    {
        id: "passwordRegister",
        label: "Password"
    },
    {
        id: "confirm_passwordRegister",
        label: "Confirm password"
    }
];

document.getElementById("registerBtn").addEventListener("click", (e) => {
    e.preventDefault();
    const isValid = validateFormFields(registerItemFields);

    if (isValid) {
        const data = {
            username: document.getElementById("usernameRegister").value.trim(),
            email: document.getElementById("emailRegister").value.trim(),
            password: document.getElementById("passwordRegister").value.trim(),
            confirm_password: document.getElementById("confirm_passwordRegister").value.trim()
        };
        register(data);
    } else {
        alert("Please fill in all fields.");
    }

})

function register(data) {
    const action = "register"
    $.ajax({
        url: "../../controllers/auth/register.php",
        type: "POST",
        data: {
            username: data.username,
            email: data.email,
            password: data.password,
            confirm_password: data.confirm_password,
            action: action,
        },
        success: function(response) {
            toastr.success(response.message)
            resetForm(registerItemFields);
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