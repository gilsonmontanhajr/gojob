<?php

namespace PHPixie\Tests;

/**
 * @coversDefaultClass \PHPixie\AuthLogin
 */
class AuthLoginTest extends \PHPixie\Test\Testcase
{
    protected $security;
    
    protected $authLogin;
    
    protected $builder;
    
    public function setUp()
    {
        $this->security = $this->quickMock('\PHPixie\Security');
        
        $this->authLogin = $this->getMockBuilder('\PHPixie\AuthLogin')
            ->setMethods(array('buildBuilder'))
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->builder = $this->quickMock('\PHPixie\AuthLogin\Builder');
        $this->method($this->authLogin, 'buildBuilder', $this->builder, array(
            $this->security
        ), 0);
        
        $this->authLogin->__construct($this->security);
    }
    
    /**
     * @covers ::__construct
     * @covers ::<protected>
     */
    public function testConstructor()
    {
        
    }
    
    /**
     * @covers ::buildBuilder
     * @covers ::<protected>
     */
    public function testBuildBuilder()
    {
        $this->authLogin = new \PHPixie\AuthLogin($this->security);
        
        $builder = $this->authLogin->builder();
        $this->assertInstance($builder, '\PHPixie\AuthLogin\Builder', array(
            'security'               => $this->security
        ));
    }
    
    /**
     * @covers ::builder
     * @covers ::<protected>
     */
    public function testBuilder()
    {
        $this->assertSame($this->builder, $this->authLogin->builder());
    }
    
    /**
     * @covers ::providers
     * @covers ::<protected>
     */
    public function testProviders()
    {
        $providers = $this->quickMock('\PHPixie\AuthLogin\Providers');
        $this->method($this->builder, 'providers', $providers, array(), 0);
        $this->assertSame($providers, $this->authLogin->providers());
    }
}