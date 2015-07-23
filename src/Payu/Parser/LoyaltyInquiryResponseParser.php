<?php
namespace Payu\Parser;

use Payu\Response\ResponseAbstract,
    Payu\Exception\BadResponseError,
    Payu\Response\LoyaltyInquiryResponse;
use Exception,
    SimpleXMLElement;

class LoyaltyInquiryResponseParser implements ParserInterface
{
    public function parse($rawData)
    {
        try {
            $xml = new SimpleXMLElement($rawData);
        } catch(Exception $e) {
            throw new BadResponseError('Unexpected response received from provider. Response: ' . $rawData);
        }

        $status = (string) $xml->STATUS;
        $message = (string) $xml->MESSAGE;
        $points = ($xml->POINTS) ? (integer) $xml->POINTS : false;
        $amount = ($xml->AMOUNT) ? (float) $xml->AMOUNT : false;
        $currency = ($xml->CURRENCY) ? (string) $xml->CURRENCY : false;
        $bank = ($xml->BANK) ? (string) $xml->BANK : false;
        $cardProgramName = ($xml->CARD_PROGRAM_NAME) ? (string) $xml->CARD_PROGRAM_NAME : false;

        $status = ($status == 'SUCCESS') ? ResponseAbstract::STATUS_APPROVED : ResponseAbstract::STATUS_DECLINED;

        return new LoyaltyInquiryResponse($status, $status, $message, $points, $amount, $currency, $bank, $cardProgramName);
    }
}