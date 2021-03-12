<?php


namespace Arif98741\Xenon\Provider;


class BDBulkSms implements ProviderRoadmap
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
        $token = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
        $message = "Test SMS From Using API";

        $url = "http://api.greenweb.com.bd/api2.php";


        $data = array(
            'to' => "$to", //accept comma seperate number
            'message' => "$message",
            'token' => "$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);

//Result
        echo $smsresult;

//Error Display
        echo curl_error($ch);
    }

    /**
     * @return mixed
     */
    public function generateReport()
    {
        // TODO: Implement generateReport() method.
    }
}