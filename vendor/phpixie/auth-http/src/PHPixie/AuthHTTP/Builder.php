<?php

namespace PHPixie\AuthHTTP;

class Builder
{
    /** @var \PHPixie\Security */
    protected $security;
    /** @var \PHPixie\Framework\Context */
    protected $httpContextContainer;
    /** @var Providers */
    protected $providers;

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
     * @return Providers
     */
    public function providers()
    {
        if($this->providers === null) {
            $this->providers = $this->buildProviders();
        }
        
        return $this->providers;
    }
    
    protected function buildProviders()
    {
        return new Providers(
            $this->security,
            $this->httpContextContainer
        );
    }
}