<?php
session_start();
include("../controllers/connect.php");
if (isset($_GET['q'])) {
    $key = $_GET['q'];
} else {
    $key = '';
}
?>
<!DOCTYPE html>
<html lang="en" xmlns:input="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imbagram</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="min-h-screen bg-gray-200">
        <?php require_once 'nav.php' ?>
        <main class="-mt-32 w-1/2 mx-auto pb-20">

            <?php

            $limit = 6;
            if (isset($_GET['p'])) {
                $page = $_GET['p'];
            } else {
                $page = 1;
            }

            $res = getAllUsers();
            $pages = $res->num_rows % $limit == 0 ? $res->num_rows / $limit :
                $res->num_rows / $limit + 1;
            $pages = floor($pages);
            $offset = ($limit * $page) - $limit;
            $res = searchUser($_GET['q'], $limit, $offset);

            if ($res->num_rows == 0) {
            ?>
            <!-- NO MATCHING ENTRY -->
            <div class="mx-auto">
                <h1 class="mt-5 text-center text-5xl font-semibold	">NO MATCHING ENTRY!</h1>
            </div>

            <div class="mt-32 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <?php
                } else {
                    while ($row = $res->fetch_assoc()) {
                    ?>
                <div
                    class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-sky-500">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 object-cover rounded-full" src="../uploads/<?= $row['profilePicture'] ?>"
                            alt="">
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="/views/profile.php?id=<?= $row['userId'] ?>" class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                            <p class="text-sm font-medium text-gray-900">
                                <?= $row['username'] ?>
                            </p>
                            <p class="text-sm text-gray-500 truncate">
                                <?= $row['name'] ?>
                            </p>
                        </a>
                    </div>
                    <p class="flex-1 max-w-1/2 text-sm text-gray-500 truncate">
                        <?= $row['bio'] ?>
                    </p>
                </div>
                <?php }
                } ?>
            </div>
            <nav class="mt-10 border-t border-gray-200 px-4 flex items-center justify-between sm:px-0">
                <div class="-mt-px w-0 flex-1 flex">
                    <?php if ($page > 1) { ?>
                    <a href="<?= "/views/search.php?q=" . $key . "&p=" . $page - 1 ?>"
                        class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Previous
                    </a>
                    <?php } ?>
                </div>

                <?php for ($i = 1; $i <= $pages; $i++) {  ?>
                <div class="hidden md:-mt-px md:flex">
                    <a href="<?= "/views/search.php?q=" . $key . "&p=" . $i ?>"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">
                        <?= $i ?>
                    </a>
                </div>
                <?php } ?>
                <div class="-mt-px w-0 flex-1 flex justify-end">
                    <?php if ($page < $pages) { ?>
                    <a href="<?= "/views/search.php?q=" . $key . "&p=" . $page + 1 ?>"
                        class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Next
                        <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <?php } ?>
                </div>
            </nav>
        </main>
    </div>
</body>

</html>