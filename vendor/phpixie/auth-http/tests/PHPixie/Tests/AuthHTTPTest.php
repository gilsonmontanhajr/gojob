<?php

namespace PHPixie\Tests;

/**
 * @coversDefaultClass \PHPixie\AuthHTTP
 */
class AuthHTTPTest extends \PHPixie\Test\Testcase
{
    protected $security;
    protected $httpContextContainer;
    
    protected $authHttp;
    
    protected $builder;
    
    public function setUp()
    {
        $this->security = $this->quickMock('\PHPixie\Security');
        $this->httpContextContainer = $this->quickMock('\PHPixie\Auth\Context\Container');
        
        $this->authHttp = $this->getMockBuilder('\PHPixie\AuthHTTP')
            ->setMethods(array('buildBuilder'))
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->builder = $this->quickMock('\PHPixie\AuthHTTP\Builder');
        $this->method($this->authHttp, 'buildBuilder', $this->builder, array(
            $this->security,
            $this->httpContextContainer
        ), 0);
        
        $this->authHttp->__construct(
            $this->security,
            $this->httpContextContainer
        );
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
        $this->authHttp = new \PHPixie\AuthHTTP(
            $this->security,
            $this->httpContextContainer
        );
        
        $builder = $this->authHttp->builder();
        $this->assertInstance($builder, '\PHPixie\AuthHTTP\Builder', array(
            'security'               => $this->security,
            'httpContextContainer'   => $this->httpContextContainer
        ));
    }
    
    /**
     * @covers ::builder
     * @covers ::<protected>
     */
    public function testBuilder()
    {
        $this->assertSame($this->builder, $this->authHttp->builder());
    }
    
    /**
     * @covers ::providers
     * @covers ::<protected>
     */
    public function testProviders()
    {
        $providers = $this->quickMock('\PHPixie\AuthHTTP\Providers');
        $this->method($this->builder, 'providers', $providers, array(), 0);
        $this->assertSame($providers, $this->authHttp->providers());
    }
}