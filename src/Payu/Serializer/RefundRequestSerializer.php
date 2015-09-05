<?php
namespace Payu\Serializer;

class RefundRequestSerializer extends SerializerAbstract
{
    /**
     * @return serialize
     */
    public function serialize()
    {
        /** @var $refund \Payu\Component\Refund */
        $refund = $this->request->getRefund();
        $concatenatedData = array(
            'MERCHANT'              => $this->configuration->getMerchantId(),
            'ORDER_REF'             => $refund->getOrderRef(),
            'ORDER_AMOUNT'          => $refund->getOrderAmount(),
            'ORDER_CURRENCY'        => $refund->getOrderCurrency(),
            'IRN_DATE'              => $refund->getIrnDate(),
            'AMOUNT'                => $refund->getAmount(),
            'LOYALTY_POINTS_AMOUNT' => $refund->getLoyaltyPointsAmount()
        );
        $filteredData = array_filter($concatenatedData);
        $filteredData['ORDER_HASH'] = $this->calculateHash($filteredData, false);

        return $filteredData;
    }
}