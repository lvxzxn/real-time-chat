<?php
include_once "../config.php";
session_start();

if (!isset($_SESSION['isAuthenticated'])) die();

$senderId = $_SESSION['user']['ID'];
$receiverId = $_POST['receiver'];

$getUserMessages = $dbh->prepare(
    "SELECT * FROM users_messages 
     WHERE (sender = :senderId AND receiver = :receiverId)
        OR (sender = :receiverId AND receiver = :senderId)
     ORDER BY sended_at DESC LIMIT 1"
);

$getUserMessages->bindValue(":senderId", $senderId);
$getUserMessages->bindValue(":receiverId", $receiverId);

$getUserMessages->execute();

$x = $getUserMessages->fetch();

if ($getUserMessages){
    header('Content-Type: application/json');
    echo json_encode($x);
}