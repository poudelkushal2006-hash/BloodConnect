<?php
// config/config.php

return [
    'db' => [
        'host' => getenv('MYSQLHOST') ?: '127.0.0.1',
        'dbname' => getenv('MYSQLDATABASE') ?: 'bloodconnect',
        'user' => getenv('MYSQLUSER') ?: 'root',
        'pass' => getenv('MYSQLPASSWORD') ?: '',
        'port' => getenv('MYSQLPORT') ?: '3306',
        'charset' => 'utf8mb4'
    ],

    'app' => [
        'url' => getenv('APP_URL') ?: 'http://localhost/bloodconnect/public',
        'env' => getenv('APP_ENV') ?: 'development'
    ]
];