<?php
namespace Payu\Parser;

use Exception;
use Payu\Exception\BadResponseError;
use Payu\Response\LoyaltyInquiryResponse;
use Payu\Response\ResponseAbstract;
use SimpleXMLElement;

class LoyaltyInquiryResponseParser implements ParserInterface
{
    public function parse($rawData)
    {
        try {
            $xml = new SimpleXMLElement($rawData);
        } catch (Exception $e) {
            throw new BadResponseError('Unexpected response received from provider. Response: ' . $rawData);
        }

        $status          = (string) $xml->STATUS;
        $message         = (string) $xml->MESSAGE;
        $points          = ($xml->POINTS) ? (integer) $xml->POINTS : false;
        $amount          = ($xml->AMOUNT) ? (float) $xml->AMOUNT : false;
        $currency        = ($xml->CURRENCY) ? (string) $xml->CURRENCY : false;
        $bank            = ($xml->BANK) ? (string) $xml->BANK : false;
        $cardProgramName = ($xml->CARD_PROGRAM_NAME) ? (string) $xml->CARD_PROGRAM_NAME : false;

        switch ($status) {
            case 'SUCCESS':
                $code = ResponseAbstract::STATUS_SUCCESS;
                break;
            case 'INPUT_ERROR':
                $code = ResponseAbstract::STATUS_INPUT_ERROR;
                break;
            case 'FAILED':
            default:
                $code = ResponseAbstract::STATUS_FAILED;
                break;
        }

        return new LoyaltyInquiryResponse($status, $code, $message, $points, $amount, $currency, $bank,
            $cardProgramName);
    }
}
