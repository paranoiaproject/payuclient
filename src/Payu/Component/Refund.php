<?php
namespace Payu\Component;

class Refund implements ComponentInterface
{
    /**
     * @var string
     */
    private $merchant;

    /**
     * @var string
     */
    private $orderRef;

    /**
     * @var float
     */
    private $orderAmount;

    /**
     * @var string
     */
    private $orderCurrency;

    /**
     * @var string
     */
    private $irnDate;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var float
     */
    private $loyaltyPointsAmount;

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $irnDate
     */
    public function setIrnDate($irnDate)
    {
        $this->irnDate = $irnDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getIrnDate()
    {
        return $this->irnDate;
    }

    /**
     * @param float $loyaltyPointsAmount
     */
    public function setLoyaltyPointsAmount($loyaltyPointsAmount)
    {
        $this->loyaltyPointsAmount = $loyaltyPointsAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getLoyaltyPointsAmount()
    {
        return $this->loyaltyPointsAmount;
    }

    /**
     * @param string $merchant
     */
    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * @param float $orderAmount
     */
    public function setOrderAmount($orderAmount)
    {
        $this->orderAmount = $orderAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getOrderAmount()
    {
        return $this->orderAmount;
    }

    /**
     * @param string $orderCurrency
     */
    public function setOrderCurrency($orderCurrency)
    {
        $this->orderCurrency = $orderCurrency;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderCurrency()
    {
        return $this->orderCurrency;
    }

    /**
     * @param string $orderRef
     */
    public function setOrderRef($orderRef)
    {
        $this->orderRef = $orderRef;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderRef()
    {
        return $this->orderRef;
    }

    public function __construct(
        $merchant=null,
        $orderRef=null,
        $orderAmount=null,
        $orderCurrency=null,
        $irnDate=null,
        $amount=null,
        $loyaltyPointsAmount=null
    ) {
        $this->merchant = $merchant;
        $this->orderRef = $orderRef;
        $this->orderAmount = $orderAmount;
        $this->orderCurrency = $orderCurrency;
        $this->irnDate = $irnDate;
        $this->amount = $amount;
        $this->loyaltyPointsAmount = $loyaltyPointsAmount;
    }
}