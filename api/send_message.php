<?php

include_once "../config.php";
session_start();

if (!isset($_SESSION['isAuthenticated'])) die();

$insertNewMessageQuery = "INSERT INTO users_messages (sender, receiver, message) VALUES (:sender, :receiver, :message)";

$insertNewMessageStmt =  $dbh->prepare($insertNewMessageQuery);
$insertNewMessageStmt->bindValue(":sender", $_SESSION['user']['ID']);
$insertNewMessageStmt->bindValue(":receiver", $_POST['receiver']);
$insertNewMessageStmt->bindValue(":message", $_POST['message']);
$insertNewMessageStmt->execute();

echo json_encode(array(
    "success" => true,
    "message" => $_POST['message']
));

?>