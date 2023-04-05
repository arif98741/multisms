<?php

namespace Xenon\Multisms\Provider;


use Xenon\Multisms\Handler\XenonException;
use Xenon\Multisms\Sender;

class Mim extends AbstractProvider
{
    /**
     * Mim SMS constructor.
     * @param Sender $sender
     */
    public function __construct(Sender $sender)
    {
        $this->senderObject = $sender;
    }

    /**
     * Send Request To Api and Send Message
     * @throws XenonException
     */
    public function sendRequest(): array
    {
        $url = "https://mimsms.com.bd/smsAPI";
        $number = $this->formatNumber($this->senderObject->getMobile());
        $text = $this->senderObject->getMessage();
        $config = $this->senderObject->getConfig();

        $data = [
            'sendsms'   => '',
            'apikey'    => $config['apikey'],
            'apitoken'  => $config['apitoken'],
            'from'      => $config['senderid'],
            'type'      => 'sms',
            'to'        => $number,
            'text'      => $text
        ];
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsResult = curl_exec($ch);
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
        if (!is_array($this->senderObject->getConfig())) {
            throw new XenonException('Configuration is not provided. Use setConfig() in method chain');
        }
        if (!array_key_exists('apikey', $this->senderObject->getConfig())) {
            throw new XenonException('apikey is absent in configuration');
        }
        if (!array_key_exists('apitoken', $this->senderObject->getConfig())) {
            throw new XenonException('apitoken is absent in configuration');
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
            'status'    => 'response',
            'response'  => $result,
            'provider'  => self::class,
            'send_time' => date('Y-m-d H:i:s'),
            'mobile'    => $data['to'],
            'message'   => $data['text']
        ];
    }
}