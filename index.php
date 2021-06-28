<?php


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

use Xenon\Provider\DianaHost;
use Xenon\Provider\GreenWeb;
use Xenon\Provider\Ssl;

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
                'api_key' => 'R60004473.85413693',
                'type' => 'type',
                'senderid' => 'MEDIABD',
            ]
        )->setMessage('hello')
        ->setMobile('0173344')
        ->send();
    var_dump($response);
} catch (Exception $e) {
    echo $e->getMessage();
}




