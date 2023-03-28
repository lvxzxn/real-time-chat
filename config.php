<?php
    $env = parse_ini_file('.env');

    $databaseConfig = array(
        "hostname" => $env['hostname'],
        "username" => $env['username'],
        "password" => $env['password'],
        "database" => $env['database']
    );

    $hostname =     $databaseConfig['hostname'];
    $database =     $databaseConfig['database'];
    $username =     $databaseConfig['username'];
    $password =     $databaseConfig['password'];

    try
    {
        $dbh = new \PDO("mysql:host=$hostname;dbname=$database", $username, $password);;
    }
    catch (\PDOException $exception)
    {
        die("Falha na conexão com o banco de dados. <br> Mensagem: <strong> " . $exception->getMessage() . "</strong>");
    }