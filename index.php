<?php


use Xenon\Provider\BulkSmsBD;
use Xenon\Provider\MDLSms;
use Xenon\Sender;

require 'vendor/autoload.php';

$sender = Sender::getInstance();
try {
    $response = $sender->selectProvider(BulkSmsBD::class)
        ->setConfig(
            [
                'username' => '017555',
                'password'=> 'XXXXX'
            ])
        ->setMessage('hello')
        ->setMobile('01750840217')
        ->send();
    echo json_encode($response);
    exit;
} catch (Exception $e) {
    var_dump($e->getMessage());
}

