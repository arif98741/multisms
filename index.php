<?php


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Xenon\Provider\GreenWebSms;
use Xenon\Sender;


require 'vendor/autoload.php';

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();


$sender = Sender::getInstance();

$response = $sender->selectProvider(GreenWebSms::class)
    ->setConfig(
        [
            'to' => '01XXXXXXXXX',
            'token' => '17bb233cXXX-924e-XXXXX-86d5-XXXXX',
        ]
    )->setMessage('hello')
    ->setMobile('01750840217')
    ->send();
var_dump($response);

