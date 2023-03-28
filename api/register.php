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
        
    }
}