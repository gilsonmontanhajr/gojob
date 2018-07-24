<?php

namespace PHPixie\BundleFramework\Configuration\FilesystemLocator;

use PHPixie\BundleFramework\Assets;

/**
 * Merges template locators
 */
class Template extends \PHPixie\BundleFramework\Configuration\FilesystemLocator
{
    /**
     * @var Assets
     */
    protected $assets;

    /**
     * Constructor
     * @param \PHPixie\Bundles\FilesystemLocators $bundleLocators
     * @param Assets $assets
     * @param \PHPixie\Filesystem\Locators\Locator|null $overridesLocator
     */
    public function __construct($bundleLocators, $assets, $overridesLocator = null)
    {
        $this->assets = $assets;
        parent::__construct($bundleLocators, $overridesLocator);
    }

    /**
     * @inheritdoc
     */
    protected function getLocator($name)
    {
        if($name === 'framework')
        {
            return $this->assets->frameworkTemplateLocator();
        }
        
        return $this->getBundleLocator($name);
    }
}