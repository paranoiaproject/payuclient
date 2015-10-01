<?php

namespace Payu\Serializer;

use Payu\Request\LoyaltyInquiryRequest;

/**
 * @property LoyaltyInquiryRequest $request
 */
class LoyaltyInquiryRequestSerializer extends SerializerAbstract
{
    /**
     * @return array
     */
    public function serialize()
    {
        $concatenatedData = array_merge(
            array(
                'MERCHANT' => $this->configuration->getMerchantId(),
                'CURRENCY' => $this->request->getCurrency()->getCode(),
                'DATE' => $this->request->getDate(),
            ),
            $this->serializeCard()
        );
        $filteredData = array_filter($concatenatedData);
        $filteredData['HASH'] = $this->calculateHash($filteredData);

        return $filteredData;
    }
}