<?php
session_start();
include("../controllers/connect.php");
if (isset($_COOKIE['userId'])) {
    $_SESSION['userId'] = $_COOKIE['userId'];
}

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImbBAgram</title>
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
            <form id="formCreatePost" class="space-y-8 divide-y divide-gray-200" method="POST"
                action="../controllers/postController.php" enctype="multipart/form-data">
                <div class="space-y-8 divide-y divide-gray-200">
                    <div>
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Create a post
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Post your content on Imbagram!
                            </p>
                        </div>

                        <div class="mt-6 sm:col-span-4">
                            <div id="contentContainer">
                                <label class="block text-sm font-medium text-gray-700">
                                    Content
                                </label>
                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div id="inputContainer" class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                            viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="content"
                                                class="mx-auto relative cursor-pointer bg-white rounded-md font-medium text-sky-600 hover:text-sky-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-sky-500">
                                                <span>Upload a file</span>
                                                <input id="content" name="content" type="file" class="sr-only">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, JPEG up to 10MB
                                        </p>
                                    </div>
                                    <img class="h-1/4" id="imgPreview">
                                </div>
                                <div id="reup" class="hidden">
                                    <label class="block text-sm font-medium text-gray-700"> Reupload content </label>
                                    <input id="reupContent" name="reupContent" type="file"
                                        class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="loc" class="block text-sm font-medium text-gray-700">
                                    Location
                                </label>
                                <div class="mt-1">
                                    <input id="loc" name="loc" type="text" autocomplete="Location"
                                        class="shadow-sm focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="caption" class="block text-sm font-medium text-gray-700">
                                    Caption
                                </label>
                                <div class="mt-1">
                                    <textarea id="caption" name="caption" rows="3"
                                        class="shadow-sm focus:ring-sky-500 focus:border-sky-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Write something about your content.</p>
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
                            <a href="index.php"
                                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                Cancel
                            </a>
                            <button name="btnSubmit" id="btnSubmit" type="submit"
                                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                POST
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function(e) {
        $('#content').change(function(e) {
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