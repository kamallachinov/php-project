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
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($username ?? '') ?>"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($nameError) ? 'border-red-500' : ''; ?>">

            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($emailError) ? 'border-red-500' : ''; ?>">

            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($passwordError) ? 'border-red-500' : ''; ?>">

            </div>

            <div class="mb-4">
                <label for="confirm_password" class="block text-gray-700">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password"
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

<script>
document.getElementById("registerBtn").addEventListener("click", (e) => {
    e.preventDefault();
    const data = {
        username: document.getElementById("username").value.trim(),
        email: document.getElementById("email").value.trim(),
        password: document.getElementById("password").value.trim(),
        confirm_password: document.getElementById("confirm_password").value.trim()
    };
    register(data);
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
            console.log(response)
        },
        error: function(error) {

        }
    })
}
</script>