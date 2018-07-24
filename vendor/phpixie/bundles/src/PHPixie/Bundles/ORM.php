<?php

namespace PHPixie\Bundles;

class ORM
{
    protected $configMap   = array();
    protected $wrappersMap = array();
    
    public function __construct($bundleRegistry)
    {
        foreach($bundleRegistry->bundles() as $bundle) {
            if(!($bundle instanceof \PHPixie\Bundles\Bundle\Provides\ORM)) {
                continue;
            }
            
            $name = $bundle->name();
            
            $ormConfig = $bundle->ormConfig();
            if($ormConfig !== null) {
                $this->configMap[$name]= $ormConfig;
            }
            
            $ormWrappers = $bundle->ormWrappers();
            if($ormWrappers !== null) {
                $this->wrappersMap[$name]= $ormWrappers;
            }
        }
    }
    
    public function configMap()
    {
        return $this->configMap;
    }
    
    public function wrappersMap()
    {
        return $this->wrappersMap;
    }
}