<?php
namespace Payu\Response;

class PaymentResponse extends ResponseAbstract
{
    /**
     * @var string
     */
    protected $transactionId;

    /**
     * @param string $transactionId
     * @return $this;
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param integer $status
     * @param string $code
     * @param string $message
     * @param string $transactionId
     */
    public function __construct($status, $code, $message, $transactionId)
    {
        parent::__construct($status, $code, $message);
        $this->setTransactionId($transactionId);
    }
} 