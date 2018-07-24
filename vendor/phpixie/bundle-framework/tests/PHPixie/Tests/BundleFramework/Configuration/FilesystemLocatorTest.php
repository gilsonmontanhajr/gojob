<?php

namespace PHPixie\Tests\BundleFramework\Configuration;

/**
 * @coversDefaultClass \PHPixie\BundleFramework\Configuration\FilesystemLocator
 */
class FilesystemLocatorTest extends \PHPixie\Test\Testcase
{
    protected $bundleLocators;
    protected $overridesLocator;
    
    protected $filesystemLocator;
    
    public function setUp()
    {
        $this->bundleLocators  = $this->bundleLocators();
        $this->overridesLocator = $this->quickMock('\PHPixie\Filesystem\Locators\Locator');
        
        $this->filesystemLocator = $this->filesystemLocator();
    }
    
    /**
     * @covers ::__construct
     * @covers \PHPixie\BundleFramework\Configuration\FilesystemLocator::__construct
     * @covers ::<protected>
     */
    public function testConstruct()
    {
    
    }
    
    /**
     * @covers ::locate
     * @covers ::<protected>
     */
    public function testLocate()
    {
        $this->locateTest();
        $this->locateTest(true);
        $this->locateTest(true, true);
        
        $this->locateTest(false, false, true);
        $this->locateTest(false, false, true, true);
        
        $this->locateTest(true, false, true, true, true);
    }
    
    protected function locateTest(
        $withOverride   = false,
        $overrideExists = false,
        $validName      = false,
        $locatorExists  = false,
        $isDirectory    = false
    )
    {
        $name = $validName ? 'pixie:trixie:fairy' : 'pixie';
        
        $expected = $this->prepareLocateTest(
            $name,
            $withOverride,
            $overrideExists,
            $locatorExists,
            $isDirectory
        );
        
        if($isDirectory) {
            $result = $this->filesystemLocator->locate($name, true);
        }else{
            $result = $this->filesystemLocator->locate($name);
        }
    }
    
    protected function prepareLocateTest(
        $name,
        $withOverride,
        $overrideExists,
        $locatorExists,
        $isDirectory
    )
    {
        $this->filesystemLocator = $this->filesystemLocator($withOverride);
        if($withOverride) {
            $override = $overrideExists ? '/fairy' : null;
            $this->method($this->overridesLocator, 'locate', $override, array($name, $isDirectory), 0);
            if($overrideExists) {
                return '/fairy';
            }
        }
        
        $name = explode(':', $name, 2);
        
        if(count($name) !== 2) {
            return null;
        }
        
        $locator = $locatorExists ? $this->getLocator() : null;
        $this->prepareGetLocator($name[0], $locator);
        
        if(!$locatorExists) {
            return null;
        }
        
        $this->method($locator, 'locate', '/fairy', array($name[1], $isDirectory), 0);
        return '/fairy';
    }
    
    protected function prepareGetLocator($name, $locator)
    {
        return $this->prepareGetBundleLocator($name, $locator);
    }
    
    protected function prepareGetBundleLocator($name, $locator)
    {
        $this->method($this->bundleLocators, 'bundleLocator', $locator, array($name, false), 0);
    }
    
    protected function getLocator()
    {
        return $this->quickMock('\PHPixie\Filesystem\Locators\Locator', array('locate'));
    }
    
    protected function bundleLocators()
    {
        return $this->abstractMock('\PHPixie\Bundles\FilesystemLocators');
    }
    
    protected function filesystemLocator($withOverride = true)
    {
        return new \PHPixie\BundleFramework\Configuration\FilesystemLocator(
            $this->bundleLocators,
            $withOverride ? $this->overridesLocator : null
        );
    }
}