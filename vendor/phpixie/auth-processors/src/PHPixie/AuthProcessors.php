<?php

namespace PHPixie;

class AuthProcessors
{
    protected $builder;
    
    public function __construct($auth)
    {
        $this->builder = $this->buildBuilder($auth);
    }
    
    public function updateContext($settableConextContainer)
    {
        return $this->builder->updateContextProcessor($settableConextContainer);
    }
    
    public function builder()
    {
        return $this->builder;
    }
    
    protected function buildBuilder($auth)
    {
        return new AuthProcessors\Builder($auth);
    }
}