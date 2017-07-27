<?php
namespace Payu\Response;

class PaymentResponse extends ResponseAbstract
{
    /**
     * @var string
     */
    protected $transactionId;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var string
     */
    protected $url3DS;

    /**
     * @var string
     */
    protected $tokenHash;

    /**
     * @var $amount
     */
    protected $amount;

    /**
     * @param integer $status
     * @param string $code
     * @param string $message
     * @param string $transactionId
     * @param string $hash
     * @param string $url3DS
     * @param string $tokenHash
     */
    public function __construct($status, $code, $message, $transactionId, $hash, $url3DS, $tokenHash)
    {
        parent::__construct($status, $code, $message);
        $this->setTransactionId($transactionId);
        $this->setHash($hash);
        $this->setUrl3DS($url3DS);
        $this->setTokenHash($tokenHash);
    }

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
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getUrl3DS()
    {
        return $this->url3DS;
    }

    /**
     * @param string $url3DS
     */
    public function setUrl3DS($url3DS)
    {
        $this->url3DS = $url3DS;
    }

    /**
     * @return string
     */
    public function getTokenHash()
    {
        return $this->tokenHash;
    }

    /**
     * @param string $tokenHash
     */
    public function setTokenHash($tokenHash)
    {
        $this->tokenHash = $tokenHash;
    }

    public function setAmount($amount = null) {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount() {
        return $this->amount;
    }
} 
