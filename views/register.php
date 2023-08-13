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
    <title>ImbBAgram Register</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-20">
        <div class="max-w-3xl mx-auto">
            <a href="index.php">
                <img src="../assets/Imbagram.png" alt="imbagram" class="w-1/3 mx-auto">
            </a>
            <form id="formRegis" class="space-y-8 divide-y divide-gray-200" method="POST"
                action="../controllers/registerController.php" enctype="multipart/form-data">
                <div class="space-y-8 divide-y divide-gray-200">
                    <div>
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Profile
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Create a new Imbagram profile
                            </p>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-4">
                            <div class="sm:col-span-4">
                                <label for="username" class="block text-sm font-medium text-gray-700">
                                    Username
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="username" id="username" autocomplete="username"
                                        class="flex-1 focus:ring-sky-500 focus:border-sky-500 block w-full min-w-0 rounded-md sm:text-sm border-gray-300">
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="password" name="password" id="password" autocomplete="password"
                                        class="flex-1 focus:ring-sky-500 focus:border-sky-500 block w-full min-w-0 rounded-md sm:text-sm border-gray-300">
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Name
                                </label>
                                <div class="mt-1">
                                    <input id="name" name="name" type="text" autocomplete="name"
                                        class="shadow-sm focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email address
                                </label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="text" autocomplete="email"
                                        class="shadow-sm focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="bio" class="block text-sm font-medium text-gray-700">
                                    Biography
                                </label>
                                <div class="mt-1">
                                    <textarea id="bio" name="bio" rows="3"
                                        class="shadow-sm focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Write a few sentences about yourself.</p>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="photo" class="block text-sm font-medium text-gray-700">
                                    Photo
                                </label>
                                <div class="mt-1 flex items-center">
                                    <span class="h-12 w-12 object-cover  rounded-full overflow-hidden bg-gray-100">
                                        <img id="imgPreview" src="../uploads/user.png">
                                    </span>
                                    <input id="profile" name="profile" type="file"
                                        class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-5">
                        <!-- Show error message -->
                        <?php
                        if (isset($_SESSION['error'])) { ?>

                        <p class="mt-2 text-sm text-red-600" id="error"><?= $_SESSION['error'][0] ?></p>
                        <?php
                            unset($_SESSION['error']);
                        }
                        ?>
                        <div class="flex justify-end">
                            <a href="login.php"
                                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                Cancel
                            </a>
                            <button name="btnSubmit" id="btnSubmit" type="submit"
                                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                REGISTER
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function(e) {
        $('#profile').change(function(e) {
            var output = document.getElementById('imgPreview');
            output.src = URL.createObjectURL(e.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        });

    });
    </script>
</body>

</html>