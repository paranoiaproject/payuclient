<?php
namespace Payu\Component;

class Product implements ComponentInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;

    /**
     * @var integer
     */
    private $quantity = 1;

    /**
     * @var string
     */
    private $info;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $version;

    /**
     * @var integer
     */
    private $vat;

    /**
     * @var string
     */
    private $priceType = 'NET';

    /**
     * If you set vat value, the price should calculate without vat
     */
    public function __construct(
        $name = null,
        $code = null,
        $quantity = null,
        $info = null,
        $price = null,
        $version = null,
        $vat = null,
        $priceType = null
    ) {
        $this->setName($name);
        $this->setCode($code);
        $this->setQuantity($quantity);
        $this->setInfo($info);
        $this->setPrice($price);
        $this->setVersion($version);
        $this->setVat($vat);
        $this->setPriceType($priceType);
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
     * @param string $info
     * @return $this
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param integer $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param string $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Gets the value of vat.
     *
     * @return integer
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Sets the value of vat.
     *
     * @param integer $vat
     *
     * @return self
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriceType()
    {
        return $this->priceType;
    }

    /**
     * @param string $priceType
     */
    public function setPriceType($priceType)
    {
        $this->priceType = $priceType;

        return $this;
    }
}
