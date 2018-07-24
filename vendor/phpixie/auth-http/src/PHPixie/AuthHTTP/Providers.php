<?php

namespace PHPixie\AuthHTTP;

class Providers extends \PHPixie\Auth\Providers\Builder\Implementation
{
    /** @var \PHPixie\Security */
    protected $security;
    /** @var \PHPixie\Framework\Context */
    protected $httpContextContainer;

    /**
     * @param \PHPixie\Security $security
     * @param \PHPixie\Framework\Context $httpContextContainer
     */
    public function __construct($security, $httpContextContainer)
    {
        $this->security             = $security;
        $this->httpContextContainer = $httpContextContainer;
    }

    /**
     * @param \PHPixie\Auth\Domains\Domain $domain
     * @param string $name
     * @param \PHPixie\Slice\Type\ArrayData $configData
     * @return Providers\Cookie
     */
    public function buildCookieProvider($domain, $name, $configData)
    {
        return new Providers\Cookie(
            $this->security->tokens(),
            $this->httpContextContainer,
            $domain,
            $name,
            $configData
        );
    }

    /**
     * @param \PHPixie\Auth\Domains\Domain $domain
     * @param string $name
     * @param \PHPixie\Slice\Type\ArrayData $configData
     * @return Providers\Session
     */
    public function buildSessionProvider($domain, $name, $configData)
    {
        return new Providers\Session(
            $this->httpContextContainer,
            $domain,
            $name,
            $configData
        );
    }
    
    public function name()
    {
        return 'http';
    }
}