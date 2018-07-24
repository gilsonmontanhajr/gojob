<?php

namespace PHPixie\Bundles\Processors;

class HTTP extends \PHPixie\Bundles\Processors
{
    protected function getProcessorFromBundle($bundle)
    {
        if(!($bundle instanceof \PHPixie\Bundles\Bundle\Provides\HTTPProcessor)) {
            return null;
        }
        
        return $bundle->httpProcessor();
    }
}