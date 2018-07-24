<?php

namespace PHPixie\Bundles\FilesystemLocators;

class Template extends \PHPixie\Bundles\FilesystemLocators
{
    protected function getBundleLocator($bundle, $isRequired)
    {
        if($bundle instanceof \PHPixie\Bundles\Bundle\Provides\TemplateLocator) {
            $locator = $bundle->templateLocator();
            if($locator !== null) {
                return $locator;
            }
        }
        
        if(!$isRequired) {
            return null;
        }
        
        $bundleName = $bundle->name();
        throw new \PHPixie\Bundles\Exception("Bundle '$bundleName' does not provide a template locator");
    }
}