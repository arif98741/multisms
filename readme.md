Xenon is a universal sms sending library specially for Bangladesh. <br> You can integrate this library in your php application easily for sending sms to any Bangladeshi mobile number.
Currently, **xenon** library is supporting _BulkSMSBD_,_MDLSms_. We are working for making it better and continuously adding more sms support for Bangladesh.


###Installation

```
composer require arif98741/xenon
```

###Sample Code

```
<?php

use Arif98741\Xenon\Sender;

require 'vendor/autoload.php';

$sender = Sender::getInstance();
$sender->setProvider('bulksmsbd')
    ->setConfig(
        [
            'username' => 'usernametest',
            'password' => 'sflkdjslkf'
        ]
    )->setMessage('hello guys')
    ->setMobile('0171XXYYZZ')
    ->send();
```