<?php
    $databaseConfig = array(
        "hostname" => "localhost",
        "username" => "root",
        "password" => "",
        "database" => "chat_realtime"
    );

    $hostname =     $databaseConfig['hostname'];
    $database =     $databaseConfig['database'];
    $username =     $databaseConfig['username'];
    $password =     $databaseConfig['password'];

    try
    {
        $database = new \PDO("mysql:host=$hostname;dbname=$database", $username, $password);;
        $database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    catch (\PDOException $exception)
    {
        die("Falha na conexão com o banco de dados. <br> Mensagem: <strong> " . $exception->getMessage() . "</strong>");
    }