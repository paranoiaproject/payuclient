<?php
namespace Payu\Builder;

use Payu\Component\Card;
use Payu\Configuration;

abstract class BuilderAbstract
{
    /**
     * @var \Payu\Component\Card
     */
    protected $card;

    /**
     * @var \Payu\Configuration
     */
    protected $configuration;

    /**
     * @param $number
     * @param $cvv
     * @param $month
     * @param $year
     * @param null $owner
     * @return $this
     */
    public function buildCard($number, $cvv, $month, $year, $owner = null)
    {
        $this->card = new Card($number, $cvv, $month, $year, $owner);
        return $this;
    }

    /**
     * @param Card $card
     * @return $this
     */
    public function setCard(Card $card)
    {
        $this->card = $card;
        return $this;
    }

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return \Payu\Response\ResponseAbstract
     */
    abstract public function build();
} 