<?php
namespace Payu;

use Guzzle\Http\Exception\RequestException;
use Payu\Builder\LoyaltyInquiryRequestBuilder;
use Payu\Builder\PaymentRequestBuilder;
use Payu\Exception\ConnectionError;
use Payu\Parser\LoyaltyInquiryResponseParser;
use Payu\Parser\PaymentResponseParser;
use Payu\Parser\ResponseParser;
use Payu\Request\LoyaltyInquiryRequest;
use Payu\Request\PaymentRequest;
use Payu\Request\RequestAbstract;
use Guzzle\Http\Client as httpClient;


class Client
{
    /**
     * @var \Payu\Configuration
     */
    private $configuration;

    /**
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return PaymentRequestBuilder
     */
    public function createPaymentRequestBuilder()
    {
        return new PaymentRequestBuilder($this->configuration);
    }

    /**
     * @return LoyaltyInquiryRequestBuilder
     */
    public function createLoyaltyInquiryRequestBuilder()
    {
        return new LoyaltyInquiryRequestBuilder($this->configuration);
    }

    /**
     * @param RequestAbstract $request
     * @param string $endpointUrl
     * @return \Guzzle\Http\EntityBodyInterface|string
     * @throws Exception\ConnectionError
     */
    private function sendRequest(RequestAbstract $request, $endpointUrl)
    {
        $client = new HttpClient();
        $client->setConfig(array(
            'curl.options' => array(
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
            )
        ));
        $httpRequest = $client->post($endpointUrl, null, $request->getRawData());
        try {
            return $httpRequest->send()->getBody();
        } catch(RequestException $e) {
            throw new ConnectionError($e->getMessage());
        }
    }

    /**
     * @param PaymentRequest $request
     * @return Response\PaymentResponse
     */
    public function makePayment(PaymentRequest $request)
    {
        $rawResponse = $this->sendRequest($request, $this->configuration->getPaymentEndpointUrl());
        
        $parser = new ResponseParser(new PaymentResponseParser(), $rawResponse);
        return $parser->parse();
    }

    /**
     * @param LoyaltyInquiryRequest $request
     * @return Response\LoyaltyInquiryResponse
     */
    public function makeLoyaltyInquiry(LoyaltyInquiryRequest $request)
    {
        $rawResponse = $this->sendRequest($request, $this->configuration->getLoyaltyInquiryEndPointUrl());
        $parser = new ResponseParser(new LoyaltyInquiryResponseParser(), $rawResponse);
        return $parser->parse();
    }
} 
