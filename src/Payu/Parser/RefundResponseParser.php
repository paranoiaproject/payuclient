<?php
namespace Payu\Parser;

use Payu\Exception\BadResponseError;
use Payu\Response\RefundResponse;
use Payu\Response\ResponseAbstract;

class RefundResponseParser implements ParserInterface
{
    /**
     * @param string $rawData
     * @throws \Payu\Exception\BadResponseError
     * @return \Payu\Response\ResponseAbstract
     */
    public function parse($rawData)
    {
        try {
            $xml = new SimpleXMLElement($rawData);
        } catch(Exception $e) {
            throw new BadResponseError('Unexpected response received from provider. Response: ' . $rawData);
        }

        $row = $xml->EPAYMENT;
        $explodedRow = explode('|', $row);

        if(count($explodedRow) != 5 ) {
            throw new BadResponseError('Unexpected response received from provider. Response: ' . $row);
        }

        list($orderRef, $code, $message, $irnDate, $orderHash) = $explodedRow;
        $statusCode = trim((string) $message) == 'OK' ?
            ResponseAbstract::STATUS_APPROVED : ResponseAbstract::STATUS_DECLINED;
        $code = (string) $code;
        $message = (string) $message;

        return new RefundResponse($statusCode, $code, $message);
    }
}