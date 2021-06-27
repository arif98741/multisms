<?php


namespace Xenon\Provider;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Xenon\Handler\XenonException;
use Xenon\Sender;
use function Couchbase\defaultDecoder;

class DianaHost extends AbstractProvider
{
    /**
     * BulkSmsBD constructor.
     * @param Sender $sender
     */
    public function __construct(Sender $sender)
    {
        $this->senderObject = $sender;
    }

    /**
     * Send Request To Api and Send Message
     */
    public function sendRequest(): array
    {
        /*$url = "http://66.45.237.70/api.php";
        $number = $this->senderObject->getMobile();
        $text = $this->senderObject->getMessage();
        $config = $this->senderObject->getConfig();

        $data = array(
            'username' => $config['username'],
            'password' => $config['password'],
            'number' => $number,
            'message' => $text
        );
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsResult = curl_exec($ch);
        curl_close($ch);
        return $this->generateReport($smsResult, $data);*/
        $number = $this->senderObject->getMobile();
        $text = $this->senderObject->getMessage();
        $config = $this->senderObject->getConfig();

        $client = new Client([
            'base_uri' => 'http://esms.dianahost.com/smsapi',
            'timeout' => 10.0,
        ]);

        $response = $client->request('GET', '', [
            'query' => [
                'api_key' => $config['api_key'],
                'type' => $config['type'],
                'senderid' => $config['senderid'],
                'contacts' => $number,
                'msg' => $text,
            ]
        ]);
        $body = $response->getBody();
        $x = $body->getContents();
        echo '<pre>';
        print_r($x);
        echo '</pre>';
        die;
    }

    /**
     * @throws XenonException
     */
    public function errorException()
    {
        if (!is_array($this->senderObject->getConfig())) {
            throw new XenonException('Configuration is not provided. Use setConfig() in method chain');
        }
        if (!array_key_exists('api_key', $this->senderObject->getConfig())) {
            throw new XenonException('api_key is absent in configuration');
        }
        if (!array_key_exists('type', $this->senderObject->getConfig())) {
            throw new XenonException('type key is absent in configuration');
        }
        if (!array_key_exists('senderid', $this->senderObject->getConfig())) {
            throw new XenonException('senderid key is absent in configuration');
        }
        if (!array_key_exists('contacts', $this->senderObject->getConfig())) {
            throw new XenonException('contacts key is absent in configuration');
        }
        if (!array_key_exists('msg', $this->senderObject->getConfig())) {
            throw new XenonException('msg key is absent in configuration');
        }

        if (strlen($this->senderObject->getMobile()) > 11 || strlen($this->senderObject->getMobile()) < 11) {
            throw new XenonException('Invalid mobile number. It should be 11 digit');
        }
        if (empty($this->senderObject->getMessage())) {
            throw new XenonException('Message should not be empty');
        }
    }

    /**
     * @param $result
     * @param $data
     * @return array
     */
    public function generateReport($result, $data): array
    {
        return [
            'status' => 'response',
            'response' => $result,
            'provider' => self::class,
            'send_time' => date('Y-m-d H:i:s'),
            'mobile' => $data['number'],
            'message' => $data['message']
        ];
    }
}