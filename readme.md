Xenon is a universal sms sending library specially for Bangladesh. <br> You can integrate this library in your php application easily for sending sms to any Bangladeshi mobile number.
<br>
##Installation
```
composer require arif98741/xenon
```
<br>
##Sample Code
<br>
<pre>
use Xenon\Provider\BulkSmsBD;
use Xenon\Sender;


require 'vendor/autoload.php';


$sender = Sender::getInstance();
try {
$response = $sender->selectProvider(BulkSmsBD::class)
->setConfig(['username' => '017555', 'password' => 'XXXXX'])
->setMessage('hello')
->setMobile('017XXXXXXX')
->send();
var_dump($response);
} catch (Exception $e) {
var_dump($e->getMessage());
}
</pre>
