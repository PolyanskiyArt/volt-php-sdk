<?php

/**
 * The content generated in this file is generated from the official documentation.
 * @link https://docs.volt.io/docs/notifications/signature
 */

use LJJackson\Volt\Webhooks\RequestVerifier;

require __DIR__ . '/../vendor/autoload.php';

$secret = '12345';
$expected = '48187b77f45bf32c375ba00e94c6dce4db84d89b1629ee199067094fd7319ceb';
$time = '20200131123456';
$userAgent = 'Volt/1.0';
$version = explode('/', $userAgent)[1];
$content = 'Test_Body';

$verifier = new RequestVerifier($content, $time, $secret, $version, $expected);

if ($verifier->isValid()) {
    echo 'worked';
    exit;
}

echo 'not work';