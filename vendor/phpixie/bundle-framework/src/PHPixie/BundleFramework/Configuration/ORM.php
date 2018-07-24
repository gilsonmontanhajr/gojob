<?php

namespace PHPixie\BundleFramework\Configuration;

use PHPixie\Slice\Type\ArrayData;

/**
 * Merges bundle ORM configuration
 */
class ORM
{
    /**
     * @var \PHPixie\Slice
     */
    protected $slice;

    /**
     * @var \PHPixie\Bundles\ORM
     */
    protected $bundlesOrm;
    
    protected $instances = array();

    /**
     * Constructor
     * @param \PHPixie\Slice $slice
     * @param \PHPixie\Bundles\ORM $bundlesOrm
     */
    public function __construct($slice, $bundlesOrm)
    {
        $this->slice      = $slice;
        $this->bundlesOrm = $bundlesOrm;
    }

    /**
     * Merged configuration data
     * @return ArrayData
     */
    public function configData()
    {
        return $this->instance('configData');
    }

    /**
     * Merged ORM wrappers
     * @return ORM\Wrappers
     */
    public function wrappers()
    {
        return $this->instance('wrappers');
    }

    /**
     * @param string $name
     * @return mixed
     */
    protected function instance($name)
    {
        if(!array_key_exists($name, $this->instances)) {
            $method = 'build'.ucfirst($name);
            $this->instances[$name] = $this->$method();
        }
        
        return $this->instances[$name];
    }

    /**
     * @return ArrayData
     */
    protected function buildConfigData()
    {
        $configMap = $this->bundlesOrm->configMap();
        
        $models = array();
        $relationships = array();
        
        foreach($configMap as $configData) {
            $modelsData = $configData->get('models', array());
            foreach($modelsData as $name => $modelData) {
                $models[$name] = $modelData;
            }
            
            $relationshipsData = $configData->get('relationships', array());
            foreach($relationshipsData as $relationshipData) {
                $relationships[] = $relationshipData;
            }
        }
        
        return $this->slice->arrayData(array(
            'models'        => $models,
            'relationships' => $relationships
        ));
    }

    /**
     * @return ORM\Wrappers
     */
    protected function buildWrappers()
    {
        return new ORM\Wrappers($this->bundlesOrm);
    }
}