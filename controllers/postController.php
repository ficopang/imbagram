<?php
include("./connect.php");
session_start();

// OCMPOSER
require_once __DIR__ . '\..\vendor\autoload.php';

use Hidehalo\Nanoid\Client;

$client = new Client();

# default random generator
$contentId = $client->generateId($size = 10);
$file_name = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnSubmit'])) {
    $image = $_FILES['content'];
    $location = $_POST['loc'];
    $caption = $_POST['caption'];

    $errorMsg = array();

    if ($image["size"] == 0 && !is_uploaded_file($image['tmp_name'])) {
        array_push($errorMsg, "File must be chosen");
    } else {
        $target_directory = '../uploads/';
        $file_name = $target_directory . $contentId . "." . pathinfo($image["name"], PATHINFO_EXTENSION);
        $mime_type = mime_content_type($image["tmp_name"]);

        if (!in_array($mime_type, array('image/jpeg', 'image/png'))) {
            array_push($errorMsg, "Image must be .jpg / .png");
        } else {
            if (file_exists($file_name))
                array_push($errorMsg, "Image already exist!");
            if ($image["size"] > 10000000)
                array_push($errorMsg, "Image must be under 10MB");
            if (count($errorMsg) == 0) {
                move_uploaded_file($image['tmp_name'], $file_name);
                $file_name = $contentId . "." . pathinfo($image["name"], PATHINFO_EXTENSION);
            }
        }
    }

    unset($_SESSION['error']);
    if (count($errorMsg) > 0) {
        $_SESSION['error'] = $errorMsg;
        header('Location: ../views/postContent.php');
    } else {
        if (postContent(
            $contentId,
            $caption,
            $file_name,
            $_SESSION['userId'],
            $location
        )) {
            header('Location: ../views/index.php');
        }
    }

    // END HERE
}