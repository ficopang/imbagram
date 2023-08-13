<?php
session_start();
include("../connect.php");

if (isset($_POST['contentId'], $_POST['comment'])) {
    $res = getContentDetail($_POST['contentId']);
    $content = $res->fetch_assoc();

    $arr = array();

    if ($content['comments']) {
        $arr = json_decode($content['comments']);
    }

    $addComment = array("userId" => $_SESSION['userId'], "comment" => $_POST['comment'], "timeCreated" => time());

    array_push($arr, $addComment);

    if (postComment($_POST['contentId'], json_encode($arr))) {
        echo "true";
    } else {
        echo "Invalid contentId";
    }
}