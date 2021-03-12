<?php


namespace Arif98741\Xenon;


use Arif98741\Xenon\Handler\XenonException;
use Arif98741\Xenon\Provider\Alpha;
use Arif98741\Xenon\Provider\BulkSms;
use Arif98741\Xenon\Provider\BulkSmsBD;
use Arif98741\Xenon\Provider\DnsBd;
use Arif98741\Xenon\Provider\GreenWebSms;
use Arif98741\Xenon\Provider\MimSms;
use Arif98741\Xenon\Provider\OnnorokomSms;
use Arif98741\Xenon\Provider\Sms4BD;
use Exception;

class Sender
{
    private $provider;
    private $message;
    private $mobile;
    private $config;

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     * @return Sender
     * @throws Exception
     */
    public function setConfig($config): Sender
    {
        try {
            if (!is_array($config)) {
                throw  new XenonException('config must be an array');
            }
            $this->config = $config;
        } catch (XenonException $e) {
            $e->showException();
        }
        return $this;
    }


    /**
     * Send Message Finally
     */
    public function send()
    {
        try {
            if (empty($this->provider)) {
                throw new XenonException('Select a provider first. Use setProvider() method for setting');
            }
        } catch (XenonException $exception) {
            $exception->showException($this);
        }

        switch ($this->provider) {
            case 'alpha':
                $provider = new Alpha($this);
                break;
            case 'bulksmsbd':
                $provider = new BulkSmsBD($this);
                break;
            case 'bulksms':
                $provider = new BulkSms($this);
                break;
            case 'dnsbd':
                $provider = new DnsBd($this);
                break;
            case 'greenwebsms':
                $provider = new GreenWebSms($this);
                break;
            case 'mimsms':
                $provider = new MimSms($this);
                break;
            case 'sms4bd':
                $provider = new Sms4BD($this);
                break;
            case 'onnorokomsms':
                $provider = new OnnorokomSms($this);
                break;

            default:
                echo 'something';
        }
        $provider->sendRequest();
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     * @return Sender
     */
    public function setMobile($mobile): Sender
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message = ''): Sender
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param mixed $provider
     * @return Sender
     */
    public function setProvider($provider): Sender
    {
        $this->provider = $provider;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

}