<?php

namespace PHPixie\Tests\BundleFramework;

/**
 * @coversDefaultClass \PHPixie\BundleFramework\Builder
 */
class BuilderTest extends \PHPixie\Tests\Framework\BuilderTest
{
    /**
     * @covers ::assets
     * @covers ::<protected>
     */
    public function testAssets()
    {
        $this->builder = $this->builderMock(array('components'));
        
        $components = $this->prepareInstance('components', '\PHPixie\BundleFramework\Components');
        $this->method($this->builder, 'getRootDirectory', '/trixie', array());
        
        $this->instanceTest('assets', '\PHPixie\BundleFramework\Assets', array(
            'components'    => $components,
            'rootDirectory' => '/trixie'
        ));
    }
    
    /**
     * @covers ::bundles
     * @covers ::<protected>
     */
    public function testBundles()
    {
        $this->builder = $this->builderMock(array('buildBundles'));
        
        $bundles = $this->abstractMock('\PHPixie\BundleFramework\Bundles');
        $this->method($this->builder, 'buildBundles', $bundles, array(), 0);
        
        for($i=0; $i<2; $i++) {
            $this->assertSame($bundles, $this->builder->bundles());
        }
    }
    
    /**
     * @covers ::components
     * @covers ::<protected>
     */
    public function testComponents()
    {
        $this->instanceTest('components', '\PHPixie\BundleFramework\Components', array(
            'builder' => $this->builder
        ));
    }
    
    /**
     * @covers ::configuration
     * @covers ::<protected>
     */
    public function testConfiguration()
    {
        $this->instanceTest('configuration', '\PHPixie\BundleFramework\Configuration', array(
            'builder' => $this->builder
        ));
    }
    
    protected function builderMock($methods = null)
    {
        if($methods === null) {
            $methods = array();
        }
        
        if(!in_array('buildBundles', $methods)) {
            $methods[]= 'buildBundles';
        }
        
        if(!in_array('getRootDirectory', $methods)) {
            $methods[]= 'getRootDirectory';
        }
        
        return $this->getMock(
            '\PHPixie\BundleFramework\Builder',
            $methods
        );
    }
}