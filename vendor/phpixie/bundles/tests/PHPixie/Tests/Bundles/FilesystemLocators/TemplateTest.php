<?php

namespace PHPixie\Tests\Bundles\FilesystemLocators;

/**
 * @coversDefaultClass \PHPixie\Bundles\FilesystemLocators\Template
 */
class TemplateTest extends \PHPixie\Tests\Bundles\FilesystemLocatorsTest
{
    /**
     * @covers ::bundleLocator
     * @covers ::<protected>
     */
    public function testGetInvalidBundle()
    {
        $this->invalidBundleTest(false, false);
        $this->invalidBundleTest(false, true);
        $this->invalidBundleTest(true, false);
        $this->invalidBundleTest(true, true);
    }
    
    protected function invalidBundleTest($validBundle = false, $isRequired = false)
    {
        if($validBundle) {
            $bundle = $this->prepareGetBundleLocator(null);
        }else{
            $bundle = $this->quickMock('\PHPixie\Bundles\Bundle');
        }
        
        $this->method($this->bundleRegistry, 'get', $bundle, array('pixie'), 0);
        
        $filesystemLocators = $this->filesystemLocators();
        
        if(!$isRequired) {
            $this->assertSame(null, $filesystemLocators->bundleLocator('pixie', false));
        }else{
            $this->assertException(function() use($filesystemLocators) {
                $filesystemLocators->bundleLocator('pixie');
            }, '\PHPixie\Bundles\Exception');
        }
    }
    
    protected function prepareGetBundleLocator($locator)
    {
        $bundle = $this->quickMock('\PHPixie\Bundles\Bundle\Provides\TemplateLocator');
        $this->method($bundle, 'templateLocator', $locator, array());
        return $bundle;
    }
    
    protected function getLocator()
    {
        return $this->quickMock('\PHPixie\Bundles\Bundle\Provides\TemplateLocator');
    }
    
    protected function filesystemLocators()
    {
        return new \PHPixie\Bundles\FilesystemLocators\Template(
            $this->bundleRegistry
        );
    }
}