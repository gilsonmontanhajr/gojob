<?php

namespace PHPixie\Tests\AuthHTTP;

/**
 * @coversDefaultClass \PHPixie\AuthHTTP\Builder
 */
class BuilderTest extends \PHPixie\Test\Testcase
{
    protected $security;
    protected $httpContextContainer;
    
    protected $providers;
        
    public function setUp()
    {
        $this->security = $this->quickMock('\PHPixie\Security');
        $this->httpContextContainer = $this->quickMock('\PHPixie\HTTP\Context\Container');
        
        $this->builder = new \PHPixie\AuthHTTP\Builder(
            $this->security,
            $this->httpContextContainer
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
     * @covers ::providers
     * @covers ::<protected>
     */
    public function testProviders()
    {
        $providers = $this->builder->providers();
        $this->assertInstance($providers, '\PHPixie\AuthHTTP\Providers', array(
            'security'             => $this->security,
            'httpContextContainer' => $this->httpContextContainer
        ));
        
        $this->assertSame($providers, $this->builder->providers());
    }
}