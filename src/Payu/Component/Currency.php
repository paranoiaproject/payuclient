<?php
/**
 * Payuclient currency component
 */
namespace Payu\Component;

/**
 * Currency class for represent currencies.
 */
class Currency implements ComponentInterface
{
    /**
     * @var string Three letter ISO-4217 currency code.
     */
    private $code;

    /**
     * Constructor
     *
     * @param string $code Three letter currency code.
     */
    public function __construct($code = null)
    {
        $this->setCode($code);
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets currency code.
     *
     * @param string $code
     */
    public function setCode($code)
    {
        // Always use uppercase currency codes internally
        $this->code = strtoupper(preg_replace('/[^a-zA-Z]/', '', $code));

        return $this;
    }

    /**
     * Returns string representation of the currency
     * instance in case of casting a currency instance to string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->code;
    }
}
