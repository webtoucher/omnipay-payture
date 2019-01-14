<?php


namespace Omnipay\Payture;

use Omnipay\Common\Helper;
use Symfony\Component\HttpFoundation\ParameterBag;

class StoredCreditCard
{
    const TYPE_VISA = 'Visa';
    const TYPE_MASTER_CARD = 'MasterCard';
    const TYPE_MAESTRO = 'Maestro';

    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * Create a new CreditCard object using the specified parameters
     *
     * @param array $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     *
     * @return $this
     */
    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag();

        Helper::initialize($this, $parameters);

        return $this;
    }

    public function getParameters()
    {
        return $this->parameters->all();
    }

    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    // NoCVV="false"
    // Expired="false"

    public function setCardName($value)
    {
        return $this->setParameter('cardName', $value);
    }

    public function getCardName()
    {
        return $this->getParameter('cardName');
    }

    public function setPaymentSystem($value)
    {
        return $this->setParameter('paymentSystem', $value);
    }

    public function getPaymentSystem()
    {
        return $this->getParameter('paymentSystem');
    }

    public function setCardId($value)
    {
        return $this->setParameter('cardId', $value);
    }

    public function getCardId()
    {
        return $this->getParameter('cardId');
    }

    public function setCardHolder($value)
    {
        return $this->setParameter('cardHolder', $value);
    }

    public function getCardHolder()
    {
        return $this->getParameter('cardHolder');
    }

    public function setStatus($value)
    {
        return $this->setParameter('status', $value);
    }

    public function getStatus()
    {
        return $this->getParameter('status');
    }

    public function setNoCVV($value)
    {
        return $this->setParameter('noCVV', strcasecmp(var_export($value, true), 'true') === 0);
    }

    public function getNoCVV()
    {
        return $this->getParameter('noCVV');
    }

    public function setExpired($value)
    {
        return $this->setParameter('expired', strcasecmp(var_export($value, true), 'true') === 0);
    }

    public function getExpired()
    {
        return $this->getParameter('expired');
    }

    public function isActive()
    {
        return $this->getStatus() === 'IsActive';
    }

    public function isPayable()
    {
        return !$this->isExpired() && $this->isActive();
    }

    public function isExpired()
    {
        return $this->getParameter('expired');
    }
}
