<?php


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Xenon\Provider\BDBulkSms;
use Xenon\Provider\SslSms;
use Xenon\Sender;


require 'vendor/autoload.php';

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();


$sender = Sender::getInstance();

$response = $sender->selectProvider(BDBulkSms::class)
    ->setConfig(
        [
            'token' => 'testusername'
        ]
    )->setMessage('hello')
    ->setMobile('01750840217')
    ->send();
var_dump($response);

