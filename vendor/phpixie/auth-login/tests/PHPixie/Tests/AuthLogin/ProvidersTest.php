<?php

namespace PHPixie\Tests\AuthLogin;

/**
 * @coversDefaultClass \PHPixie\AuthLogin\Providers
 */
class ProvidersTest extends \PHPixie\Tests\Auth\Providers\Builder\ImplementationTest
{
    protected $security;
    
    protected $providers;
        
    public function setUp()
    {
        $this->security = $this->quickMock('\PHPixie\Security');
        
        $this->providers = new \PHPixie\AuthLogin\Providers($this->security);
    }
    
    /**
     * @covers ::__construct
     * @covers ::<protected>
     */
    public function testConstruct()
    {
    
    }
    
    /**
     * @covers ::passsword
     * @covers ::<protected>
     */
    public function testPassword()
    {
        $passwordHandler = $this->quickMock('\PHPixie\Security\Password');
        $this->method($this->security, 'password', $passwordHandler, array(), 0);
        
        $this->providerTest('password', '\PHPixie\AuthLogin\Providers\Password', array(
            'passwordHandler' => $passwordHandler
        ));
    }
    
    public function testName()
    {
        $this->assertSame('login', $this->providers->name());
    }
    
    protected function builderMock($methods = array())
    {
        return $this->getMock(
            '\PHPixie\AuthLogin\Providers',
            $methods,
            array($this->security)
        );
    }
}