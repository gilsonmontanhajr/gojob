<?php

namespace PHPixie\BundleFramework;

abstract class Builder extends \PHPixie\Framework\Builder
{
    /**
     * Framework configuration
     * @return Configuration
     */
    public function configuration()
    {
        return $this->instance('configuration');
    }

    /**
     * Bundle registry
     * @return Bundles
     */
    public function bundles()
    {
        return $this->instance('bundles');
    }

    /**
     * Assets
     * @return Assets
     */
    public function assets()
    {
        return parent::assets();
    }

    /**
     * Framework components
     * @return Components
     */
    public function components()
    {
        return parent::components();
    }

    /**
     * Framework components
     * @return Components
     */
    protected function buildComponents()
    {
        return new Components($this);
    }

    /**
     * @return Assets
     */
    protected function buildAssets()
    {
        return new Assets(
            $this->components(),
            $this->getRootDirectory()
        );
    }

    /**
     * @return Configuration
     */
    protected function buildConfiguration()
    {
        return new Configuration($this);
    }

    /**
     * Build project bundles registry
     * @return Bundles
     */
    abstract protected function buildBundles();

    /**
     * Project root directory
     * @return string
     */
    abstract protected function getRootDirectory();
}