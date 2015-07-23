<?php
namespace Payu\Request;

class LoyaltyInquiryRequest extends RequestAbstract
{
    /**
     * @var \Payu\Component\Card
     */
    private $card;

    /**
     * @var \Payu\Component\Currency
     */
    private $currency;

    /**
     * @var string
     */
    private $date;

    /**
     * @return \Payu\Component\Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param \Payu\Component\Card $card
     */
    public function setCard($card)
    {
        $this->card = $card;
    }

    /**
     * @return \Payu\Component\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param \Payu\Component\Currency $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    public function __construct($card = null, $currency = null)
    {
        $this->date = gmdate('Y-m-d H:i:s');
        $this->setCard($card);
        $this->setCurrency($currency);
    }
} 