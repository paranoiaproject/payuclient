<?php
namespace Payu\Response;

abstract class ResponseAbstract
{
    const STATUS_APPROVED     = 200;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_DECLINED     = 500;

    /**
     * @var integer
     */
    protected $status;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $message;

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
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param integer $status
     * @param string $code
     * @param string $message
     */
    public function __construct($status, $code, $message)
    {
        $this->setStatus($status);
        $this->setCode($code);
        $this->setMessage($message);
    }
} 