<?php


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Xenon\Provider\BDBulkSms;
use Xenon\Provider\DianaHost;
use Xenon\Provider\SslSms;
use Xenon\Sender;


require 'vendor/autoload.php';

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();


$sender = Sender::getInstance();

try {
    $response = $sender->selectProvider(DianaHost::class)
        ->setConfig(
            [
                'api_key' => 'api_key',
                'type' => 'type',
                'senderid' => 'senderid',
                'contacts' => '017517',
                'msg' => 'hello',
            ]
        )->setMessage('hello')
        ->setMobile('01750840217')
        ->send();
    var_dump($response);
} catch (Exception $e) {
    echo $e->getMessage();
}

