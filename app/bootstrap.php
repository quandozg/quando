<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
global $services;

// Let's use .env var for configuration
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

function getServices() {
    return [
        'emailService' => new \App\Services\Email\DummyEmailService(),
        'dbService' => new App\Services\Database\Client\MysqlClient(),
    ];
}
