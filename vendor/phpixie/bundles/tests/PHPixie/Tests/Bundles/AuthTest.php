<?php

namespace PHPixie\Tests\Bundles;

/**
 * @coversDefaultClass \PHPixie\Bundles\Auth
 */
class AuthTest extends \PHPixie\Test\Testcase
{
    protected $bundleRegistry;
    protected $auth;
    
    public function setUp()
    {
        $this->bundleRegistry = $this->quickMock('\PHPixie\Bundles\Registry');
        $this->auth = new \PHPixie\Bundles\Auth($this->bundleRegistry);
    }
    
    /**
     * @covers ::__construct
     * @covers ::<protected>
     */
    public function testConstruct()
    {
    
    }
    
    /**
     * @covers ::repository
     * @covers ::<protected>
     */
    public function testRepository()
    {
        $this->repositoryTest(false);
        $this->repositoryTest(true);
        $this->repositoryTest(true, true);
    }
    
    protected function repositoryTest($isAuthBundle = false, $hasRepositories = false)
    {
        
        $bundle = $this->prepareGetAuthBundle('pixie', $isAuthBundle);
        
        $repository = null;
        
        if($isAuthBundle) {
            if($hasRepositories) {
                $repositories = $this->quickMock('\PHPixie\Auth\Repositories\Registry');
                
                $repository   = $this->quickMock('\PHPixie\Auth\Repositories\Repository');
                $this->method($repositories, 'repository', $repository, array('fairy'), 0);
            }else{
                $repositories = null;
            }
            
            $this->method($bundle, 'authRepositories', $repositories, array(), 0);
        }
        
        if($repository !== null) {
            $this->assertSame($repository, $this->auth->repository('pixie.fairy'));
            
        }else{
            $auth = $this->auth;
            $this->assertException(function() use($auth) {
                $auth->repository('pixie.fairy');
            }, '\PHPixie\Bundles\Exception');
        }
    }
    
    protected function prepareGetAuthBundle($name, $providesAuth)
    {
        $return = null;
        
        if($providesAuth) {
            $bundle = $this->quickMock('\PHPixie\Bundles\Bundle\Provides\Auth');
            $return = $bundle;
        }else{
            $bundle = $this->quickMock('\PHPixie\Bundles\Bundle');
        }
        
        $this->method($this->bundleRegistry, 'get', $bundle, array($name), 0);
        
        return $return;
    }
}