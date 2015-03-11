<?php
namespace Payu\Validator\Validator;

use Payu\Component\Billing;
use Payu\Exception\ValidationError;

class BillingValidator extends ValidatorAbstract
{

    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    protected function validateObject()
    {
        /**
         * @var $object \Payu\Component\Billing
         */
        $object = $this->getRequest()->getBilling();
        if(!$object || !$object instanceof Billing) {
            throw new ValidationError('Billing information does not be empty.');
        }
    }
}