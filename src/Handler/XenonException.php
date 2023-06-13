<?php


namespace Xenon\Multisms\Handler;

class XenonException extends \Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        // Call the parent constructor
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}
