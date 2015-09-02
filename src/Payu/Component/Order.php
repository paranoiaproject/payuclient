<?php
namespace Payu\Component;

class Order implements ComponentInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     * format: Y-m-d
     */
    private $date;

    /**
     * @var string
     */
    private $currency = 'TRY';

    /**
     * @var string
     */
    private $paymentMethod = 'CCVISAMC';

    /**
     * @var int
     */
    private $installment = 1;

    /**
     * @var int
     */
    private $timeout;

    /**
     * @var string
     */
    private $clientIp;

    /**
     * @var float
     */
    private $loyaltyAmount;

    /**
     * @var bool
     */
    private $recurringPayment = false;

    public function __construct(
        $code = null,
        $clientIp = null,
        $installment = 1,
        $currency='TRY',
        $loyaltyAmount = null,
        $paymentMethod = 'CCVISAMC',
        $date=null,
        $timeout = null
    ) {
        $this->setCode($code);
        $this->setClientIp($clientIp);
        $this->setInstallment($installment);
        $this->setCurrency($currency);
        $this->setLoyaltyAmount($loyaltyAmount);
        $this->setPaymentMethod($paymentMethod);
        $this->setDate($date);
        $this->setTimeout($timeout);

    }

    /**
     * @param string $clientIp
     * @return $this
     */
    public function setClientIp($clientIp)
    {
        $this->clientIp = $clientIp;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientIp()
    {
        return $this->clientIp;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date != null ? $date : gmdate('Y-m-d H:i:s');
        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $installment
     * @return $this
     */
    public function setInstallment($installment)
    {
        $this->installment = $installment;
        return $this;
    }

    /**
     * @return int
     */
    public function getInstallment()
    {
        return $this->installment;
    }

    /**
     * @param float $loyaltyAmount
     * @return $this
     */
    public function setLoyaltyAmount($loyaltyAmount)
    {
        $this->loyaltyAmount = $loyaltyAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getLoyaltyAmount()
    {
        return $this->loyaltyAmount;
    }

    /**
     * @param string $paymentMethod
     * @return $this
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param int $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }


    /**
     * Gets the value of recurringPayment.
     *
     * @return bool
     */
    public function isRecurringPayment()
    {
        return $this->recurringPayment;
    }

    /**
     * Sets the value of recurringPayment.
     *
     * @param bool $recurringPayment the recurring payment
     *
     * @return self
     */
    public function setRecurringPayment($recurringPayment)
    {
        $this->recurringPayment = (bool)$recurringPayment;

        return $this;
    }
}