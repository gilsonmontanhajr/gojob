<?php

namespace PHPixie\AuthProcessors;

class Builder
{
    protected $auth;
    protected $parsers;
    
    public function __construct($auth)
    {
        $this->auth = $auth;
    }
    
    public function updateContextProcessor($settableConextContainer)
    {
        return new Processor\UpdateContext(
            $this->auth,
            $settableConextContainer
        );
    }
}