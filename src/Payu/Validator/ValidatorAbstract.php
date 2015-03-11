<?php
namespace Payu\Validator;

use Payu\Request\RequestAbstract;

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
     * @return RequestAbstract
     */
    public function getRequest()
    {
        #TODO: Request is already given from construction. What does getRequest do ?
        return $this->request;
    }

    /**
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    abstract public function validate();
} 