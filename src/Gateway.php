<?php

namespace Omnipay\Payture;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Payture';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultParameters()
    {
        return array(
            'gateUrl'     => '',
            'secretKey'   => '',
            'merchantId'  => '',
            'projectName' => '',
        );
    }

    /**
     * @inheritdoc
     */
    public function getGateUrl()
    {
        return $this->getParameter('gateUrl');
    }

    /**
     * @inheritdoc
     */
    public function setGateUrl($value)
    {
        return $this->setParameter('gateUrl', $value);
    }

    /**
     * @inheritdoc
     */
    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    /**
     * @inheritdoc
     */
    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
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

    public function purchase(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\PurchaseRequest', $parameters);
    }

    public function cardAdd(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\CardAddRequest', $parameters);
    }

    public function pay(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\PayRequest', $parameters);
    }

    public function charge(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\ChargeRequest', $parameters);
    }

    public function unblock(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\UnblockRequest', $parameters);
    }

    public function state(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\StateRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Payture\Message\UserRegisterRequest
     */
    public function userRegister(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\UserRegisterRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Payture\Message\UserUpdateRequest
     */
    public function userUpdate(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\UserUpdateRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Payture\Message\UserDeleteRequest
     */
    public function userDelete(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\UserDeleteRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Payture\Message\UserCheckRequest
     */
    public function userCheck(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\UserCheckRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Payture\Message\CardGetListRequest
     */
    public function cardGetList(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\CardGetListRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Payture\Message\CardRemoveRequest
     */
    public function cardActivate(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\CardActivateRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Payture\Message\CardRemoveRequest
     */
    public function cardRemove(array $parameters = array())
    {
        $parameters['baseEndpoint'] = $this->getGateUrl();
        $parameters['key'] = $this->getMerchantId();
        $parameters['projectName'] = $this->getProjectName();

        return $this->createRequest('\Omnipay\Payture\Message\CardRemoveRequest', $parameters);
    }
}
