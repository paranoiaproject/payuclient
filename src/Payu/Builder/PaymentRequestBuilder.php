<?php
namespace Payu\Builder;

use Payu\Component\Basket;
use Payu\Component\Billing;
use Payu\Component\Delivery;
use Payu\Component\Order;
use Payu\Component\Product;
use Payu\Configuration;
use Payu\Request\PaymentRequest;
use Payu\Serializer\PaymentRequestSerializer;
use Payu\Validator\PaymentRequestValidator;

class PaymentRequestBuilder extends BuilderAbstract
{
    /**
     * @var \Payu\Component\Order
     */
    protected $order;

    /**
     * @var \Payu\Component\Billing
     */
    protected $billing;

    /**
     * @var \Payu\Component\Delivery
     */
    protected $delivery;

    /**
     * @var \Payu\Component\Basket
     */
    protected $basket;

    /**
     * @param $code
     * @param $clientIp
     * @param string $currency
     * @param int $installment
     * @param null $loyaltyAmount
     * @param string $paymentMethod
     * @param null $date
     * @param null $timeout
     * @return $this
     */
    public function buildOrder(
        $code,
        $clientIp,
        $installment = 1,
        $currency='TRY',
        $loyaltyAmount = null,
        $paymentMethod = 'CCVISAMC',
        $date=null,
        $timeout = null,
        $recurringPayment = false
    ) {
        $this->order = new Order(
            $code,
            $clientIp,
            $installment,
            $currency,
            $loyaltyAmount,
            $paymentMethod,
            $date,
            $timeout,
            $recurringPayment
        );
        return $this;
    }

    /**
     * @param Order $order
     * @return $this
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param null $firstName
     * @param null $lastName
     * @param null $email
     * @param null $phone
     * @param null $fax
     * @param null $address
     * @param null $zipCode
     * @param null $city
     * @param null $state
     * @param null $countryCode
     * @return $this
     */
    public function buildBilling(
        $firstName = null,
        $lastName = null,
        $email = null,
        $phone = null,
        $fax = null,
        $address = null,
        $zipCode = null,
        $city = null,
        $state = null,
        $countryCode = null
    )
    {
        $this->billing = new Billing(
            $firstName,
            $lastName,
            $email,
            $phone,
            $fax,
            $address,
            $zipCode,
            $city,
            $state,
            $countryCode
        );
        return $this;
    }

    /**
     * @param Billing $billing
     * @return $this
     */
    public function setBilling(Billing $billing)
    {
        $this->billing = $billing;
        return $this;
    }

    /**
     * @param null $firstName
     * @param null $lastName
     * @param null $email
     * @param null $phone
     * @param null $company
     * @param null $address
     * @param null $zipCode
     * @param null $city
     * @param null $state
     * @param null $countryCode
     * @return $this
     */
    public function buildDeliverys(
        $firstName = null,
        $lastName = null,
        $email = null,
        $phone = null,
        $company = null,
        $address = null,
        $zipCode = null,
        $city = null,
        $state = null,
        $countryCode = null
    )
    {
        $this->delivery = new Delivery(
            $firstName,
            $lastName,
            $email,
            $phone,
            $company,
            $address,
            $zipCode,
            $city,
            $state,
            $countryCode
        );
        return $this;
    }

    /**
     * @param Delivery $delivery
     * @return $this
     */
    public function setDelivery(Delivery $delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @param null $name
     * @param null $code
     * @param null $quantity
     * @param null $info
     * @param null $price
     * @param null $version
     * @return $this
     */
    public function buildAndAddProduct(
        $name = null,
        $code = null,
        $quantity = null,
        $info = null,
        $price = null,
        $version = null,
        $vat = null
    ) {

        $this->basket->add(new Product($name, $code, $quantity, $info, $price, $version, $vat));
        return $this;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function addProduct(Product $product)
    {
        $this->basket->add($product);
        return $this;
    }

    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration);
        $this->basket = new Basket();
    }

    public function build()
    {
        $request = new PaymentRequest($this->card, $this->order, $this->billing, $this->delivery, $this->basket);

        $validator = new PaymentRequestValidator($request);
        $validator->validate();

        $serializer = new PaymentRequestSerializer($request, $this->configuration);
        $rawData = $serializer->serialize();

        $request->setRawData($rawData);

        return $request;
    }
}
