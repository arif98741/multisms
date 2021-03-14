Xenon is a universal sms sending library specially for Bangladesh. <br> You can integrate this library in your php application easily for sending sms to any Bangladeshi mobile number.


### Installation

```
composer require arif98741/xenon
```

### Sample Code

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

### Currently Supported Gateways
* BulkSMSBD
* MDLSMS

We are continuously working in this open source library for adding more Bangladeshi sms gateway. If you fee something is missing then make a issue regarding that. 
If you want to contribute in this library, then you are highly welcome to do that.
