<?php
include_once "../config.php";
session_start();

$username =     $_POST['username'];
$password =     $_POST['password'];


if ($username && $password)
{
    //$password = password_hash($password, PASSWORD_DEFAULT);

    $searchUserStmt = $dbh->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $searchUserStmt->bindParam(":username", $username);
    $searchUserStmt->bindParam(":password", $password);
    $searchUserStmt->execute();
    
    $user = $searchUserStmt->fetch();
    if ($user)
    {
        $_SESSION['isAuthenticated'] = true;
        $_SESSION['isOnline'] = true;

        $updateUserStatusStmt = $dbh->prepare("UPDATE users SET online = :online WHERE username = :username");
        $updateUserStatusStmt->bindParam(":online", $_SESSION['isOnline']);
        $updateUserStatusStmt->bindParam(":username", $username);
        $updateUserStatusStmt->execute();

        header("Location: ../chat.php");
    }
    else
    {
        echo json_encode(array(
            "erro" => true,
            "mensagem" => "Usuário ou senha estão incorretos."
        ));
    }
    
} 
else 
{

}

?>