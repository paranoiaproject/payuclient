<?php
namespace Payu\Serializer;

use Payu\Configuration;
use Payu\Request\RequestAbstract;

abstract class SerializerAbstract
{
    /**
     * @var \Payu\Request\RequestAbstract
     */
    protected $request;

    /**
     * @var \Payu\Configuration
     */
    protected $configuration;

    /**
     * @param RequestAbstract $request
     * @param Configuration $configuration
     */
    public function __construct(RequestAbstract $request, Configuration $configuration)
    {
        $this->request = $request;
        $this->configuration = $configuration;
    }

    /**
     * @return array
     */
    protected function serializeCard()
    {
        /** @var $card \Payu\Component\Card */
        $card = $this->request->getCard();

        return array(
            'CC_NUMBER' => $card->getNumber(),
            'EXP_MONTH' => sprintf('%02d', $card->getMonth()),
            'EXP_YEAR' => $card->getYear(),
            'CC_CVV' => $card->getCvv(),
            'CC_OWNER' => $card->getOwner()
        );
    }

    protected function calculateHash($rawData)
    {
        ksort($rawData);
        $buffer = '';
        foreach($rawData as $key => $value) {
            $buffer .= strlen($value) . $value;
        }

        return hash_hmac('md5', $buffer, $this->configuration->getSecretKey());
    }

    /**
     * @return serialize
     */
    abstract public function serialize();
} 