<?php

namespace Omnipay\Payture\Message;

/**
 */
class CompletePurchaseResponse extends AbstractResponse
{
    public function isPaymentCharged()
    {
        return isset($this->data['paymentStatus']) && $this->data['paymentStatus'] === 'Charged';
    }

    public function isPaymentRejected()
    {
        return isset($this->data['paymentStatus']) && $this->data['paymentStatus'] === 'Rejected';
    }
}
