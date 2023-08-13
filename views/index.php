<?php
session_start();
include("../controllers/connect.php");
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
            <ul id="data" class="space-y-3">
            </ul>
            <div id="load_msg">

            </div>
        </main>
    </div>
    <script>
    $(document).ready(function() {
        var limit = 5;
        var offset = 0;

        var action = 'inactive';

        function loadContent(limit, start) {
            $.ajax({
                type: "POST",
                url: "../controllers/jquery/getContentLazy.php",
                data: {
                    limit: limit,
                    offset: offset,
                },
                dataType: "html",
                success: function(response) {
                    $('#data').append(response);
                    if (response != '') {
                        offset += limit;
                        action = "inactive";
                    }
                    $('#load_msg').html('');
                }
            });
        }

        loadContent(limit, offset);

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $('#data').height() && action ==
                'inactive') {
                action = 'active';
                $('#load_msg').html('Loading');
                loadContent(limit, offset);
            }
        });
    });
    </script>
</body>

</html>