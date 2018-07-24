<?php

namespace PHPixie\AuthProcessors\Processor;

class UpdateContext implements \PHPixie\Processors\Processor
{
    protected $auth;
    protected $settableContextContainer;
    
    public function __construct($auth, $settableContextContainer)
    {
        $this->auth = $auth;
        $this->settableContextContainer = $settableContextContainer;
    }
    
    public function process($value)
    {
        $context = $this->auth->buildContext();
        $this->settableContextContainer->setAuthContext($context);
        $this->auth->domains()->checkUser();
        return $value;
    }
}
