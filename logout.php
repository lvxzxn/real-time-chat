<?php
session_start();

if (!isset($_SESSION)){
    header("Location: /index.php");
    die();
}

include_once "./config.php";

$createUserStmt = $dbh->prepare("INSERT INTO users (username, password, online) VALUES (:username, :password, :online)");
$createUserStmt->bindValue(":username", $username);
$createUserStmt->bindValue(":password", $password);
$createUserStmt->bindValue(":online", true);
$createUserStmt->execute();

session_destroy();
header("Location: /index.php");