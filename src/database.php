<?php

function connectToDB(): PDO
{
    static $connection = null;
    if (null !== $connection) {
        return $connection;
    }
    $config = [
        'hostname' => 'localhost',
        'username' => 'test',
        'password' => 'test',
        'database' => 'vavilov_i_qschool_test',
    ];

    $connection = new PDO(
        "mysql:host={$config['hostname']};dbname={$config['database']}",
        $config['username'],
        $config['password']
    );

    return $connection;
}
