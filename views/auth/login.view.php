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
            <p class="text-success"><?=htmlspecialchars($flashMessage)  ?></p>
        </div>
        <?php endif; ?>

        <form method="POST" action="../../controllers/auth/login.php">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="username" name="username" autofocus="autofocus" autocomplete="off"
                    autocorrect="off" autocapitalize="off" spellcheck="false"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 "
                    value="<?= htmlspecialchars($oldInputs['username'] ?? '') ?>">
                <?php if (!empty($loginErrors['username'])): ?>
                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($loginErrors['username']) ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" autocomplete="off" autocorrect="off"
                    autocapitalize="off" spellcheck="false"
                    class="w-full  py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if (!empty($loginErrors['password'])): ?>
                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($loginErrors['password']) ?></p>
                <?php endif; ?>
            </div>

            <input type="hidden" name="action" value="loginAction">
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">Login</button>
        </form>

        <p class="text-sm text-gray-600 mt-4 text-center">Don't have an account? <a href="../auth/register.view.php"
                class="text-blue-500 hover:underline">Sign Up</a></p>
    </div>
</div>