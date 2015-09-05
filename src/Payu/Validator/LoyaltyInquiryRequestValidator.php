<?php
namespace Payu\Validator;

class LoyaltyInquiryRequestValidator extends ValidatorAbstract
{
    protected  $validators = array(
        '\\Payu\\Validator\\Validator\\CardValidator'
    );
}