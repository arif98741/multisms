<?php


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Xenon\Provider\OnnorokomSms;
use Xenon\Sender;


require 'vendor/autoload.php';

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();


$sender = Sender::getInstance();

$response = $sender->selectProvider(OnnorokomSms::class)
    ->setConfig(
        [
            'userName' => 'onnorokom',
            'userPassword' => 'LJDF()*D&*FN',
            'type' => 1,
            'maskName' => 'TestMask',
            'campaignName' => 'TestCampaign',
        ]
    )->setMessage('hello')
    ->setMobile('01XXXXXXXX')
    ->send();
var_dump($response);

