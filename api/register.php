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
        $searchUserStmt = $dbh->prepare("SELECT * FROM users WHERE username = :username");
        $searchUserStmt->bindParam(":username", $username);
        $searchUserStmt->execute();

        if ($searchUserStmt->rowCount() == 0)
        {
            $password = password_hash($password, PASSWORD_BCRYPT);

            $createUserStmt = $dbh->prepare("INSERT INTO users (username, password, online) VALUES (:username, :password, :online)");
            $createUserStmt->bindValue(":username", $username);
            $createUserStmt->bindValue(":password", $password);
            $createUserStmt->bindValue(":online", true);
            $createUserStmt->execute();
            
            $_SESSION['isAuthenticated'] = true;
            $_SESSION['isOnline'] = true;
    
            header("Location: ../chat.php");
        }
    }
}