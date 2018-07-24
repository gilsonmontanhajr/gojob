<?php

namespace PHPixie;

class AuthHTTP
{
    /** @var AuthHTTP\Builder */
    protected $builder;

    /**
     * @param \PHPixie\Security $security
     * @param \PHPixie\Framework\Context $httpContextContainer
     */
    public function __construct(
        $security,
        $httpContextContainer
    )
    {
        $this->builder = $this->buildBuilder(
            $security,
            $httpContextContainer
        );
    }

    /**
     * @return AuthHTTP\Providers
     */
    public function providers()
    {
        return $this->builder->providers();
    }

    /**
     * @return AuthHTTP\Builder
     */
    public function builder()
    {
        return $this->builder;
    }
    
    protected function buildBuilder(
        $security,
        $httpContextContainer
    )
    {
        return new AuthHTTP\Builder(
            $security,
            $httpContextContainer
        );
    }
}