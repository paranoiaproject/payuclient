<?php
namespace Payu\Validator;

class LoyaltyInquiryRequestValidator extends ValidatorAbstract
{
    private $validators = array(
        '\\Payu\\Validator\\Validator\\CardValidator'
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