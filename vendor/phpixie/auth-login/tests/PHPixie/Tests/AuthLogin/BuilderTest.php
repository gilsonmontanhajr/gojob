<?php

namespace PHPixie\Tests\AuthLogin;

/**
 * @coversDefaultClass \PHPixie\AuthLogin\Builder
 */
class BuilderTest extends \PHPixie\Test\Testcase
{
    protected $security;
    
    protected $providers;
        
    public function setUp()
    {
        $this->security = $this->quickMock('\PHPixie\Security');
        
        $this->builder = new \PHPixie\AuthLogin\Builder($this->security);
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
        $this->assertInstance($providers, '\PHPixie\AuthLogin\Providers', array(
            'security' => $this->security
        ));
        
        $this->assertSame($providers, $this->builder->providers());
    }
}