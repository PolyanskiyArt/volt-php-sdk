<?php

use Dotenv\Dotenv;
use GuzzleHttp\Exception\RequestException;
use LJJackson\Volt\Exceptions\PaymentValidationException;
use LJJackson\Volt\VoltApi;
use LJJackson\Volt\VoltApiConfig;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = new VoltApiConfig(
    $_ENV['VOLT_CLIENT_ID'],
    $_ENV['VOLT_CLIENT_SECRET'],
    $_ENV['VOLT_API_USERNAME'],
    $_ENV['VOLT_API_PASSWORD']
);

$config->setSandbox();

$api = new VoltApi($config);

$accessToken = $api->authentication->authenticate();

$banks = $api->banks->retrieveAll($accessToken);

var_dump($banks[0]);



