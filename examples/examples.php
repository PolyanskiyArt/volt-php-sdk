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


var_dump($api->banks->retrieveAll($accessToken));

//
//$payment = $api->payment->requestPayment($accessToken, [
//    'currencyCode' => 'GBP',
//    'amount' => 1000,
//    'type' => 'GOODS',
//    'uniqueReference' => 'TEST' . rand(0, 10000)
//]);
//
//var_dump($payment->getRedirectUri());



