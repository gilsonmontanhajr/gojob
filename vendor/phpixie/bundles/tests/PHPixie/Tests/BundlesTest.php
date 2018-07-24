<?php

namespace PHPixie\Tests;

/**
 * @coversDefaultClass \PHPixie\Bundles
 */
class BundlesTest extends \PHPixie\Test\Testcase
{
    protected $bundleRegistry;
    protected $configData;
    
    protected $bundles;
    
    protected $builder;
    
    public function setUp()
    {
        $this->bundleRegistry = $this->quickMock('\PHPixie\Bundles\Registry');
        $this->configData     = $this->getSliceData();
        
        $this->bundles = $this->getMockBuilder('\PHPixie\Bundles')
            ->setMethods(array('buildBuilder'))
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->builder = $this->quickMock('\PHPixie\Bundles\Builder');
        $this->method($this->builder, 'registry', $this->bundleRegistry, array());
        
        $this->method($this->bundles, 'buildBuilder', $this->builder, array(
            $this->bundleRegistry,
            $this->configData
        ), 0);
        
        $this->bundles->__construct(
            $this->bundleRegistry,
            $this->configData
        );
    }
    
    /**
     * @covers ::__construct
     * @covers ::<protected>
     */
    public function testConstructor()
    {
        
    }
    
    /**
     * @covers ::buildBuilder
     * @covers ::<protected>
     */
    public function testBuildBuilder()
    {
        $this->bundles = new \PHPixie\Bundles(
            $this->bundleRegistry,
            $this->configData
        );
        
        $builder = $this->bundles->builder();
        $this->assertInstance($builder, '\PHPixie\Bundles\Builder', array(
            'bundleRegistry' => $this->bundleRegistry,
            'configData'     => $this->configData
        ));
    }
    
    /**
     * @covers ::builder
     * @covers ::<protected>
     */
    public function testBuilder()
    {
        $this->assertSame($this->builder, $this->bundles->builder());
    }
    
    /**
     * @covers ::registry
     * @covers ::<protected>
     */
    public function testRegistry()
    {
        $this->assertSame($this->bundleRegistry, $this->bundles->registry());
    }
    
    /**
     * @covers ::bundles
     * @covers ::<protected>
     */
    public function testBundles()
    {
        $bundles = array(
            'pixie' => $this->getBundle()
        );
        
        $this->method($this->bundleRegistry, 'bundles', $bundles, array(), 0);
        $this->assertSame($bundles, $this->bundles->bundles());
    }
    
    /**
     * @covers ::get
     * @covers ::<protected>
     */
    public function testGet()
    {
        $bundle = $this->getBundle();
        
        $this->method($this->bundleRegistry, 'get', $bundle, array('pixie'), 0);
        $this->assertSame($bundle, $this->bundles->get('pixie'));
    }
    
    /**
     * @covers ::config
     * @covers ::<protected>
     */
    public function testConfig()
    {
        $sliceData = $this->getSliceData();
        
        $this->method($this->builder, 'config', $sliceData, array('pixie'), 0);
        $this->assertSame($sliceData, $this->bundles->config('pixie'));
    }
    
    /**
     * @covers ::httpProcessors
     * @covers ::<protected>
     */
    public function testHttpProcessors()
    {
        $this->instanceTest('httpProcessors', '\PHPixie\Bundles\Processors\HTTP');
    }
    
    /**
     * @covers ::templateLocators
     * @covers ::<protected>
     */
    public function testTemplateLocators()
    {
        $this->instanceTest('templateLocators', '\PHPixie\Bundles\FilesystemLocators\Template');
    }
    
    /**
     * @covers ::routeResolvers
     * @covers ::<protected>
     */
    public function testRouteResolvers()
    {
        $this->instanceTest('routeResolvers', '\PHPixie\Bundles\RouteResolvers');
    }
    
    /**
     * @covers ::auth
     * @covers ::<protected>
     */
    public function testAuth()
    {
        $this->instanceTest('auth', '\PHPixie\Bundles\Auth');
    }
    
    /**
     * @covers ::orm
     * @covers ::<protected>
     */
    public function testOrm()
    {
        $this->instanceTest('orm', '\PHPixie\Bundles\ORM');
    }
    
    protected function instanceTest($method, $class)
    {
        $mock = $this->quickMock($class);
        $this->method($this->builder, $method, $mock, array(), 0);
        $this->assertSame($mock, $this->bundles->$method());
    }
    
    protected function getBundle()
    {
        $this->quickMock('\PHPixie\Bundles\Bundle');
    }
    
    protected function getSliceData()
    {
        return $this->quickMock('\PHPixie\Slice\Data');
    }
}