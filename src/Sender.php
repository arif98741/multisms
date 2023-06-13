<?php


namespace Xenon\Multisms;


use Exception;
use Xenon\Multisms\Handler\XenonException;

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
        if (!is_array($config)) {
            throw  new XenonException('config must be an array');
        }

        $this->config = $config;

        return $this;
    }


    /**
     * Send Message Finally
     * @throws XenonException
     */
    public function send()
    {
        try {
            $this->provider->errorException();
            return $this->provider->sendRequest();
        } catch (XenonException $exception) {
            throw new XenonException($exception->getMessage());
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
     * @throws XenonException
     */
    public function setProvider($provider): Sender
    {
        if (!class_exists($provider)) {
            throw new XenonException('Provider ' . $provider . ' not found');
        }

        $this->provider = new $provider($this);

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