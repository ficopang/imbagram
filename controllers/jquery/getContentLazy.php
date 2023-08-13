<?php

include("../connect.php");

if (isset($_POST['limit'], $_POST['offset'])) {
    $res = getAllContentsWithLimit($_POST['limit'], $_POST['offset']);

    while ($row = $res->fetch_assoc()) {
        echo '
<li class="relative">
<div class="h-full bg-white overflow-hidden shadow rounded-lg">
<div class="flex items-center px-4 py-5 sm:p-6 sm:pb-2">
<div class="mr-4">
<a href="profile.php?id=' . $row['userId'] . '">
<img class="object-cover rounded-full h-8 w-8"
src="../uploads/' . $row['profilePicture'] . '" alt="">
</a>
</div>
<div>
<a href="profile.php?id=' . $row['userId'] . '">
    <p class="block text-sm font-bold text-gray-500 pointer-events-none">
        ' . $row['username'] . '</p>
        </a>
    <p class="block text-sm font-medium text-gray-500 pointer-events-none">
        ' . $row['contentLocation'] . '</p>
</div>
</div>
<div class="px-4 py-5 sm:p-6 sm:pt-0">
    <a href="content.php?id=' . $row['contentId'] . '"
        class="group block w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-sky-500 overflow-hidden">
        <!-- CONTENT -->
        <img src="../uploads/' . $row['fileLocation'] . '" alt="" class="object-cover pointer-events-none group-hover:opacity-75">
    </a>
</div>
<div class="px-4 py-4 sm:px-6">
    <p class="text-sm text-gray-500 truncate">
        ' . $row['caption'] . '
    </p>
</div>
</div>
</li>
';
    }
}