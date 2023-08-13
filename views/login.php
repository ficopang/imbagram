<?php
session_start();
if (isset($_COOKIE['userId'])) {
    $_SESSION['userId'] = $_COOKIE['userId'];
}

if (isset($_SESSION['userId'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImBAgram Login</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="index.php">
                <img class="mx-auto h-12 w-auto" src="../assets/Imbagram.png" alt="Imbagram">
            </a>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Sign in to your account
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form id="formLogin" class="space-y-6" method="POST" action="../controllers/loginController.php">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">
                            Email / username
                        </label>
                        <div class="mt-1">
                            <input id="username" name="username" type="text" autocomplete="email" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember_me" type="checkbox"
                                class="h-4 w-4 text-sky-600 focus:ring-sky-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Remember me
                            </label>
                        </div>
                    </div>
                    <!-- Show error message -->
                    <?php
                    if (isset($_SESSION['error'])) { ?>

                    <p class="mt-2 text-sm text-red-600" id="error"><?= $_SESSION['error'][0] ?></p>
                    <?php
                        unset($_SESSION['error']);
                    }
                    ?>
                    <div>
                        <button id="btnSubmit" type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Sign in
                        </button>
                    </div>
                </form>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                Or
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-3">
                        <div>
                            <a href="register.php"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                Register
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(e) {
        $("#formLogin").on('submit', (function(e) {}))
    });
    </script>
</body>

</html>