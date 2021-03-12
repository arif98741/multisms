<?php


namespace Arif98741\Xenon\Provider;


use Arif98741\Xenon\Handler\XenonException;
use Arif98741\Xenon\Sender;

class BulkSmsBD implements ProviderRoadmap
{
    private $senderObject;

    /**
     * BulkSmsBD constructor.
     * @param Sender $sender
     */
    public function __construct(Sender $sender)
    {
        $this->senderObject = $sender;
    }

    public function getData()
    {
        // TODO: Implement getData() method.
    }

    public function setData()
    {
        // TODO: Implement setData() method.
    }

    /**
     * Send Request To Api and Send Message
     */
    public function sendRequest()
    {
        $url = "http://66.45.237.70/api.php";
        $number = $this->senderObject->getMobile();
        $text = $this->senderObject->getMessage();

        try {
            $this->errorException();

        } catch (XenonException $exception) {
            $exception->showException($this->senderObject);
        }
        $config = $this->senderObject->getConfig();

        $data = array(
            'username' => $config['username'],
            'password' => $config['password'],
            'number' => $number,
            'message' => $text
        );
        try {
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsResult = curl_exec($ch);
            $status = $this->generateReport($smsResult, $data);

        } catch (XenonException $exception) {
            $exception->showException();
        }
    }

    /**
     * @throws XenonException
     */
    private function errorException()
    {
        if (!is_array($this->senderObject->getConfig())) {
            throw new XenonException('Configuration is not provided. Use setConfig() in method chain');
        }
        if (!array_key_exists('username', $this->senderObject->getConfig())) {
            throw new XenonException('username key is absent in configuration');
        }
        if (!array_key_exists('password', $this->senderObject->getConfig())) {
            throw new XenonException('password key is absent in configuration');
        }
        if (strlen($this->senderObject->getMobile()) > 11 || strlen($this->senderObject->getMobile()) < 11) {
            throw new XenonException('Invalid mobile number. It should be 11 digit');
        }
        if (empty($this->senderObject->getMessage())) {
            throw new XenonException('Message should not be empty');
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function generateReport($smsResult, $data): array
    {
        return [
            'status' => 'response',
            'response' => $smsResult,
            'send_time' => date('Y-m-d H:i:s'),
            'mobile' => $data['number'],
            'message' => $data['message']
        ];
    }
}