<?php

namespace PHPixie\Bundles;

class RouteResolvers implements \PHPixie\Route\Resolvers\Registry
{
    protected $bundleRegistry;
    
    public function __construct($bundleRegistry)
    {
        $this->bundleRegistry = $bundleRegistry;
    }
    
    public function get($name)
    {
        $path = explode('.', $name, 2);
        
        $resolver = $this->getBundleResolver($path[0]);
        
        if(count($path) > 1) {
            if(!($resolver instanceof \PHPixie\Route\Resolvers\Registry)) {
                throw new \PHPixie\Bundles\Exception(
                    "Route resolver in '{$path[0]}' is not a bundleRegistry"
                );
            }
            
            $resolver = $resolver->get($path[1]);
        }
        
        return $resolver;
    }
    
    protected function getBundleResolver($name)
    {
        $bundle = $this->bundleRegistry->get($name);
        
        $resolver = null;
        
        if($bundle instanceof \PHPixie\Bundles\Bundle\Provides\RouteResolver) {
            $resolver = $bundle->routeResolver();
        }
        
        if($resolver !== null) {
            return $resolver;
        }
        
        throw new \PHPixie\Bundles\Exception(
            "Bundle '$name' does not provide a route resolver"
        );
    }
}