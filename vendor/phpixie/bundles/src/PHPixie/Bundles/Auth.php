<?php

namespace PHPixie\Bundles;

class Auth implements \PHPixie\Auth\Repositories\Registry
{
    protected $bundleRegistry = array();
    
    public function __construct($bundleRegistry)
    {
        $this->bundleRegistry = $bundleRegistry;
    }
    
    public function repository($name)
    {
        $split = explode('.', $name, 2);
        list($bundleName, $name) = $split;
        
        $bundle = $this->getAuthBundle($bundleName);
        
        if($bundle !== null) {
            $authRepositories = $bundle->authRepositories();
            if($authRepositories !== null) {
                return $authRepositories->repository($name);
            }
        }
        
        throw new \PHPixie\Bundles\Exception("Bundle '$bundleName' does not provide auth repositories");
    }
    
    protected function getAuthBundle($bundleName)
    {
        $bundle = $this->bundleRegistry->get($bundleName);
        
        if(!($bundle instanceof Bundle\Provides\Auth)) {
            return null;
        }
        
        return $bundle;
    }
}