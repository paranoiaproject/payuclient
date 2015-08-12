<?php namespace Payu\Test;

use Payu\Client;
use Payu\Configuration;
use Payu\Response\PaymentResponse;
use Payu\Builder\PaymentRequestBuilder;
use Payu\Response\LoyaltyInquiryResponse;
use Payu\Builder\LoyaltyInquiryRequestBuilder;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Payu\Client
     */
    protected $client;
    /**
     * @var \Payu\Configuration
     */
    protected $configuration;

    public function setUp()
    {
        $configuration = new Configuration();
        $configuration->setMerchantId('MY_MERCHANT_01')
            ->setSecretKey('SECRET_KEY')
            ->setPaymentEndpointUrl('https://secure.payu.com.tr/order/alu/v3')
            ->setLoyaltyInquiryEndPointUrl('https://secure.payu.com.tr/api/loyalty-points/check');
            ->setReturnUrl('http://payu/cs/payu_3dreturn.php');
        $this->configuration = $configuration;
        $this->client = new Client($configuration);
    }

    public function testCreatePaymentRequestBuilder()
    {
        $this->assertTrue($this->client->createPaymentRequestBuilder() instanceof PaymentRequestBuilder);
    }

    public function testCreateLoyaltyInquiryRequestBuilder()
    {
        $this->assertTrue($this->client->createLoyaltyInquiryRequestBuilder() instanceof LoyaltyInquiryRequestBuilder);
    }

    public function testMakePayment()
    {
        $request = $this->client->createPaymentRequestBuilder()
            ->buildCard('4282209027132016', '123', 5, 2019)
            ->buildOrder('ORDERNO123456', '127.0.0.1')
            ->buildBilling('John', 'Smith', 'test@test.net', '05321231212')
            ->buildAndAddProduct('The Product', 'PR1', 1, 10)
            ->build();
        $result = $this->client->makePayment($request);
        $this->assertTrue($result instanceof PaymentResponse);
    }

    public function testMakeLoyaltyInquiry()
    {
        $request = $this->client->createLoyaltyInquiryRequestBuilder()
            ->buildCard('4282209027132016', '123', '5', '2019')
            ->buildCurrency('TRY')
            ->build();
        $result = $this->client->makeLoyaltyInquiry($request);
        $this->assertTrue($result instanceof LoyaltyInquiryResponse);
    }
}