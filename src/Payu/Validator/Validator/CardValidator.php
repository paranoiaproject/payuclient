<?php
namespace Payu\Validator\Validator;

use Payu\Component\Card;
use Payu\Exception\ValidationError;

class CardValidator extends ValidatorAbstract
{
    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    protected function validateObject()
    {
        /**
         * @var $object \Payu\Component\Card
         */
        $object = $this->request->getCard();
        if(!$object || !$object instanceof Card) {
            throw new ValidationError('Card number does not be empty.');
        }
    }

    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    private function validateLuhn()
    {
        /**
         * @var $card \Payu\Component\Card
         */
        $card = $this->request->getCard();

        $sum = 0;
        $weight = 2;
        $number = $card->getNumber();
        $length = strlen($number);

        for($i = $length -2; $i >= 0; $i--) {
            $digit = $weight * $number[$i];
            $sum += floor($digit / 10) + $digit % 10;
            $weight = $weight % 2 + 1;
        }

        if ((10 - $sum % 10) % 10 != $number[$length - 1]) {
            throw new ValidationError('Bad card number.');
        }
    }

    private function validateExpireDate()
    {
        /**
         * @var $card \Payu\Component\Card
         */
        $card = $this->request->getCard();

        if(!strtotime(date('Y-m-d')) <= strtotime(sprintf('%d-%02d-t', $card->getYear(), $card->getMonth()))) {
            throw new ValidationError('Card is expired');
        }
    }

    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    public function validate()
    {
        parent::validate();
        $this->validateLuhn();
        $this->validateExpireDate();
    }
}