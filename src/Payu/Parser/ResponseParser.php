<?php
namespace Payu\Parser;

class ResponseParser
{
    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @var string
     */
    private $rawResponse;

    /**
     * @param ParserInterface $parser
     * @param string $rawResponse
     */
    public function __construct(ParserInterface $parser, $rawResponse)
    {
        $this->parser = $parser;
        $this->rawResponse = $rawResponse;
    }

    /**
     * @return \Payu\Response\ResponseAbstract
     */
    public function parse()
    {
        return $this->parser->parse($this->rawResponse);
    }
} 