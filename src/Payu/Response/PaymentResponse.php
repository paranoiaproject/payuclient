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
     * @param integer $status
     * @param string $code
     * @param string $message
     * @param string $transactionId
     * @param string $hash
     * @param string $url3DS
     */
    public function __construct($status, $code, $message, $transactionId, $hash, $url3DS)
    {
        parent::__construct($status, $code, $message);
        $this->setTransactionId($transactionId);
        $this->setHash($hash);
        $this->setUrl3DS($url3DS);
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
} 