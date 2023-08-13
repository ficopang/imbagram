<?php
include("./connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = $_POST['remember-me'];

    $errorMsg = array();

    unset($_SESSION['error']);
    if (count($errorMsg) > 0) {
        $_SESSION['error'] = $errorMsg;
        header('Location: ../views/login.php');
    } else if ($res = loginWithUsername($username, $password)) {
        if (isset($_POST['remember-me'])) {
            setcookie("userId", $res['userId'], time() + 60 * 60, "/", NULL, 0);
        }
        $_SESSION['userId'] = $res['userId'];
        header('Location: ../views/index.php');
    } else if ($res = loginWithEmail($username, $password)) {
        if (isset($_POST['remember-me'])) {
            setcookie("userId", $res['userId'], time() + 60 * 60, "/", NULL, 0);
        }
        $_SESSION['userId'] = $res['userId'];
        header('Location: ../views/index.php');
    } else {
        array_push($errorMsg, "Wrong credentials");
        $_SESSION['error'] = $errorMsg;
        header('Location: ../views/login.php');
    }
}