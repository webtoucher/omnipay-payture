<?php

namespace Omnipay\Payture\Message;

/**
 */
abstract class AbstractUserRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     */
    public function getData()
    {
        $data = parent::getData();
        $data['DATA'] = \urldecode(\http_build_query($this->getRequestParams(), '', ';'));
        return $data;
    }

    /**
     * @return array
     */
    abstract public function getRequestParams();

    public function getUserLogin()
    {
        return $this->getParameter('userLogin');
    }

    public function setUserLogin($value)
    {
        return $this->setParameter('userLogin', $value);
    }

    public function getUserPassword()
    {
        return $this->getParameter('userPassword');
    }

    public function setUserPassword($value)
    {
        return $this->setParameter('userPassword', $value);
    }
}
