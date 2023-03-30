<?php

include_once "../config.php";
session_start();

$getUsersOnlineStmt = $dbh->prepare("SELECT * FROM users WHERE username != :username AND online = 1");
$getUsersOnlineStmt->bindValue(":username", $_SESSION['user']['username']);
$getUsersOnlineStmt->execute();

$users = $getUsersOnlineStmt->fetchAll();
$user_array = array();

if ($users) 
{
    foreach ($users as $user) 
    {
        $user_array[] = array(
            "user" => $user['username']
        );
    }
}

$json = json_encode($user_array);

echo $json;


?>