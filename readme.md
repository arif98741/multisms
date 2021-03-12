Xenon is a universal sms sending library specially for Bangladesh. <br> You can integrate this library in your php application easily for sending sms to any Bangladeshi mobile number.
##Installation
```
composer require arif98741/xenon
```
<br>
##Sample Code
<br>
<pre>
<?php

use Arif98741\Xenon\Sender;

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
</pre>
