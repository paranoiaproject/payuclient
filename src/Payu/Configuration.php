<?php
namespace Payu;

class Configuration
{
    /**
     * @var string
     */
    private $merchantId;

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $paymentEndpointUrl;

     /**
     * @var string
     */
    private $returnUrl;

    /**
     * @var string
     */
    private $loyaltyInquiryEndPointUrl;

    public function __construct($merchantId = null, $secretKey = null, $paymentEndpointUrl = null,
                                $loyaltyInquiryEndPointUrl = null, $returnUrl = null)
    {
        $this->merchantId = $merchantId;
        $this->secretKey = $secretKey;
        $this->paymentEndpointUrl = $paymentEndpointUrl;
        $this->loyaltyInquiryEndPointUrl = $loyaltyInquiryEndPointUrl;
        $this->returnUrl = $returnUrl;
    }

    /**
     * @param string $loyaltyInquiryEndPointUrl
     * @return $this
     */
    public function setLoyaltyInquiryEndPointUrl($loyaltyInquiryEndPointUrl)
    {
        $this->loyaltyInquiryEndPointUrl = $loyaltyInquiryEndPointUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getLoyaltyInquiryEndPointUrl()
    {
        return $this->loyaltyInquiryEndPointUrl;
    }

    /**
     * @param string $merchantId
     * @return $this
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param string $paymentEndpointUrl
     * @return $this
     */
    public function setPaymentEndpointUrl($paymentEndpointUrl)
    {
        $this->paymentEndpointUrl = $paymentEndpointUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentEndpointUrl()
    {
        return $this->paymentEndpointUrl;
    }

    /**
     * @param string $secretKey
     * @return $this
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $returnUrl
     * @return $this
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }
} 