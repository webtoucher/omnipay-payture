<?php

namespace Omnipay\Payture\Message;

use BorislavSabev\SimpleXmlLoader\Exception\XmlLoaderException;
use BorislavSabev\SimpleXmlLoader\XmlLoader;
use Omnipay\Payture\Exception\ParserException;
use Omnipay\Payture\Exception\ProtocolException;
use Omnipay\Payture\Exception\SystemError;

/**
 */
class UserRegisterRequest extends AbstractUserRequest
{
    /**
     * @inheritdoc
     */
    public function getRequestParams()
    {
        $params = [
            'VWUserLgn' => $this->getUserLogin(),
            'VWUserPsw' => $this->getUserPassword(),
            'Email' => $this->getEmail(),
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

        return new UserRegisterResponse($this, $responseData);
    }

    /**
     * @inheritdoc
     */
    public function getEndpoint()
    {
        return "{$this->getBaseEndpoint()}/Register";
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
}
