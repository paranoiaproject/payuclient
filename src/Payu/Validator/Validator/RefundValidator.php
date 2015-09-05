<?php
/**
 * Created by PhpStorm.
 * User: ibrahimgunduz
 * Date: 9/5/15
 * Time: 10:47 PM
 */

namespace Payu\Validator\Validator;

use Payu\Component\Refund;
use Payu\Exception\ValidationError;

class RefundValidator extends ValidatorAbstract
{
    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    protected function validateObject()
    {
        /** @var $object \Payu\Component\Refund */
        $object = $this->request->getRefund();
        if(!$object || !$object instanceof Refund) {
            throw new ValidationError('Refund is not set.');
        }
    }
}