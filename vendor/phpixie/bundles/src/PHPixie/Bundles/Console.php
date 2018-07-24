<?php

namespace PHPixie\Bundles;

class Console implements \PHPixie\Console\Registry\Provider
{
    protected $bundleRegistry;
    
    public function __construct($bundleRegistry)
    {
        $this->bundleRegistry = $bundleRegistry;
    }
    
    public function commandNames()
    {
        $commandNames = array();
        
        foreach($this->bundleRegistry->bundles() as $name => $bundle) {
            if(!($bundle instanceof Bundle\Provides\Console)) {
                continue;
            }
            
            $provider = $bundle->consoleProvider();
            if($provider === null) {
                continue;
            }
            
            foreach($provider->commandNames() as $commandName) {
                $commandNames[] = $name.':'.$commandName;
            }
        }
        
        return $commandNames;
    }
    
    public function buildCommand($name, $commandConfig)
    {
        $explodedName = explode(':', $name, 2);
        
        list($bundleName, $commandName) = $explodedName;
            
        $bundle = $this->bundleRegistry->get($bundleName);
        $provider = $bundle->consoleProvider();
        
        return $provider->buildCommand($commandName, $commandConfig);
    }
}