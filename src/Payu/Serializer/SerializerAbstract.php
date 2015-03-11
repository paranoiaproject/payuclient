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
     * @return RequestAbstract
     */
    public function getRequest()
    {
        #TODO: Request is already given from construction. What does getRequest do ?
        return $this->request;
    }

    /**
     * @return Configuration
     */
    protected function getConfiguration()
    {
        #TODO: No need any protected wrapper function for protected attributes.
        return $this->configuration;
    }


    /**
     * @return array
     */
    protected function serializeCard()
    {
        /** @var $card \Payu\Component\Card */
        $card = $this->getRequest()->getCard();

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

        return hash_hmac('md5', $buffer, $this->getConfiguration()->getSecretKey());
    }

    /**
     * @return serialize
     */
    abstract public function serialize();
} 