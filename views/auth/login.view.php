
<?php
require "../partials/head.php";
require  "../../controllers/auth/login.php";
var_dump($loginErrors);
echo "<br/>";
var_dump($response);
?>

<?php //= var_dump(!empty($response['errors'])) ?><!--;-->

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-gray-900 text-center mb-6">Login to Your Account</h1>


<!--        --><?php //if (!empty($response('message'))): ?>
<!--            <p class="text-red-600 text-center mb-4">--><?php //= htmlspecialchars($response['message']) ?><!--</p>-->
<!--        --><?php //endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="username" name="username"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($response['errors']['username']) ? 'border-red-500' : ''; ?>">
                <?php if (!empty($response['errors']['username'])): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($response['errors']['username']) ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?= !empty($response['errors']['password']) ? 'border-red-500' : ''; ?>">
                <?php if (!empty($response['errors']['password'])): ?>
                    <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($response['errors']['password']) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" id="loginBtn" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">Login</button>
        </form>

        <p class="text-sm text-gray-600 mt-4 text-center">Don't have an account? <a href="../auth/register.view.php" class="text-blue-500 hover:underline">Sign Up</a></p>
    </div>
</div>

<!-- jQuery library (required) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
 integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
 crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    document.getElementById("loginBtn").addEventListener("click",(e)=>{
        e.preventDefault();
        let data = {
            username : document.getElementById("username").value,
            password:document.getElementById("password").value
        };
        login(data);
    })


    function login(data){
        let action = "loginAction";

        $.ajax({
            url: "../../controllers/auth/login.php",
            type: "POST",
            data: {
                action: action,
                username: data.username,
                password: data.password
            },
            success: function (response) {
                try {
                    console.log(response);

                    if (response.message) {
                        alert(response.message);
                    }

                } catch (e) {
                    console.error("Failed to parse JSON response:", e);
                }
            },
            error: function (error) {
                console.error("Error occurred when logging in...");
            }
        });
    }
</script>


</body>
</html>