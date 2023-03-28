<?php
include_once "../config.php";
session_start();

$username =     $_POST['username'];
$password =     $_POST['password'];


if ($username && $password)
{
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
    $searchUserStmt = $dbh->prepare("SELECT * FROM users WHERE username = :username");
    $searchUserStmt->bindValue(":username", $username);
    $searchUserStmt->execute();
    
    $user = $searchUserStmt->fetch();
    
    if ($user)
    {
        $password_verify = password_verify($password, $user['password']);
        if ($password_verify)
        {
            $_SESSION['user'] = $user;
            $_SESSION['isAuthenticated'] = true;
            $_SESSION['isOnline'] = true;

            $updateUserStatusStmt = $dbh->prepare("UPDATE users SET online = :online WHERE username = :username");
            $updateUserStatusStmt->bindValue(":online", $_SESSION['isOnline']);
            $updateUserStatusStmt->bindValue(":username", $username);
            $updateUserStatusStmt->execute();

            header("Location: ../chat.php");
        }
    }
    
}

?>