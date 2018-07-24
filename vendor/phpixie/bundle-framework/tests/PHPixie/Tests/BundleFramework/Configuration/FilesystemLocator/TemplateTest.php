<?php

namespace PHPixie\Tests\BundleFramework\Configuration\FilesystemLocator;

/**
 * @coversDefaultClass \PHPixie\BundleFramework\Configuration\FilesystemLocator\Template
 */
class TemplateTest extends \PHPixie\Tests\BundleFramework\Configuration\FilesystemLocatorTest
{
    protected $assets;
    
    public function setUp()
    {
        $this->assets = $this->abstractMock('\PHPixie\BundleFramework\Assets');
        parent::setUp();
    }
    
    /**
     * @covers ::locate
     * @covers ::<protected>
     */
    public function testFrameworkLocator()
    {
        $this->filesystemLocator = $this->filesystemLocator(false);
        $locator = $this->getLocator();
        
        $this->method($this->assets, 'frameworkTemplateLocator', $locator, array(), 0);
        $this->method($locator, 'locate', '/trixie', array('pixie', false), 0);
        
        $this->assertSame('/trixie', $this->filesystemLocator->locate('framework:pixie'));
    }
    
    protected function prepareGetLocator($name, $locator)
    {
        return $this->prepareGetBundleLocator($name, $locator);
    }
    
    protected function bundleLocators()
    {
        return $this->quickMock('\PHPixie\Bundles\FilesystemLocators\Template');
    }
    
    protected function filesystemLocator($withOverride = true)
    {
        return new \PHPixie\BundleFramework\Configuration\FilesystemLocator\Template(
            $this->bundleLocators,
            $this->assets,
            $withOverride ? $this->overridesLocator : null
        );
    }
}