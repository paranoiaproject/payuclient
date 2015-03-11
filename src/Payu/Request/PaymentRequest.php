<?php
namespace Payu\Request;

class PaymentRequest extends RequestAbstract
{
    /**
     * @var \Payu\Component\Card
     */
    private $card;

    /**
     * @var \Payu\Component\Order
     */
    private $order;

    /**
     * @var \Payu\Component\Billing
     */
    private $billing;

    /**
     * @var \Payu\Component\Delivery
     */
    private $delivery;

    /**
     * @var \Payu\Component\Basket
     */
    private $basket;

    /**
     * @param \Payu\Component\Basket $basket
     * @return $this
     */
    public function setBasket($basket)
    {
        $this->basket = $basket;
        return $this;
    }

    /**
     * @return \Payu\Component\Basket
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * @param \Payu\Component\Billing $billing
     * @return $this
     */
    public function setBilling($billing)
    {
        $this->billing = $billing;
        return $this;
    }

    /**
     * @return \Payu\Component\Billing
     */
    public function getBilling()
    {
        return $this->billing;
    }

    /**
     * @param \Payu\Component\Card $card
     * @return $this
     */
    public function setCard($card)
    {
        $this->card = $card;
        return $this;
    }

    /**
     * @return \Payu\Component\Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param \Payu\Component\Delivery $delivery
     * @return $this
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return \Payu\Component\Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param \Payu\Component\Order $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return \Payu\Component\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function __construct($card = null, $order = null, $billing = null, $delivery = null, $basket = null)
    {
        $this->setCard($card);
        $this->setOrder($order);
        $this->setBilling($billing);
        $this->setDelivery($delivery);
        $this->setBasket($basket);
    }
} 