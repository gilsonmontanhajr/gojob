<?php

namespace PHPixie\BundleFramework;

/**
 * Framework components
 */
class Components extends \PHPixie\Framework\Components
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * Bundles component
     * @return \PHPixie\Bundles
     */
    public function bundles()
    {
        return $this->instance('bundles');
    }

    /**
     * @return \PHPixie\Bundles
     */
    protected function buildBundles()
    {
        $configuration = $this->builder->configuration();
        
        return new \PHPixie\Bundles(
            $this->builder->bundles(),
            $configuration->bundlesConfig()
        );
    }
}