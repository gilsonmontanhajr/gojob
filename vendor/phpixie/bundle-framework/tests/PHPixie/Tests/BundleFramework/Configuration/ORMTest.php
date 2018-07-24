<?php

namespace PHPixie\Tests\BundleFramework\Configuration;

/**
 * @coversDefaultClass \PHPixie\BundleFramework\Configuration\ORM
 */
class ORMTest extends \PHPixie\Test\Testcase
{
    protected $slice;
    protected $bundlesOrm;
    
    protected $orm;
    
    public function setUp()
    {
        $this->slice     = $this->quickMock('\PHPixie\Slice');
        $this->bundlesOrm = $this->quickMock('\PHPixie\Bundles\ORM');
        
        $this->orm = new \PHPixie\BundleFramework\Configuration\ORM(
            $this->slice,
            $this->bundlesOrm
        );
    }
    
    /**
     * @covers ::__construct
     * @covers ::<protected>
     */
    public function testConstruct()
    {
    
    }
    
    /**
     * @covers ::configData
     * @covers ::<protected>
     */
    public function testConfigData()
    {
        $configs = array(
            'app' => array(
                'models' => array(
                    'pixie' => array('type' => 'database'),
                    'trixie' => array('type' => 'database')
                ),
                'relationships' => array(
                    array('type' => 'oneToOne'),
                    array('type' => 'oneToOne'),
                )
            ),
            'test' => array(
                'models' => array(
                    'blum' => array('type' => 'embedded'),
                ),
                'relationships' => array(
                    array('type' => 'oneToMany'),
                )
            )
        );
        
        $configMap = array();
        
        foreach($configs as $bundleName => $config) {
            $bundleData = $this->getSliceData();
            
            $this->method($bundleData, 'get', $config['models'], array('models', array()), 0);
            $this->method($bundleData, 'get', $config['relationships'], array('relationships', array()), 1);
            
            $configMap[$bundleName] = $bundleData;
        }
        
        $this->method($this->bundlesOrm, 'configMap', $configMap, array(), 0);
        
        $mergedData = $this->getSliceData();
        $this->method($this->slice, 'arrayData', $mergedData, array(array(
            'models'        => array_merge($configs['app']['models'], $configs['test']['models']),
            'relationships' => array_merge($configs['app']['relationships'], $configs['test']['relationships']),
        )), 0);
        
        for($i=0; $i<2; $i++) {
            $this->assertSame($mergedData, $this->orm->configData());
        }
    }
    
    /**
     * @covers ::wrappers
     * @covers ::<protected>
     */
    public function testWrappers()
    {
        $this->method($this->bundlesOrm, 'wrappersMap', array(), array(), 0);
        
        $wrappers = $this->orm->wrappers();
        $this->assertInstance($wrappers, '\PHPixie\BundleFramework\Configuration\ORM\Wrappers');
        
        $this->assertSame($wrappers, $this->orm->wrappers());
    }
    
    protected function getSliceData()
    {
        return $this->quickMock('\PHPixie\Slice\Data');
    }
}