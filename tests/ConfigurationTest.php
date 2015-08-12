<?php namespace Payu\Test;

use Payu\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Configuration
     */
    protected  $configuration;

    public function setUp() {
        $this->configuration = new Configuration('TestMerchantId', 'TestSecretKey', 'TestPaymentEndpointUrl',
            'TestLoyaltyInquiryEndPointUrl', 'Test3DReturnUrl');
    }

    public function testConstructor() {
        $this->assertEquals('TestMerchantId', $this->configuration->getMerchantId());
        $this->assertEquals('TestSecretKey', $this->configuration->getSecretKey());
        $this->assertEquals('TestPaymentEndpointUrl', $this->configuration->getPaymentEndpointUrl());
        $this->assertEquals('TestLoyaltyInquiryEndPointUrl', $this->configuration->getLoyaltyInquiryEndPointUrl());
        $this->assertEquals('Test3DReturnUrl', $this->configuration->getReturnUrl());
    }

    public function testSetMerchantId() {
        $this->configuration->setMerchantId('TestMerchantIdSetter');
        $this->assertEquals('TestMerchantIdSetter', $this->configuration->getMerchantId());
    }

    public function testSetSecretKey() {
        $this->configuration->setSecretKey('TestSecretKeySetter');
        $this->assertEquals('TestSecretKeySetter', $this->configuration->getSecretKey());
    }

    public function testSetPaymentEndpointUrl() {
        $this->configuration->setPaymentEndpointUrl('TestPaymentEndpointUrlSetter');
        $this->assertEquals('TestPaymentEndpointUrlSetter', $this->configuration->getPaymentEndpointUrl());
    }

    public function testSetLoyaltyInquiryEndPointUrl() {
        $this->configuration->setLoyaltyInquiryEndPointUrl('TestLoyaltyInquiryEndPointUrlSetter');
        $this->assertEquals('TestLoyaltyInquiryEndPointUrlSetter', $this->configuration->getLoyaltyInquiryEndPointUrl());
    }

    public function testSet3DReturnUrl() {
        $this->configuration->setReturnUrl('Test3DReturnUrlSetter');
        $this->assertEquals('Test3DReturnUrlSetter', $this->configuration->getReturnUrl());
    }

}