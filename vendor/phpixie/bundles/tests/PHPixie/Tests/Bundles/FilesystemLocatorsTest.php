<?php

namespace PHPixie\Tests\Bundles;

/**
 * @coversDefaultClass \PHPixie\Bundles\FilesystemLocators
 */
abstract class FilesystemLocatorsTest extends \PHPixie\Test\Testcase
{
    protected $bundleRegistry;
    
    protected $filesystemLocators;
    
    public function setUp()
    {
        $this->bundleRegistry = $this->quickMock('\PHPixie\Bundles\Registry');
        $this->filesystemLocators = $this->filesystemLocators();
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
        $this->getTest();
        $this->getTest(true);
        $this->getTest(true, true);
    }
    
    protected function getTest($isNested = false, $isRegistry = false)
    {
        $this->filesystemLocators = $this->filesystemLocators();
        
        $name = $isNested ? 'pixie:trixie:fairy' : 'pixie';
        
        if($isRegistry) {
            $locator = $this->quickMock('\PHPixie\Filesystem\Locators\Registry');
        }else{
            $locator = $this->getLocator();
        }
        
        $this->prepareGetBundle('pixie', $locator);
        if($isNested) {
            if($isRegistry) {
                $nested = $this->getLocator();
                $this->method($locator, 'get', $nested, array('trixie:fairy'), 0);
                $locator = $nested;
                
            }else{
                $locator = null;
            }
        }
        
        $filesystemLocators = $this->filesystemLocators;
        if($locator !== null) {
            $this->assertSame($locator, $filesystemLocators->get($name));
            
        }else{
            $this->assertException(function() use($filesystemLocators, $name) {
                $filesystemLocators->get($name);
            }, '\PHPixie\Bundles\Exception');
        }
    }
    
    /**
     * @covers ::bundleLocator
     * @covers ::<protected>
     */
    public function testBundleLocator()
    {
        $this->bundleLocatorTest();
        $this->bundleLocatorTest(true);
        $this->bundleLocatorTest(true, true);
    }
    
    protected function bundleLocatorTest($bundleExists = false, $isRequired = true)
    {
        $this->filesystemLocators = $this->filesystemLocators();
        if($bundleExists) {
            $this->method($this->bundleRegistry, 'get', null, array('pixie', $isRequired), 0);
            $locator = null;
        }else{
            $locator = $this->getLocator();
            $this->prepareGetBundle('pixie', $locator, $isRequired);
        }
        
        $params = array('pixie');
        if(!$isRequired) {
            $params[]= $isRequired;
        }
        
        $callback = array($this->filesystemLocators, 'get');
        
        if($locator === null) {
            $this->assertSame(null, call_user_func_array($callback, $params));
            
        }else{
            for($i=0; $i<2; $i++) {
                $this->assertSame($locator, call_user_func_array($callback, $params));
            }
        }
    }
    
    protected function prepareGetBundle($name, $locator, $isRequired = null)
    {
        $params = array('pixie');
        if($isRequired !== null) {
            $params[]= $isRequired;
        }
        
        $bundle = $this->prepareGetBundleLocator($locator);
        $this->method($this->bundleRegistry, 'get', $bundle, $params, 0);
    }
    
    abstract protected function prepareGetBundleLocator($locator);
    abstract protected function getLocator();
    abstract protected function filesystemLocators();
}