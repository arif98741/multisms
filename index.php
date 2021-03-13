<?php


use Xenon\Provider\BulkSmsBD;
use Xenon\Sender;

require 'vendor/autoload.php';

$sender = Sender::getInstance();
$response = $sender->chooseProvider(BulkSmsBD::class)
    ->setConfig(
        [
            'username' => 'usernametest',
            'password' => 'sflkdjslkf'
        ])->setMessage('hi')
    ->setMobile('01785840214')
    ->send();
var_dump($response);
exit;

