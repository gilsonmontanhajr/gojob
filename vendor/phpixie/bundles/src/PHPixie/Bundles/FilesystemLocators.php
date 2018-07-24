<?php

namespace PHPixie\Bundles;

abstract class FilesystemLocators implements \PHPixie\Filesystem\Locators\Registry
{
    protected $bundleRegistry;
    protected $locators = array();
    
    public function __construct($bundleRegistry)
    {
        $this->bundleRegistry = $bundleRegistry;
    }
    
    public function get($name)
    {
        $path = explode(':', $name, 2);
        $locator = $this->bundleLocator($path[0], true);
        
        if(count($path) > 1) {
            if(!($locator instanceof \PHPixie\Filesystem\Locators\Registry)) {
                throw new \PHPixie\Bundles\Exception(
                    "Filesystem locator in '{$path[0]}' is not a bundle registry"
                );
            }
            
            $locator = $locator->get($path[1]);
        }
        
        return $locator;
    }
    
    public function bundleLocator($name, $isRequired = true)
    {
        if(!array_key_exists($name, $this->locators)) {
            $bundle = $this->bundleRegistry->get($name, $isRequired);
            if($bundle === null) {
                return null;
            }
            
            $locator = $this->getBundleLocator($bundle, $isRequired);
            $this->locators[$name] = $locator;
        }
        
        return $this->locators[$name];
    }
    
    abstract protected function getBundleLocator($bundle, $isRequired);
}