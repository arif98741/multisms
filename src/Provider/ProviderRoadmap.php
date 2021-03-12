<?php


namespace Arif98741\Xenon\Provider;


interface ProviderRoadmap
{
    public function getData();

    public function setData();

    public function sendRequest();

    public function generateReport($result, $data);
}