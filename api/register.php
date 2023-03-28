<?php
include_once "../config.php";
session_start();

$username =     $_POST['username'];
$password =     $_POST['password'];
$passwordRetyped =     $_POST['password_retyped'];

if ($username && $password && $passwordRetyped)
{
    if ($passwordRetyped == $password)
    {
        $createUserStmt = $dbh->prepare("INSERT INTO users (username, password, online) VALUES (:username, :password, :online)");
        $createUserStmt->bindParam(":username", $username);
        $createUserStmt->bindParam(":password", $username);
        $createUserStmt->bindParam(":online", 1);
    }
}