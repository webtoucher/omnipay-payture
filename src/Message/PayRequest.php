<?php

namespace Omnipay\Payture\Message;

use BorislavSabev\SimpleXmlLoader\Exception\XmlLoaderException;
use BorislavSabev\SimpleXmlLoader\XmlLoader;
use Omnipay\Payture\Exception\ParserException;
use Omnipay\Payture\Exception\ProtocolException;
use Omnipay\Payture\Exception\SystemError;

/**
 */
class PayRequest extends AbstractUserRequest
{
    /**
     * @inheritdoc
     */
    public function getRequestParams()
    {
        $params = [
            'SessionType' => $this->getSessionType(),
            'CardId' => $this->getCardId(),
            'OrderId' => $this->getOrderId(),
            'Amount' => $this->getAmountInteger(),
            'IP' => $this->getClientIp(),
            'Phone' => $this->getPhone(),
            'Email' => $this->getEmail(),
            'VWUserLgn' => $this->getUserLogin(),
            'VWUserPsw' => $this->getUserPassword(),
            'ProjectName' => $this->getProjectName(),
        ];
        if ($phone = $this->getPhone()) {
            $params['PhoneNumber'] = $phone;
        }
        return $params;
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

        return new PayResponse($this, $responseData);
    }

    /**
     * @inheritdoc
     */
    public function getEndpoint()
    {
        return "{$this->getBaseEndpoint()}/Pay";
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

    /**
     * @param string $value
     * @return $this
     */
    public function setSessionType($value)
    {
        return $this->setParameter('sessionType', $value);
    }

    /**
     * @return string
     */
    public function getSessionType()
    {
        return $this->getParameter('sessionType') ?: 'Pay';
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPhone($value)
    {
        return $this->setParameter('phone', $value);
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->getParameter('phone');
    }

    /**
     * @return string
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCardId($value)
    {
        return $this->setParameter('cardId', $value);
    }

    /**
     * @return string
     */
    public function getCardId()
    {
        return $this->getParameter('cardId');
    }
}
