<?php


use Xenon\Provider\BulkSmsBD;
use Xenon\Provider\MDLSms;
use Xenon\Sender;

require 'vendor/autoload.php';

$sender = Sender::getInstance();
try {
    $response = $sender->selectProvider(MDLSms::class)
        ->setConfig(
            [
                'api_key' => '77943',
                'type' => 'text',
                'senderid'=> '8809612441118'
            ])
        ->setMessage('hello')
        ->setMobile('01750840217')
        ->send();
    echo json_encode($response);
    exit;
} catch (Exception $e) {
    var_dump($e->getMessage());
}

