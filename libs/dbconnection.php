<?php

function dBConnect()
{
    // Vult de gegevens in om verbinding te maken met de database
    $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'];

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    // Maakt verbinding met de database
    try {
        $pdo = new \PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);

        return $pdo;
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}
