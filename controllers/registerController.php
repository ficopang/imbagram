<?php
include("./connect.php");
session_start();

// OCMPOSER
require_once __DIR__ . '\..\vendor\autoload.php';

use Hidehalo\Nanoid\Client;

$client = new Client();

# default random generator
$userId = $client->generateId($size = 10);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnSubmit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $filename = 'user.png';

    $errorMsg = array();
    if (empty($username) || empty($password) || empty($name) || empty($email)) {
        array_push($errorMsg, "All fields can’t be empty.");
    }
    if (!ctype_alnum($username)) {
        array_push($errorMsg, "Username can only contain alphanumeric characters");
    }
    if (strlen($username) < 4 || strlen($username) > 10) {
        array_push($errorMsg, "Username length must be between 4 and 10 inclusively");
    }
    if (strlen($password) < 8 || strlen($password) > 16) {
        array_push($errorMsg, "Password length must be between 8 and 16 inclusively");
    }
    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        array_push($errorMsg, "Password must contain alphabet and number");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errorMsg, "Email must be in valid email format");
    }
    if (isset($_FILES['profile'])) {
        $image = $_FILES['profile'];
        $target_directory = '../uploads/';
        $file_name = $target_directory . $userId . "." . pathinfo($image["name"], PATHINFO_EXTENSION);
        $mime_type = mime_content_type($image["tmp_name"]);

        if (!in_array($mime_type, array('image/jpeg', 'image/png'))) {
            array_push($errorMsg, "Image must be png / jpg / jpeg file");
        } else {
            if (file_exists($file_name))
                array_push($errorMsg, "Image already exist!");
            if ($image["size"] > 1000000)
                array_push($errorMsg, "Image must be under 1MB");
            if (count($errorMsg) == 0) {
                move_uploaded_file($image['tmp_name'], $file_name);
                $filename = $userId . "." . pathinfo($image["name"], PATHINFO_EXTENSION);
            }
        }
    }

    unset($_SESSION['error']);
    if (count($errorMsg) > 0) {
        $_SESSION['error'] = $errorMsg;
        header('Location: ../views/register.php');
    } else {
        echo register($userId, $username, password_hash($password, PASSWORD_DEFAULT), $email, $name, $filename, $bio);
        $_SESSION['userId'] = $userId;
        header('Location: ../views/index.php');
    }

    // END HERE
}