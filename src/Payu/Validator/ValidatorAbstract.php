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
     * @return void
     * @throws \Payu\Exception\ValidationError
     */
    public function validate()
    {
        foreach($this->validators as $class) {
            /** @var $instance \Payu\Validator\Validator\ValidatorAbstract */
            $instance = new $class($this->request);
            $instance->validate();
            unset($instance);
        }
    }
} 