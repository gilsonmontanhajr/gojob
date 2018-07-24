<?php

namespace PHPixie;

class Bundles
{
    protected $builder;
    protected $configData;
    
    public function __construct($bundleRegistry, $configData)
    {
        $this->builder = $this->buildBuilder(
            $bundleRegistry,
            $configData
        );
    }
    
    public function builder()
    {
        return $this->builder;
    }
    
    public function registry()
    {
        return $this->builder->registry();
    }
    
    public function bundles()
    {
        return $this->builder->registry()->bundles();
    }
    
    public function get($name)
    {
        return $this->builder->registry()->get($name);
    }
    
    public function config($name)
    {
        return $this->builder->config($name);
    }    
    
    public function httpProcessors()
    {
        return $this->builder->httpProcessors();
    }
    
    public function templateLocators()
    {
        return $this->builder->templateLocators();
    }
    
    public function routeResolvers()
    {
        return $this->builder->routeResolvers();
    }
    
    public function orm()
    {
        return $this->builder->orm();
    }
    
    public function auth()
    {
        return $this->builder->auth();
    }
    
    public function console()
    {
        return $this->builder->console();
    }
    
    protected function buildBuilder($slice, $configData)
    {
        return new Bundles\Builder($slice, $configData);
    }
}