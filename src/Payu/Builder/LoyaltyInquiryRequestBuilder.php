<?php
namespace Payu\Builder;

use Payu\Configuration,
    Payu\Component\Currency,
    Payu\Request\LoyaltyInquiryRequest,
    Payu\Validator\LoyaltyInquiryRequestValidator,
    Payu\Serializer\LoyaltyInquiryRequestSerializer;

class LoyaltyInquiryRequestBuilder extends BuilderAbstract
{
    /**
     * @var \Payu\Component\Currency
     */
    private $currency;

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param Currency $currency
     */
    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
    }

    public function buildCurrency($currency) {
        $this->currency = new Currency($currency);
        return $this;
    }

    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration);
    }

    public function build()
    {
        $request = new LoyaltyInquiryRequest($this->card, $this->currency);

        $validator = new LoyaltyInquiryRequestValidator($request);
        $validator->validate();

        $serializer = new LoyaltyInquiryRequestSerializer($request, $this->configuration);
        $rawData = $serializer->serialize();

        $request->setRawData($rawData);

        return $request;
    }
}