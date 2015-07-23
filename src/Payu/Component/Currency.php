<?php
namespace Payu\Component;

class Currency implements ComponentInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    public function __construct($code) {
        $this->code = $code;
    }
}