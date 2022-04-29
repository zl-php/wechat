<?php
namespace Zuogechengxu\Wechat\Kernel\Exceptions;

class Exception extends \Exception
{
    public $raw = [];

    public function __construct($message, $code = 40001, $raw = [])
    {
        $this->raw = is_array($raw) ? $raw : [];

        parent::__construct($message, intval($code));
    }

}