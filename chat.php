<?php
    session_start();

    if (!isset($_SESSION['isAuthenticated']))
    {
        if (!$_SESSION['isAuthenticated'])
        {
            header("Location: /index.php");
            die();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Real Time - Chat</title>
</head>
<body>
    
</body>
</html>