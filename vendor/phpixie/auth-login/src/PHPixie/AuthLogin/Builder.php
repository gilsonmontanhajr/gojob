<?php

namespace PHPixie\AuthLogin;

class Builder
{
    /** @var \PHPixie\Security */
    protected $security;
    /** @var Providers */
    protected $providers;

    /**
     * @param \PHPixie\Security $security
     */
    public function __construct($security)
    {
        $this->security = $security;
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
        return new Providers($this->security);
    }
}