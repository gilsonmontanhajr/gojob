<?php

namespace PHPixie\BundleFramework;

/**
 * Bundle registry
 */
abstract class Bundles implements \PHPixie\Bundles\Registry
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $bundles;

    /**
     * Constructor
     * @param Builder $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     * @inheritdoc
     */
    public function bundles()
    {
        $this->requireBundles();
        return $this->bundles;
    }

    /**
     * @inheritdoc
     */
    public function get($name, $isRequired = true)
    {
        $this->requireBundles();
        
        if(array_key_exists($name, $this->bundles)) {
            return $this->bundles[$name];
        }
        
        if(!$isRequired) {
            return null;
        }
        
        throw new \PHPixie\BundleFramework\Exception("Bundle '$name' does not exist");
    }

    /**
     * @return void
     */
    protected function requireBundles()
    {
        if($this->bundles !== null) {
            return;
        }
        
        $bundles = array();
        foreach($this->buildBundles() as $bundle) {
            $bundles[$bundle->name()] = $bundle;
        }
        
        $this->bundles = $bundles;
    }

    /**
     * Build bundles
     * @return array
     */
    abstract protected function buildBundles();
}