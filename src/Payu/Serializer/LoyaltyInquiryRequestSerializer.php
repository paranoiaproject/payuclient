<?php
namespace Payu\Serializer;

class LoyaltyInquiryRequestSerializer extends SerializerAbstract
{

    /**
     * @return serialize
     */
    public function serialize()
    {
        $concatenatedData = array_merge(
            $this->serializeCard(),
        );

        $filteredData = array_filter($concatenatedData);
        $filteredData['MERCHANT'] = $this->configuration->getMerchantId();
        $filteredData['ORDER_HASH'] = $this->calculateHash($filteredData);

        return $filteredData;
    }
}