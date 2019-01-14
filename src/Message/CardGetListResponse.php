<?php

namespace Omnipay\Payture\Message;

use Omnipay\Payture\StoredCreditCard;

/**
 */
class CardGetListResponse extends AbstractResponse
{
    /**
     * @return StoredCreditCard[]
     */
    public function getCards()
    {
        return $this->data['cards'];
    }
}
