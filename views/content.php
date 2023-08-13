<?php
session_start();
include("../controllers/connect.php");
if (isset($_COOKIE['userId'])) {
    $_SESSION['userId'] = $_COOKIE['userId'];
}

$res = getContentDetail($_GET['id']);
$content = $res->fetch_assoc();

$liked = false;
$likeCount = 0;

if ($content['likes']) {
    $likesJSON = json_decode($content['likes']);
    $likeCount = count($likesJSON);
    if (count($likesJSON) > 0 && array_search($_SESSION['userId'], $likesJSON) >= 0) {
        $liked = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImbBAgram</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,line-clamp"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="min-h-screen bg-gray-200">
        <?php require_once 'nav.php' ?>

        <main class="-mt-32">
            <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                    <div class="px-4 py-5 sm:px-6">
                        <a href="profile.php?id=<?= $content['userId'] ?>"
                            class="flex my-3 flex-row space-x-5 items-center">
                            <div>
                                <img class="rounded-full object-cover h-8 w-8"
                                    src="../uploads/<?= $content['profilePicture'] ?>" alt="">
                                </button>
                            </div>
                            <div>
                                <p class="text-lg font-bold"><?= $content['username'] ?></p>
                                <p class="text-sm"><?= $content['contentLocation'] ?></p>
                            </div>
                        </a>
                        <div class="flex justify-center">
                            <img src="../uploads/<?= $content['fileLocation'] ?>">
                        </div>
                        <div class="flex flex-row space-x-3 my-3">
                            <div id="btnLike">

                                <!-- LIKE BUTTON -->

                                <?php if (!$liked) { ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <?php } else { ?>
                                <!-- DISLIKE BUTTON -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                        clip-rule="evenodd" />
                                </svg>
                                <?php } ?>
                            </div>
                            <p><?= $likeCount ?></p>
                        </div>
                    </div>
                    <div class="px-4 py-5 sm:px-6">
                        <p class="text-sm"><?= $content['caption'] ?></p>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="bg-gray-50 px-4 py-6 sm:px-6">
                            <div class="flex space-x-3">
                                <div class="min-w-0 flex-1">
                                    <form id="formComment" action="#">
                                        <input type="hidden" id="contentId" name="contentId"
                                            value="<?= $content['contentId'] ?>">
                                        <div>
                                            <label for="comment" class="sr-only">About</label>
                                            <textarea id="comment" name="comment" rows="3"
                                                class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                                                placeholder="Add a note"></textarea>
                                        </div>
                                        <!-- ERROR LABEL -->
                                        <p class="mt-2 text-sm text-red-600 hidden" id="error"></p>
                                        <div class="mt-3 flex items-center justify-between">
                                            <button type="submit"
                                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Comment
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-4 sm:px-6">
                        <section aria-labelledby="notes-title">
                            <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
                                <div class="divide-y divide-gray-200">
                                    <div class="px-4 py-6 sm:px-6">
                                        <ul class="space-y-8">
                                            <?php
                                            if ($content['comments']) {
                                                $comments = json_decode($content['comments'], true);
                                                foreach ($comments as $comment) {
                                                    $data = getUserDetail($comment['userId']);
                                                    $data = $data->fetch_assoc();
                                            ?>
                                            <li>
                                                <div class="flex space-x-3">
                                                    <img class="mt-2 object-cover rounded-full h-8 w-8"
                                                        src="../uploads/<?= $data['profilePicture'] ?>">
                                                    <div>
                                                        <div class="text-sm">
                                                            <a href="/views/profile.php?id=<?= $data['userId'] ?>"
                                                                class="font-medium text-gray-900">
                                                                <?= $data['username'] ?>
                                                            </a>
                                                        </div>
                                                        <div class="mt-1 text-sm text-gray-700">
                                                            <p><?= $comment['comment'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                                }
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
    $(document).ready(function(e) {
        $("#btnLike").click(function() {
            $.ajax({
                type: "POST",
                url: "../controllers/jquery/likeContent.php",
                data: {
                    contentId: "<?= $content['contentId'] ?>",
                },
                dataType: "json",
                success: function(response) {
                    if (response) {
                        location.reload();
                    }
                }
            });
        });
        $("#formComment").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "../controllers/jquery/commentContent.php",
                data: {
                    contentId: $('#contentId').val(),
                    comment: $('#comment').val(),
                },
                dataType: "json",
                success: function(response) {
                    if (response == true) {
                        location.reload();
                    } else {
                        $('#error').removeClass('hidden');
                        $('#error').text(response);
                    }
                }
            });
        }))
    });
    </script>
</body>

</html>