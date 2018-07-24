<?php

namespace PHPixie\Tests\AuthHTTP;

/**
 * @coversDefaultClass \PHPixie\AuthHTTP\Providers
 */
class ProvidersTest extends \PHPixie\Tests\Auth\Providers\Builder\ImplementationTest
{
    protected $security;
    protected $httpContextContainer;
    
    protected $providers;
        
    public function setUp()
    {
        $this->security = $this->quickMock('\PHPixie\Security');
        $this->httpContextContainer = $this->quickMock('\PHPixie\HTTP\Context\Container');
        
        $this->providers = new \PHPixie\AuthHTTP\Providers(
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
     * @covers ::cookie
     * @covers ::<protected>
     */
    public function testCookie()
    {
        $tokens = $this->quickMock('\PHPixie\Security\Tokens');
        $this->method($this->security, 'tokens', $tokens, array(), 0);
        
        $this->providerTest('cookie', '\PHPixie\AuthHTTP\Providers\Cookie', array(
            'tokens' => $tokens,
            'httpContextContainer' => $this->httpContextContainer,
        ));
    }
    
    /**
     * @covers ::session
     * @covers ::<protected>
     */
    public function testSession()
    {
        $this->providerTest('session', '\PHPixie\AuthHTTP\Providers\Session', array(
            'httpContextContainer' => $this->httpContextContainer,
        ));
    }
    
    public function testName()
    {
        $this->assertSame('http', $this->providers->name());
    }
    
    protected function builderMock($methods = array())
    {
        return $this->getMock(
            '\PHPixie\AuthHTTP\Providers',
            $methods,
            array(
                $this->security,
                $this->httpContextContainer
            )
        );
    }
}