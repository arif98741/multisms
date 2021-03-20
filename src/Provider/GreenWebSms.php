<?php


namespace Xenon\Provider;


class GreenWebSms extends AbstractProvider
{
    public function sendRequest()
    {
        $to = "017xxxxxxx,+88016xxxxxxx";
        $token = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
        $message = "Test SMS From Using API";

        $url = "http://api.greenweb.com.bd/api.php?json";

        $data= array(
            'to'=>"$to",
            'message'=>"$message",
            'token'=>"$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
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

    /**
     * @return mixed
     */
    public function errorException()
    {
        // TODO: Implement errorException() method.
    }
}