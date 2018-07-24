<?php

namespace PHPixie\Tests\Bundles;

/**
 * @coversDefaultClass \PHPixie\Bundles\Processors
 */
abstract class ProcessorsTest extends \PHPixie\Test\Testcase
{
    protected $bundleRegistry;
    
    protected $processors;
    
    public function setUp()
    {
        $this->bundleRegistry = $this->quickMock('\PHPixie\Bundles\Registry');
        
        $this->processors = $this->processors();
    }
    
    /**
     * @covers ::__construct
     * @covers ::<protected>
     */
    public function testConstruct()
    {
    
    }
    
    /**
     * @covers ::get
     * @covers ::<protected>
     */
    public function testGet()
    {
        $this->getTest(false);
        $this->getTest(true);
    }
    
    protected function getTest($bundleExists = false)
    {
        if($bundleExists) {
            $bundle    = $this->getBundle();
            $processor = $this->prepareProcessor($bundle);
        }else{
            $bundle    = null;
            $processor = null;
        }
        
        $this->method($this->bundleRegistry, 'get', $bundle, array('pixie', false), 0);
        $this->assertSame($processor, $this->processors->get('pixie'));
    }
    
    protected function getProcessor()
    {
        return $this->quickMock('\PHPixie\Processors\Processor');
    }
    
    abstract protected function prepareProcessor($bundle);
    abstract protected function getBundle();
    abstract protected function getValue();
    
    abstract protected function processors();
}   