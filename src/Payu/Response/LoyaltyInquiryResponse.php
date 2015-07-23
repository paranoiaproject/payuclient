<?php
namespace Payu\Response;

class LoyaltyInquiryResponse extends ResponseAbstract
{
    /**
     * @var integer
     */
    private $points;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $bank;

    /**
     * @var string
     */
    private $cardProgramName;

    /**
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @return string
     */
    public function getCardProgramName()
    {
        return $this->cardProgramName;
    }

    /**
     * @param integer $status
     * @param string $code
     * @param string $message
     */
    public function __construct
    (
        $status,
        $code,
        $message,
        $points,
        $amount,
        $currency,
        $bank,
        $cardProgramName
    )
    {
        parent::__construct($status, $code, $message);
        $this->points = $points;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->bank = $bank;
        $this->cardProgramName = $cardProgramName;
    }
} 