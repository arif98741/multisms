<?php


use Xenon\Sender;

require 'vendor/autoload.php';

$sender = new Sender();
$sender->setProvider('bulksmsbd')
    ->setConfig(
        [
            'username' => 'usernametest',
            'password' => 'sflkdjslkf'
        ]
    )->setMessage('hi')
    ->setMobile('017111111')
    ->send();
