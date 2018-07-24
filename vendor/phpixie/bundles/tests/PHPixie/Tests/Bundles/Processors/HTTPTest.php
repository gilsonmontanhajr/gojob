<?php

namespace PHPixie\Tests\Bundles;

/**
 * @coversDefaultClass \PHPixie\Bundles\Processors\HTTP
 */
class HTTPTest extends \PHPixie\Tests\Bundles\ProcessorsTest
{
    
    /**
     * @covers ::get
     * @covers ::<protected>
     */
    public function testGetInvalidBundle()
    {
        $value = $this->getValue();
        $bundle = $this->quickMock('\PHPixie\Bundles\Bundle');
        
        $this->method($this->bundleRegistry, 'get', $bundle, array('pixie', false), 0);
        $this->assertSame(null, $this->processors->get('pixie'));
    }
    
    protected function prepareProcessor($bundle)
    {
        $processor = $this->getProcessor();
        $this->method($bundle, 'httpProcessor', $processor, array(), 0);
        return $processor;
    }
    
    protected function getBundle()
    {
        return $this->quickMock('\PHPixie\Bundles\Bundle\Provides\HTTPProcessor');
    }
    
    protected function getValue()
    {
        return $this->quickMock('\PHPixie\HTTP\Request');
    }
    
    protected function processors()
    {
        return new \PHPixie\Bundles\Processors\HTTP($this->bundleRegistry);
    }
}