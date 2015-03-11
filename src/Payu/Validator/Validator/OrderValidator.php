<?php
namespace Payu\Validator\Validator;

use Payu\Component\Order;
use Payu\Exception\ValidationError;

class OrderValidator extends ValidatorAbstract
{

    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    protected function validateObject()
    {
        /**
         * @var $object \Payu\Component\Order
         */
        $object = $this->getRequest()->getOrder();
        if(!$object || !$object instanceof Order) {
            throw new ValidationError('Order does not be empty.');
        }
    }
}