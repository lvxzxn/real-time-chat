<?php
include_once "../config.php";
session_start();

$username =     $_POST['username'];
$password =     $_POST['password'];


if ($username && $password)
{
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
    $searchUserStmt = $dbh->prepare("SELECT * FROM users WHERE username = :username");
    $searchUserStmt->bindParam(":username", $username);
    $searchUserStmt->execute();
    
    $user = $searchUserStmt->fetch();
    
    if ($user)
    {
        $password_verify = password_verify($password, $user['password']);
        if ($password_verify)
        {
            $_SESSION['isAuthenticated'] = true;
            $_SESSION['isOnline'] = true;

            $updateUserStatusStmt = $dbh->prepare("UPDATE users SET online = :online WHERE username = :username");
            $updateUserStatusStmt->bindParam(":online", $_SESSION['isOnline']);
            $updateUserStatusStmt->bindParam(":username", $username);
            $updateUserStatusStmt->execute();

            header("Location: ../chat.php");
        }
    }
    
}

?>