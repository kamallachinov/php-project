
<?php
require "../partials/head.php";
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
?>


<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-900 text-center mb-6">Login to Your Account</h1>

        <?php if (!empty($loginError)): ?>
            <p class="text-red-600 text-center mb-4"><?= htmlspecialchars($loginError) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($usernameError) ? 'border-red-500' : ''; ?>">
                <?php if (!empty($usernameError)): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($usernameError) ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password"  value="<?= htmlspecialchars($password) ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($passwordError) ? 'border-red-500' : ''; ?>">
                <?php if (!empty($passwordError)): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($passwordError) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">Login</button>
        </form>

        <p class="text-sm text-gray-600 mt-4 text-center">Don't have an account? <a href="../auth/register.view.php" class="text-blue-500 hover:underline">Sign Up</a></p>
    </div>
</div>
</body>
</html>