<?php


namespace Arif98741\Xenon\Provider;


use Arif98741\Xenon\Sender;

class Sms4BD implements ProviderRoadmap
{
    private $senderObject;

    /**
     * Sms4BD constructor.
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

    public function sendRequest()
    {
        // TODO: Implement sendRequest() method.
    }

    /**
     * @param $result
     * @param $data
     * @return mixed
     */
    public function generateReport($result, $data)
    {
        // TODO: Implement generateReport() method.
    }
}