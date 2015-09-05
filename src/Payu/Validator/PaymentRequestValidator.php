<?php
namespace Payu\Validator;

class PaymentRequestValidator extends ValidatorAbstract
{
    protected $validators = array(
        '\\Payu\\Validator\\Validator\\CardValidator',
        '\\Payu\\Validator\\Validator\\BillingValidator',
        '\\Payu\\Validator\\Validator\\OrderValidator',
        '\\Payu\\Validator\\Validator\\BasketValidator',
    );
}