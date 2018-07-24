<?php

namespace PHPixie\AuthLogin;

class Providers extends \PHPixie\Auth\Providers\Builder\Implementation
{
    /** @var \PHPixie\Security */
    protected $security;

    /**
     * @param \PHPixie\Security $security
     */
    public function __construct($security)
    {
        $this->security = $security;
    }

    /**
     * @param \PHPixie\Auth\Domains\Domain $domain
     * @param string $name
     * @param \PHPixie\Slice\Type\ArrayData $configData
     * @return Providers\Password
     */
    public function buildPasswordProvider($domain, $name, $configData)
    {
        return new Providers\Password(
            $this->security->password(),
            $domain,
            $name,
            $configData
        );
    }

    public function name()
    {
        return 'login';
    }
}