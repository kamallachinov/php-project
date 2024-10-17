<?php require "../partials/head.php";?>

<div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <h1 class="text-2xl font-bold text-gray-900 text-center mb-6">Create an Account</h1>

            <?php if (!empty($registerError)): ?>
                <p class="text-red-600 text-center mb-4"><?= htmlspecialchars($registerError) ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? '') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($nameError) ? 'border-red-500' : ''; ?>">
                    <?php if (!empty($nameError)): ?>
                        <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($nameError) ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($emailError) ? 'border-red-500' : ''; ?>">
                    <?php if (!empty($emailError)): ?>
                        <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($emailError) ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($passwordError) ? 'border-red-500' : ''; ?>">
                    <?php if (!empty($passwordError)): ?>
                        <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($passwordError) ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="block text-gray-700">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($confirmPasswordError) ? 'border-red-500' : ''; ?>">
                    <?php if (!empty($confirmPasswordError)): ?>
                        <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($confirmPasswordError) ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">Register</button>
            </form>

            <p class="text-sm text-gray-600 mt-4 text-center">Already have an account? <a href="../auth/login.view.php" class="text-blue-500 hover:underline">Login</a></p>
        </div>
    </div>
</body>
</html>