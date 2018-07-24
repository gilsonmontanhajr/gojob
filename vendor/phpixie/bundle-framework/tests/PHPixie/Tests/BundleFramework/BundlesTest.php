<?php

namespace PHPixie\Tests\BundleFramework;

/**
 * @coversDefaultClass \PHPixie\BundleFramework\Bundles
 */
class BundlesTest extends \PHPixie\Test\Testcase
{
    protected $builder;
    
    public function setUp()
    {
        $this->builder = $this->builder();
    }
    
    /**
     * @covers ::__construct
     * @covers \PHPixie\BundleFramework\Bundles::__construct
     * @covers ::<protected>
     */
    public function testConstruct()
    {
        return $this->bundlesMock();
    }
    
    /**
     * @covers ::bundles
     * @covers ::<protected>
     */
    public function testBundles()
    {
        $bundlesMock = $this->bundlesMock('buildBundles');
        $bundles = $this->prepareBundles($bundlesMock);
        
        for($i=0; $i<2; $i++) {
            $this->assertSame($bundles, $bundlesMock->bundles());
        }
    }
    
    /**
     * @covers ::get
     * @covers ::<protected>
     */
    public function testGet()
    {
        $bundlesMock = $this->bundlesMock('buildBundles');
        $bundles = $this->prepareBundles($bundlesMock);
        
        for($i=0; $i<2; $i++) {
            foreach($bundles as $name => $bundle) {
                $this->assertSame($bundle, $bundlesMock->get($name));
            }
        }
        
        $this->assertSame(null, $bundlesMock->get('test', false));
        $this->assertException(function() use($bundlesMock) {
            $bundlesMock->get('test');
        }, '\PHPixie\BundleFramework\Exception');
    }
    
    protected function prepareBundles($bundlesMock)
    {
        $bundles = array();
        
        foreach(array('pixie', 'trixie') as $name) {
            $bundle = $this->quickMock('\PHPixie\Bundles\Bundle');
            $this->method($bundle, 'name', $name, array(), 0);
            
            $bundles[$name] = $bundle;
        }
        
        $this->method($bundlesMock, 'buildBundles', $bundles, array(), 0);
        return $bundles;
    }
    
    protected function builder()
    {
        return $this->abstractMock('\PHPixie\BundleFramework\Builder');
    }
    
    protected function bundlesMock($methods = null)
    {
        if(!is_array($methods)) {
            $methods = array();
        }
        
        if(!in_array('buildBundles', $methods, true)) {
            $methods[]= 'buildBundles';
        }
        
        return $this->getMock(
            '\PHPixie\BundleFramework\Bundles',
            $methods,
            array($this->builder)
        );
    }
}