<?php

namespace Omnipay\Payture\Message;

use BorislavSabev\SimpleXmlLoader\Exception\XmlLoaderException;
use BorislavSabev\SimpleXmlLoader\XmlLoader;
use Omnipay\Payture\Exception\ParserException;
use Omnipay\Payture\Exception\SystemError;
use Omnipay\Payture\StoredCreditCard;

/**
 */
class CardGetListRequest extends AbstractUserRequest
{
    /**
     * @inheritdoc
     */
    public function getRequestParams()
    {
        return [
            'VWUserLgn' => $this->getUserLogin(),
            'VWUserPsw' => $this->getUserPassword(),
            'ProjectName' => $this->getProjectName(),
        ];
    }

    /**
     * @inheritdoc
     * @throws ParserException
     */
    protected function createResponse($data)
    {
        try {
            $response = (new XmlLoader())->loadString($data, 'SimpleXMLElement', LIBXML_NOWARNING);
        } catch (XmlLoaderException $e) {
            throw new ParserException('Response parser error', $data);
        }
        $responseData = [
            'code' => SystemError::SUCCESS,
            'cards' => [],
        ];

        if (strcasecmp($response->attributes()->Success, 'true') === 0) {
            foreach ($response->xpath('./Item') as $item) {
                $responseData['cards'][] = new StoredCreditCard(\array_map('strval', \iterator_to_array($item->attributes())));
            }
        } else {
            $responseData['code'] = (string) $response->attributes()->ErrCode;
        }

        return new CardGetListResponse($this, $responseData);
    }

    /**
     * @inheritdoc
     */
    public function getEndpoint()
    {
        return "{$this->getBaseEndpoint()}/GetList";
    }
}
