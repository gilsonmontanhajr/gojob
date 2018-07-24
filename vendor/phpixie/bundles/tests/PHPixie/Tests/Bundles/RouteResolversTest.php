<?php

namespace PHPixie\Tests\Bundles;

/**
 * @coversDefaultClass \PHPixie\Bundles\RouteResolvers
 */
class RouteResolversTest extends \PHPixie\Test\Testcase
{
    protected $bundleRegistry;
    
    protected $routeResolvers;
    
    public function setUp()
    {
        $this->bundleRegistry = $this->quickMock('\PHPixie\Bundles\Registry');
        
        $this->routeResolvers = new \PHPixie\Bundles\RouteResolvers(
            $this->bundleRegistry
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
     * @covers ::get
     * @covers ::<protected>
     */
    public function testGet()
    {
        $routeResolvers = $this->routeResolvers;
        
        $this->prepareGetTest('pixie', false);
        $this->assertException(function() use($routeResolvers) {
            $routeResolvers->get('pixie');
        }, '\PHPixie\Bundles\Exception');
        
        $resolver = $this->prepareGetTest('pixie', true);
        $this->assertSame($resolver, $routeResolvers->get('pixie'));
        
        $this->prepareGetTest('pixie.trixie', true, true, false);
        $this->assertException(function() use($routeResolvers) {
            $routeResolvers->get('pixie.trixie');
        }, '\PHPixie\Bundles\Exception');
        
        $resolver = $this->prepareGetTest('pixie.trixie', true, true, true);
        $this->assertSame($resolver, $routeResolvers->get('pixie.trixie'));
    }
    
    protected function prepareGetTest($name, $providesResolver = false, $nested = false, $isRegistry = false)
    {
        if($providesResolver) {
            $bundle = $this->quickMock('\PHPixie\Bundles\Bundle\Provides\RouteResolver');
        }else{
            $bundle = $this->quickMock('\PHPixie\Bundles\Bundle');
        }
        
        $name = explode('.', $name, 2);
        $this->method($this->bundleRegistry, 'get', $bundle, array($name[0]), 0);
        
        if(!$providesResolver) {
            return;
        }
        
        if($isRegistry) {
            $resolver = $this->quickMock('\PHPixie\Route\Resolvers\Registry');
        }else{
            $resolver = $this->quickMock('\PHPixie\Route\Resolvers\Resolver');
        }
            
        $this->method($bundle, 'routeResolver', $resolver, array(), 0);
        
        if($isRegistry) {
            $nestedResolver = $this->quickMock('\PHPixie\Route\Resolvers\Resolver');
            $this->method($resolver, 'get', $nestedResolver, array($name[1]), 0);
            $resolver = $nestedResolver;
        }
        
        return $resolver;
    }
}