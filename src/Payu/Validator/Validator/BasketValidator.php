<?php
namespace Payu\Validator\Validator;

use Payu\Exception\ValidationError;

class BasketValidator extends ValidatorAbstract
{
    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    protected function validateObject()
    {
        $object = $this->getRequest()->getBasket();
        if(!$object || !$object instanceof Card) {
            throw new ValidationError('Basket is not set.');
        }
    }

    private function validateProducts()
    {
        /**
         * @var $collection \Payu\Component\Basket
         */
        $collection = $this->getRequest()->getBasket();
        if(!$collection->count()) {
            throw new ValidationError('Basket does not be empty.');
        }

        /** @var $product \Payu\Component\Product */
        foreach($collection as $product) {
            $validator = new ProductValidator($product);
            $validator->validate();
            unset($validator);
        }
    }

    public function validate()
    {
        parent::validate();
        $this->validateProducts();
    }
}