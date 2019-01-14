<?php

namespace Omnipay\Payture\Exception;

use Omnipay\Common\Exception\OmnipayException;

/**
 * Payture parser Exception.
 * Thrown when an error is caught from the Payture side.
 */
class ParserException extends \Exception implements OmnipayException
{
    private $data;

    public function __construct($message, $data, \Throwable $previous = null)
    {
        $this->data = $data;
        parent::__construct($message, 0, $previous);
    }

    public function getData()
    {
        return $this->data;
    }
}
