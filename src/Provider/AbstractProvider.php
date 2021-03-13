<?php


namespace Xenon\Provider;


abstract class AbstractProvider implements ProviderRoadmap
{
    protected $senderObject;

    public function getData()
    {
        // TODO: Implement setData() method.

    }

    public function setData()
    {
        // TODO: Implement setData() method.
    }

    abstract public function sendRequest();

    /**
     * @param $result
     * @param $data
     * @return mixed
     */
    abstract public function generateReport($result, $data);

    /**
     * @return mixed
     */
    public function errorException()
    {
        // TODO: Implement errorException() method.
    }
}