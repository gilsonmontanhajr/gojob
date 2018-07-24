<?php

namespace PHPixie\Tests\BundleFramework;

/**
 * @coversDefaultClass \PHPixie\BundleFramework\Components
 */
class ComponentsTest extends \PHPixie\Tests\Framework\ComponentsTest
{
    /**
     * @covers ::bundles
     * @covers ::<protected>
     */
    public function testBundles()
    {
        $bundles = $this->abstractMock('\PHPixie\BundleFramework\Bundles');
        $this->method($this->builder, 'bundles', $bundles, array());
        
        $configData = $this->prepareConfig('bundles');
        
        $this->assertComponent('bundles', '\PHPixie\Bundles', array(
            //'bundleRegistry' => $bundles,
            //'configData'     => $configData
        ));
    }
    
    protected function builder()
    {
        return $this->abstractMock('\PHPixie\BundleFramework\Builder');
    }
    
    protected function configuration()
    {
        return $this->quickMock('\PHPixie\BundleFramework\Configuration');
    }
    
    protected function components($methods)
    {
        return $this->getMock(
            '\PHPixie\BundleFramework\Components',
            $methods,
            array($this->builder)
        );
    }
}