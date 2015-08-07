<?php
namespace Payu\Validator;

class PaymentRequestValidator extends ValidatorAbstract
{
    /**
     * @return array
     */
    public function validators()
    {
        return array(
            '\\Payu\\Validator\\Validator\\CardValidator',
            '\\Payu\\Validator\\Validator\\BillingValidator',
            '\\Payu\\Validator\\Validator\\OrderValidator',
            '\\Payu\\Validator\\Validator\\BasketValidator',
        );
    }
}
