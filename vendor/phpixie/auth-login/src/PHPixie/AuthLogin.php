<?php

namespace PHPixie;

class AuthLogin
{
    /** @var AuthLogin\Builder */
    protected $builder;

    /**
     * @param \PHPixie\Security $security
     */
    public function __construct($security)
    {
        $this->builder = $this->buildBuilder($security);
    }

    public function providers()
    {
        return $this->builder->providers();
    }
    
    public function builder()
    {
        return $this->builder;
    }
    
    protected function buildBuilder($security)
    {
        return new AuthLogin\Builder($security);
    }
}