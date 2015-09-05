<?php
namespace Payu\Builder;

use Payu\Component\Refund;
use Payu\Request\RefundRequest;
use Payu\Serializer\RefundRequestSerializer;
use Payu\Validator\RefundValidator;

class RefundRequestBuilder extends BuilderAbstract
{
    /**
     * @var \Payu\Component\Refund
     */
    protected $refund;

    public function setRefund(Refund $refund)
    {
        $this->refund = $refund;
        return $this;
    }

    public function buildRefund(
        $merchant=null,
        $orderRef=null,
        $orderAmount=null,
        $orderCurrency=null,
        $irnDate=null,
        $amount=null,
        $loyaltyPointsAmount=null
    ) {
        $this->refund = new Refund(
            $merchant,
            $orderRef,
            $orderAmount,
            $orderCurrency,
            $irnDate,
            $amount,
            $loyaltyPointsAmount
        );
        return $this;
    }

    /**
     * @return \Payu\Response\ResponseAbstract
     */
    public function build()
    {
        $request = new RefundRequest($this->refund);

        $validator = new RefundValidator($request);
        $validator->validate();

        $serializer = new RefundRequestSerializer($request, $this->configuration);
        $rawData = $serializer->serialize();

        $request->setRawData($rawData);

        return $request;
    }
}