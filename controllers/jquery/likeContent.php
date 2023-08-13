<?php
session_start();
include("../connect.php");

if (isset($_POST['contentId'])) {
    $res = getContentDetail($_POST['contentId']);
    $content = $res->fetch_assoc();

    $liked = false;

    $likesJSON = array();

    if ($content['likes']) {
        $likesJSON = json_decode($content['likes']);
        if (count($likesJSON) > 0 && array_search($_SESSION['userId'], $likesJSON) >= 0) {
            $liked = true;
        }
    }

    if (!$liked) {
        array_push($likesJSON, $_SESSION['userId']);
    } else {
        unset($likesJSON[array_search($_SESSION['userId'], $likesJSON)]);
    }

    $likesJSON = json_encode($likesJSON);

    if (likeContent($_POST['contentId'], $likesJSON)) {
        echo "true";
    }
}