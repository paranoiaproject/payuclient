<?php
namespace Payu\Request;


class RefundRequest extends RequestAbstract
{
    /**
     * @var \Payu\Component\Refund
     */
    private $refund;

    /**
     * @param \Payu\Component\Refund $refund
     * @return $this
     */
    public function setRefund($refund)
    {
        $this->refund = $refund;
        return $this;
    }

    /**
     * @return \Payu\Component\Refund
     */
    public function getRefund()
    {
        return $this->refund;
    }

    /**
     * @param \Payu\Component\Refund $refund
     */
    public function __construct($refund=null)
    {
        $this->refund = $refund;
    }
} 