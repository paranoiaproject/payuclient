<?php
namespace Payu\Validator;

class LoyaltyInquiryRequestValidator extends ValidatorAbstract
{
    /**
     * @return array
     */
    public function validators()
    {
        return array(
            '\\Payu\\Validator\\Validator\\CardValidator'
        );
    }
}
