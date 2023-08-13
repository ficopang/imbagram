<?php

$conn = mysqli_connect('localhost', 'root', '', 'imbagramdb');

if ($conn->error) {
    var_dump($conn->error);
    die("ERROR CONNECT DB");
}

function register($userId, $username, $password, $name, $email, $bio, $image)
{
    global $conn;

    $query = "INSERT INTO users (userId,username,password,email,name,profilePicture,bio) VALUES ('" . $userId . "', '" . $username . "', '" . $password . "', '" . $email . "','" . $name . "', '" . $bio . "', '" . $image . "')";

    if ($conn->query($query)) {
        return true;
    }

    return false;
}

function loginWithUsername($username, $password)
{
    global $conn;

    $query = "SELECT * FROM users WHERE username='" . $username . "'";
    $res = $conn->query($query);

    if ($res->num_rows == 1) {
        $data = $res->fetch_assoc();
        if (password_verify($password, $data['password'])) {
            return $data;
        }
        return false;
    }
    return false;
}

function loginWithEmail($email, $password)
{
    global $conn;

    $query = "SELECT * FROM users WHERE email='" . $email . "'";
    $res = $conn->query($query);

    if ($res->num_rows == 1) {
        $data = $res->fetch_assoc();
        if (password_verify($password, $data['password'])) {
            return $data;
        }
        return false;
    }
    return false;
}

function getUserDetail($id)
{
    global $conn;

    $query = "SELECT * FROM users WHERE userId='" . $id . "'";
    return $conn->query($query);
}

function searchUser($query, $limit, $offset)
{
    global $conn;

    $query = "SELECT * FROM users WHERE name LIKE '%" . $query . "%' OR username LIKE '%" . $query . "%' OR bio LIKE '%" . $query .
        "%'  LIMIT " . $limit . " OFFSET " . $offset;
    return $conn->query($query);
}

function getAllContentsWithLimit($limit, $offset)
{
    global $conn;

    $query = "SELECT * FROM contents LEFT JOIN users ON contents.userId = users.userId ORDER BY contents.timeCreated DESC LIMIT " . $limit . " OFFSET " . $offset;
    if ($res = $conn->query($query)) {
        return $res;
    }
    return false;
}

function getAllContentsById($id)
{
    global $conn;

    $query = "SELECT * FROM contents LEFT JOIN users ON contents.userId = users.userId WHERE contents.userId = '" . $id . "' ORDER BY contents.timeCreated DESC";
    if ($res = $conn->query($query)) {
        return $res;
    }
    return false;
}

function getAllUsers()
{
    global $conn;

    $query = "SELECT * FROM users";
    return $conn->query($query);
}

function postContent($contentId, $caption, $fileLocation, $userId, $contentLocation)
{
    global $conn;

    $query = "INSERT INTO contents (contentId,caption,fileLocation,userId,contentLocation) VALUES ('" . $contentId . "', '" . $caption . "', '" . $fileLocation . "', '" . $userId . "','" . $contentLocation . "')";

    if ($conn->query($query)) {
        return true;
    }

    return false;
}

function getContentDetail($id)
{
    global $conn;

    $query = "SELECT * FROM contents JOIN users ON contents.userId = users.userId WHERE contentId='" . $id . "'";
    return $conn->query($query);
}

function likeContent($contentId, $value)
{
    global $conn;

    $query = "UPDATE contents SET likes='" . $value . "' WHERE contentId='" . $contentId . "'";
    if ($conn->query($query)) {
        return true;
    }

    return false;
}

function postComment($contentId, $value)
{
    global $conn;

    $query = "UPDATE contents SET comments='" . $value . "' WHERE contentId='" . $contentId . "'";
    if ($conn->query($query)) {
        return true;
    }

    return false;
}