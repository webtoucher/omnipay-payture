<?php

namespace Omnipay\Payture\Message;

/**
 */
class CardAddResponse extends AbstractResponse
{
    /**
     * @inheritdoc
     */
    public function getTransactionReference()
    {
        return isset($this->data['sessionId']) ? $this->data['sessionId'] : null;
    }

    /**
     * @inheritdoc
     */
    public function isRedirect()
    {
        return $this->isSuccessful();
    }

    /**
     * @inheritdoc
     */
    public function getRedirectData()
    {
        return $this->isRedirect() ? ['sessionId' => $this->data['sessionId']] : [];
    }
}
