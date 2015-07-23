<?php
namespace Payu\Component;

class Currency implements ComponentInterface
{
    /**
     * @var string
     */
    private $currency;

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function __construct($currency) {
        $this->currency = $currency;
    }
}