<?php


namespace Arif98741\Xenon\Handler;


class XenonException extends \Exception
{
    protected $message;
    protected $code;

    public function __construct($message, $code = null)
    {
        parent::__construct($message, $code);
    }

    /**
     * @return array
     */
    public function showException($object = null): array
    {
        $bt = debug_backtrace();
        $exception = [
            'exception' => $this->getMessage(),
            'working_on' => $object->getProvider(),
            'used_file' => [
                'file' => $bt[0]['file'] . ' at line: ' . $bt[0]['line'],
                'class' => $bt[1]['class'],
                'method' => $bt[1]['function'] . '()',
                'called by' => $this->getCaller()
            ]
        ];
        echo '<pre>';
        print_r($exception);
        echo '<pre>';
        exit;
    }

    /**
     * Gets the caller of the function where this function is called from
     * @param string what to return? (Leave empty to get all, or specify: "class", "function", "line", "class", etc.) - options see: http://php.net/manual/en/function.debug-backtrace.php
     * @return mixed
     */
    private function getCaller($what = NULL)
    {
        $trace = debug_backtrace();
        $previousCall = $trace[2]; // 0 is this call, 1 is call in previous function, 2 is caller of that function

        if (isset($what)) {
            return $previousCall[$what];
        } else {
            return $previousCall;
        }
    }

}