<?php

namespace PHPixie\Bundles;

class Builder
{
    protected $bundleRegistry;
    protected $configData;
    
    protected $instances = array();
    
    public function __construct($bundleRegistry, $configData)
    {
        $this->bundleRegistry = $bundleRegistry;
        $this->configData     = $configData;
    }
    
    public function config($name)
    {
        return $this->configData->slice($name);
    }
    
    public function registry()
    {
        return $this->bundleRegistry;
    }
    
    public function httpProcessors()
    {
        return $this->instance('httpProcessors');
    }
    
    public function templateLocators()
    {
        return $this->instance('templateLocators');
    }
    
    public function routeResolvers()
    {
        return $this->instance('routeResolvers');
    }
    
    public function orm()
    {
        return $this->instance('orm');
    }
    
    public function auth()
    {
        return $this->instance('auth');
    }
    
    public function console()
    {
        return $this->instance('console');
    }
    
    protected function instance($name)
    {
        if(!array_key_exists($name, $this->instances)) {
            $method = 'build'.ucfirst($name);
            $this->instances[$name] = $this->$method();
        }
        
        return $this->instances[$name];
    }
    
    protected function buildHttpProcessors()
    {
        return new Processors\HTTP($this->bundleRegistry);
    }
    
    protected function buildTemplateLocators()
    {
        return new FilesystemLocators\Template($this->bundleRegistry);
    }
    
    protected function buildRouteResolvers()
    {
        return new RouteResolvers($this->bundleRegistry);
    }
    
    protected function buildOrm()
    {
        return new ORM($this->bundleRegistry);
    }
    
    protected function buildAuth()
    {
        return new Auth($this->bundleRegistry);
    }
    
    protected function buildConsole()
    {
        return new Console($this->bundleRegistry);
    }
}