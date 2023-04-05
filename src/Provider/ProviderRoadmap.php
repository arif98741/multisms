<?php


namespace Xenon\Multisms\Provider;


interface ProviderRoadmap
{
    public function getData();

    public function setData();

    public function sendRequest();

    public function generateReport($result, $data);

    public function errorException();
}