<?php
namespace Payu\Validator\Validator;

use Payu\Component\Product;
use Payu\Exception\ValidationError;

class ProductValidator extends ValidatorAbstract
{
    /**
     * @var \Payu\Component\Product
     */
    private $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    protected function validateObject()
    {
        if(!$this->product || !$this->product instanceof Product) {
            throw new ValidationError('Basket items must be instance of Product');
        }
    }
}