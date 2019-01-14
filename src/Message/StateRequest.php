<?php

namespace Omnipay\Payture\Message;

use BorislavSabev\SimpleXmlLoader\Exception\XmlLoaderException;
use BorislavSabev\SimpleXmlLoader\XmlLoader;
use Omnipay\Payture\Exception\ParserException;
use Omnipay\Payture\Exception\ProtocolException;
use Omnipay\Payture\Exception\SystemError;

/**
 */
class StateRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = parent::getData();

        $data['DATA'] = \urldecode(\http_build_query($this->getRequestParams(), '', ';'));

        return $data;
    }

    /**
     * @inheritdoc
     */
    private function getRequestParams()
    {
        return [
            'OrderId' => $this->getOrderId(),
        ];
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

        if (strcasecmp($response->Success, 'true') !== 0) {
            throw new ProtocolException($response->ErrCode);
        }

        $data = (array) $response;
        return new StateResponse($this, $data['@attributes']);
    }

    /**
     * @inheritdoc
     */
    public function getEndpoint()
    {
        return "{$this->getBaseEndpoint()}/PayStatus";
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
