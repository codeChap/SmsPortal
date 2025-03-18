<?php

require 'vendor/autoload.php';

$apiKey       = file_get_contents(realpath(__DIR__ . '/../../') . '/SMS-API-KEY.txt');
$apiKeySecret = file_get_contents(realpath(__DIR__ . '/../../') . '/SMS-API-KEY-SECRET.txt');
$number       = file_get_contents(realpath(__DIR__ . '/../../') . '/SMS-NUMBER.txt');


use Codechap\SmsPortal\Sms;

$sms = new Sms();
$sms->set('clientId', $apiKey);
$sms->set('clientSecret', $apiKeySecret);
$sms->send($number, 'Hello World Test');
