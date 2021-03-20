<?php


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Xenon\Provider\SslSms;
use Xenon\Sender;


require 'vendor/autoload.php';

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();


$sender = Sender::getInstance();
try {
    $response = $sender->selectProvider(SslSms::class)
        ->setConfig(
            [
                'api_token' => 'TDKHXKHljDLLKDFLKJDKFJLKJDFLKJDK',
                'sid' => 'TESTSID',
                'csms_id' => '12345678',
            ]
        )->setMessage('hello')
        ->setMobile('0171ABBCCDD')
        ->send();
    var_dump($response);
} catch (Exception $e) {
    var_dump($e->getMessage());
}

