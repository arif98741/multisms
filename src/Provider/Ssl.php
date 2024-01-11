<?php


namespace Xenon\Multisms\Provider;


use Xenon\Multisms\Handler\XenonException;
use Xenon\Multisms\Sender;

class Ssl extends AbstractProvider
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
        $mobile = $this->formatNumber($this->senderObject->getMobile());
        $config = $this->senderObject->getConfig();

        $apiToken = $config['api_token'];
        $sid = $config['sid'];
        $csms_id = $config['csms_id'];

        $data = [
            'api_token' => $apiToken,
            'sid'       => $sid,
            'msisdn'    => $mobile,
            'sms'       => $this->senderObject->getMessage(),
            'csms_id'   => $csms_id
        ];

        $url = "https://smsplus.sslwireless.com/api/v3/send-sms";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsResult = curl_exec($ch);
        if ($smsResult == false) {
            $smsResult = curl_error($ch);
        }
        curl_close($ch);
        return $this->generateReport($smsResult, $data);
    }

    /**
     * For mobile number
     * @param $mobile
     * @return string
     */
    private function formatNumber($mobile): string
    {
        if (mb_substr($mobile, 0, 2) == '01') {
            $number = $mobile;
        } elseif (mb_substr($mobile, 0, 2) == '88') {
            $number = str_replace('88', '', $mobile);
        } elseif (mb_substr($mobile, 0, 3) == '+88') {
            $number = str_replace('+88', '', $mobile);
        }
        return '88' . $number;
    }

    /**
     * @throws XenonException
     */
    public function errorException()
    {
        if (!is_array($this->senderObject->getConfig()))
            throw new XenonException('Configuration is not provided. Use setConfig() in method chain');

        if (!array_key_exists('api_token', $this->senderObject->getConfig()))
            throw new XenonException('api_token key is absent in configuration');

        if (!array_key_exists('sid', $this->senderObject->getConfig()))
            throw new XenonException('sid key is absent in configuration');

        if (!array_key_exists('csms_id', $this->senderObject->getConfig()))
            throw new XenonException('csms_id key is absent in configuration');

        if (strlen($this->senderObject->getMobile()) > 11 || strlen($this->senderObject->getMobile()) < 11)
            throw new XenonException('Invalid mobile number. It should be 11 digit');

        if (empty($this->senderObject->getMessage()))
            throw new XenonException('Message should not be empty');
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
            'mobile' => $data['msisdn'],
            'message' => $data['sms']
        ];
    }
}
