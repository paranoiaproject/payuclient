<?php
namespace Payu\Validator;

class PaymentRequestValidator extends ValidatorAbstract
{
    private $validators = array(
        '\\Payu\\Validator\\Validator\\CardValidator',
        '\\Payu\\Validator\\Validator\\BillingValidator',
        '\\Payu\\Validator\\Validator\\OrderValidator',
        '\\Payu\\Validator\\Validator\\BasketValidator',
    );
    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    public function validate()
    {
        foreach($this->validators as $class) {
            /** @var $instance \Payu\Validator\Validator\ValidatorAbstract */
            $instance = new $class($this->request);
            $instance->validate();
            unset($instance);
        }
    }
}