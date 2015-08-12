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
    protected $url_3ds;

    /**
     * @param string $url_3ds
     * @return $this;
     */
    public function setUrl_3ds($url_3ds)
    {
        $this->url_3ds = $url_3ds;
    }

    /**
     * @return string
     */
    public function getUrl_3ds()
    {
        return $this->url_3ds;
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
     * @param integer $status
     * @param string $code
     * @param string $message
     * @param string $transactionId
     * @param string $url_3ds
     */
    public function __construct($status, $code, $message, $transactionId, $url_3ds)
    {
        parent::__construct($status, $code, $message);
        $this->setTransactionId($transactionId);
        $this->setUrl_3ds($url_3ds);
    }
} 