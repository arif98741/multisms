<?php


namespace Xenon;


use Xenon\Handler\XenonException;
use Exception;

class Sender
{
    private $provider;
    private $message;
    private $mobile;
    private $config;
    private static $instance;

    /**
     * Get Class Instance
     * @return Sender
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Sender();
        }
        return self::$instance;
    }

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

            $this->provider->errorException();
            return $this->provider->sendRequest();
        } catch (XenonException $exception) {
            $exception->showException();
        }
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
        return self::getInstance();
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
     * @return Sender
     */
    public function setMessage($message = ''): Sender
    {
        $this->message = $message;
        return self::getInstance();
    }

    /**
     * @param mixed $provider
     * @return Sender
     */
    public function setProvider($provider): Sender
    {
        $this->provider = $provider;
        return self::getInstance();
    }


    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Return this class object
     * @param $ProviderClass
     * @return Sender
     */
    public function selectProvider($ProviderClass): Sender
    {
        try {
            if (!class_exists($ProviderClass)) {
                throw new XenonException('Provider not found');
            }
        } catch (XenonException $exception) {
            $exception->showException($ProviderClass);
        }

        $this->provider = new $ProviderClass($this);
        return $this;
    }


}