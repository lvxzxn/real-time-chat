<?php
session_start();

if (!isset($_SESSION)){
    header("Location: /index.php");
    die();
}

include_once "./config.php";


$updateUserStatusStmt = $dbh->prepare("UPDATE users SET online = :online WHERE username = :username");
$updateUserStatusStmt->bindValue(":username", $_SESSION['user']['username']);
$updateUserStatusStmt->bindValue(":online", false);
$updateUserStatusStmt->execute();

session_destroy();
header("Location: /index.php");