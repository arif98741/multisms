<?php


namespace Arif98741\Xenon\Provider;


class BulkSmsBD implements Defination
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
        $url = "http://66.45.237.70/api.php";
        $number = "880170XXXXXX";
        $text = "Hello Bangladesh";
        $data = array(
            'username' => "usernametest",
            'password' => "%KJD*&%^%%%DF",
            'number' => $number,
            'message' => "This is testing "
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsResult = curl_exec($ch);

    }

    public function generateReport()
    {
        // TODO: Implement generateReport() method.
    }
}