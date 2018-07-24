<?php

namespace PHPixie\Bundles;

abstract class Processors implements \PHPixie\Processors\Registry
{
    protected $bundleRegistry;
    
    public function __construct($bundleRegistry)
    {
        $this->bundleRegistry = $bundleRegistry;
    }
    
    public function get($name)
    {
        $bundle = $this->bundleRegistry->get($name, false);
        if($bundle === null) {
            return null;
        }
        
        return $this->getProcessorFromBundle($bundle);
    }
    
    abstract protected function getProcessorFromBundle($bundle);
}