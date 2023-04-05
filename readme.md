xenon/multisms is a universal sms sending library specially for Bangladesh. <br> You can integrate this library in your php application easily for sending sms to any Bangladeshi mobile number. <strong>This is for raw php as well.</strong>


### Installation

```
composer require xenon/multisms
```

### Sample Code

<pre>
use Xenon\Multisms\Provider\BulkSmsBD;
use Xenon\Multisms\Sender;

require 'vendor/autoload.php';

$sender = Sender::getInstance();
try {
    $response = $sender->selectProvider(BulkSmsBD::class)
            ->setConfig(['username' => '017555XYZAB', 'password' => 'XXXXX'])
            ->setMessage('hello')
            ->setMobile('017XXXXXXX')
            ->send();
    var_dump($response);
} catch (Exception $e) {
    var_dump($e->getMessage());
}

</pre>


#### Currently Supported SMS Gateways
* BDBulkSMS
* BulkSMSBD
* MDLSMS
* OnnoRokomSMS
* SSLSms
* MIMSMS

 We are continuously working in this open source library for adding more Bangladeshi sms gateway. If you fee something is missing then make a issue regarding that.
If you want to contribute in this library, then you are highly welcome to do that.

