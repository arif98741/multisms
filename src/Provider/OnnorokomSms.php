<?php


namespace Xenon\Provider;


use SoapClient;

class OnnorokomSms extends AbstractProvider
{

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
        try {
            $soapClient = new SoapClient("https://api2.onnorokomsms.com/sendsms.asmx?wsdl");
            $paramArray = array(
                'userName' => "Your User Name",
                'userPassword' => "Your Pass",
                'mobileNumber' => "mobile Number",
                'smsText' => "desired Message",
                'type' => "1",
                'maskName' => "Mask Name",
                'campaignName' => '',
            );
            $value = $soapClient->__call("OneToOne", array($paramArray));
        } catch (dmException $e) {
            // echo $e;
        }
    }

    /**
     * @return mixed
     */
    public function generateReport()
    {
        // TODO: Implement generateReport() method.
    }

    /**
     * @return mixed
     */
    public function errorException()
    {
        // TODO: Implement errorException() method.
    }
}