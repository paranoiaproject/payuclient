<?php
namespace Payu\Parser;

use Payu\Exception\BadResponseError;
use Payu\Response\PaymentResponse;
use Payu\Response\ResponseAbstract;
use \SimpleXMLElement;
use \Exception;

class PaymentResponseParser implements ParserInterface
{
    /**
     * @param string $rawData
     * @return PaymentResponse|ResponseAbstract
     * @throws \Payu\Exception\BadResponseError
     */
    public function parse($rawData)
    {
        try {
            $xml = new SimpleXMLElement($rawData);
        } catch(Exception $e) {
            throw new BadResponseError('Unexpected response received from provider. Response: ' . $rawData);
        }
        $status = (string) $xml->STATUS;
        $code = (string) $xml->RETURN_CODE;
        $message = (string) $xml->RETURN_MESSAGE;
        $statusCode = $status == 'SUCCESS' && $code == 'AUTHORIZED' ?
                     ResponseAbstract::STATUS_APPROVED : ResponseAbstract::STATUS_DECLINED;
        $transactionId = $statusCode == ResponseAbstract::STATUS_APPROVED ? (string) $xml->REFNO : null;
        return new PaymentResponse($statusCode, $code, $message, $transactionId);
    }
}