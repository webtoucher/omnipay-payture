<?php

namespace Omnipay\Payture\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Payture\Exception\SystemError;
use Symfony\Component\HttpFoundation\Request;

/**
 */
abstract class AbstractResponse extends BaseAbstractResponse
{
    public function isSuccessful()
    {
        return $this->data['code'] === SystemError::SUCCESS;
    }

    /**
     * @inheritdoc
     */
    public function getMessage()
    {
        return "payture.{$this->data['code']}";
    }

    /**
     * @inheritdoc
     */
    public function isRedirect()
    {
        return false;
    }

    public function getRedirectMethod()
    {
        return Request::METHOD_GET;
    }

    public function getRedirectUrl()
    {
        return $this->isRedirect() ? $this->data['redirectUrl'] . '?' . http_build_query($this->getRedirectData()) : '';
    }

    public function getRedirectData()
    {
        return [];
    }
}
