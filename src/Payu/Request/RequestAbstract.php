<?php

namespace Payu\Request;

abstract class RequestAbstract
{
    /**
     * @var array
     */
    protected $rawData;

    /**
     * @param array $rawData
     * @return $this
     */
    public function setRawData(array $rawData)
    {
        $this->rawData = $rawData;
        return $this;
    }

    /**
     * @return array
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    abstract public function getCard();
} 