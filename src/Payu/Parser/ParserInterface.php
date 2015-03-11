<?php
namespace Payu\Parser;

interface ParserInterface
{
    /**
     * @param string $rawData
     * @return \Payu\Response\ResponseAbstract
     */
    public function parse($rawData);
} 