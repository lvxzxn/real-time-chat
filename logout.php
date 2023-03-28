<?php
session_start();

if (!isset($_SESSION)){
    header("Location: /index.php");
    die();
}

session_destroy();
header("Location: /index.php");