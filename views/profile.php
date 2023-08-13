<?php
session_start();
include("../controllers/connect.php");
$res = getUserDetail($_GET['id']);
$user = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $user['username'] ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,line-clamp"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="min-h-screen bg-gray-200">
        <?php require_once 'nav.php' ?>
        <main class="-mt-32">
            <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="flex flex-row">
                        <div class="px-4 py-5 sm:px-6">
                            <div>
                                <span class="sr-only">Open user menu</span>
                                <img class="object-cover rounded-full h-12 w-12"
                                    src="../uploads/<?= $user['profilePicture'] ?>" alt="">
                            </div>
                        </div>
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                <?= $user['username'] ?>
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                <?= $user['name'] ?>
                            </p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">
                                    About
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <?= $user['bio'] ?>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <ul role="list"
                    class="mt-10 grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                    <?php
                    if (isset($_GET['id'])) {
                        $res = getAllContentsById($_GET['id']);
                        while ($row = $res->fetch_assoc()) {
                    ?>
                    <li class="relative">
                        <div class="h-full bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">

                                <a href="content.php?id="
                                    class="group block w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-sky-500 overflow-hidden">
                                    <!-- CONTENT -->
                                    <img src="../uploads/<?= $row['fileLocation'] ?>" alt=""
                                        class="object-cover pointer-events-none group-hover:opacity-75">
                                </a>
                            </div>
                            <div class="px-4 py-4 sm:px-6">
                                <p class="block text-sm font-medium text-gray-500 pointer-events-none">
                                    <?= $row['contentLocation'] ?></p>
                                <p class="text-sm text-gray-500 truncate">
                                    <?= $row['caption'] ?>
                                </p>
                            </div>
                        </div>
                    </li>
                    <?php   }
                    } ?>
                </ul>
            </div>
        </main>
    </div>

    <script>
    $(document).ready(function(e) {

    });
    </script>
</body>

</html>