<?php

namespace Omnipay\Payture\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

/**
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * @inheritdoc
     */
    public function sendData($data)
    {
        $httpRequest = $this->httpClient->get($this->getEndpoint() . '?' . http_build_query($data, '', '&'));
        $httpResponse = $httpRequest->send();

        return $this->createResponse($httpResponse->getBody());
    }

    /**
     * @param mixed $data
     * @return ResponseInterface
     */
    abstract protected function createResponse($data);

    /**
     * @inheritdoc
     */
    public function getData()
    {
        return [
            'VWID' => $this->getKey(),
        ];
    }

    abstract public function getEndpoint();

    /**
     * @return string
     */
    public function getBaseEndpoint()
    {
        return $this->getParameter('baseEndpoint');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setBaseEndpoint($value)
    {
        return $this->setParameter('baseEndpoint', $value);
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->getParameter('key');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    /**
     * @return string
     */
    public function getProjectName()
    {
        return $this->getParameter('projectName');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setProjectName($value)
    {
        return $this->setParameter('projectName', $value);
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }
}
