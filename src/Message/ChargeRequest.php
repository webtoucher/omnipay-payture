<?php

namespace Omnipay\Payture\Message;

use BorislavSabev\SimpleXmlLoader\Exception\XmlLoaderException;
use BorislavSabev\SimpleXmlLoader\XmlLoader;
use Omnipay\Payture\Exception\ParserException;
use Omnipay\Payture\Exception\ProtocolException;
use Omnipay\Payture\Exception\SystemError;

/**
 */
class ChargeRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = parent::getData();

        $data['Password'] = $this->getSecretKey();
        $data['OrderId'] = $this->getOrderId();
        if (null !== $this->getAmount()) {
            $data['Amount'] = $this->getAmountInteger();
        }
        $data['ProjectName'] = $this->getProjectName();

        return $data;
    }

    /**
     * @inheritdoc
     * @throws ProtocolException
     * @throws ParserException
     */
    protected function createResponse($data)
    {
        try {
            $response = (new XmlLoader())->loadString($data, 'SimpleXMLElement', LIBXML_NOWARNING)->attributes();
        } catch (XmlLoaderException $e) {
            throw new ParserException('Response parser error', $data);
        }
        $responseData = ['code' => SystemError::SUCCESS];

        if (strcasecmp($response->Success, 'true') !== 0) {
            throw new ProtocolException($response->ErrCode);
        }

        return new ChargeResponse($this, $responseData);
    }

    /**
     * @inheritdoc
     */
    public function getEndpoint()
    {
        return "{$this->getBaseEndpoint()}/Charge";
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }
}
