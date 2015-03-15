<?php
namespace Payu\Validator\Validator;

abstract class ValidatorAbstract
{
    /**
     * @var \Payu\Request\RequestAbstract
     */
    protected $request;

    /**
     * @param RequestAbstract $request
     */
    public function __construct(RequestAbstract $request)
    {
        $this->request = $request;
    }

    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    abstract protected function validateObject();

    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    public function validate()
    {
        $this->validateObject();
    }
} 