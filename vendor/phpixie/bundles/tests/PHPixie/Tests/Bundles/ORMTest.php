<?php

namespace PHPixie\Tests\Bundles;

/**
 * @coversDefaultClass \PHPixie\Bundles\ORM
 */
class ORMTest extends \PHPixie\Test\Testcase
{
    protected $orm;
    
    protected $configsMap  = array();
    protected $wrappersMap = array();
    
    public function setUp()
    {
        foreach(array('pixie', 'trixie') as $name) {
            $this->configsMap[$name] = $this->quickMock('\PHPixie\Slice\Data');
        }
        
        foreach(array('trixie', 'blum') as $name) {
            $this->wrappersMap[$name] = $this->quickMock('\PHPixie\ORM\Wrappers');
        }
        
        $bundles = array();
        foreach(array('pixie', 'trixie', 'blum') as $name) {
            $bundle = $this->quickMock('\PHPixie\Bundles\Bundle\Provides\ORM');
            
            $config   = isset($this->configsMap[$name]) ? $this->configsMap[$name] : null;
            $wrappers = isset($this->wrappersMap[$name]) ? $this->wrappersMap[$name] : null;
            
            $this->method($bundle, 'name', $name, array());
            $this->method($bundle, 'ormConfig', $config, array());
            $this->method($bundle, 'ormWrappers', $wrappers, array());
            
            $bundles[]= $bundle;
        }
        
        $bundles[]= $this->quickMock('\PHPixie\Bundles\Bundle');
        
        $bundleRegistry =  $this->quickMock('\PHPixie\Bundles\Registry');
        $this->method($bundleRegistry, 'bundles', $bundles, array());
        
        $this->orm = new \PHPixie\Bundles\ORM($bundleRegistry);
    }
    
    /**
     * @covers ::__construct
     * @covers ::configMap
     * @covers ::wrappersMap
     * @covers ::<protected>
     */
    public function testConstruct()
    {
        $this->assertSame($this->configsMap, $this->orm->configMap());
        $this->assertSame($this->wrappersMap, $this->orm->wrappersMap());
    }
}