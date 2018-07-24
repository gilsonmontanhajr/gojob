<?php

namespace PHPixie\AuthHTTP\Providers;

class Cookie extends    \PHPixie\Auth\Providers\Provider\Implementation
             implements \PHPixie\Auth\Providers\Provider\Persistent
{
    /** @var \PHPixie\Security\Tokens */
    protected $tokens;
    /** @var \PHPixie\Framework\Context */
    protected $httpContextContainer;
    /** @var string */
    protected $cookieName;
    /** @var \PHPixie\Security\Tokens\Handler */
    protected $tokenHandler;

    /**
     * @param \PHPixie\Security\Tokens $tokens
     * @param \PHPixie\Framework\Context $httpContextContainer
     * @param \PHPixie\Auth\Domains\Domain $domain
     * @param string $name
     * @param \PHPixie\Slice\Type\ArrayData $configData
     */
    public function __construct($tokens, $httpContextContainer, $domain, $name, $configData)
    {
        $this->tokens               = $tokens;
        $this->httpContextContainer = $httpContextContainer;
        
        parent::__construct($domain, $name, $configData);
    }

    /**
     * @return \PHPixie\AuthLogin\Repository\User
     */
    public function check()
    {
        $encodedToken = $this->getCookie();
        
        if($encodedToken === null) {
            return null;
        }
        /** @var \PHPixie\Security\Tokens\Token $token */
        $token = $this->tokenHandler()->getByString($encodedToken);
        
        if($token === null) {
            $this->unsetCookie();
            return null;
        }
        
        $userId = $token->userId();
        $user = $this->repository()->getById($userId);
        
        if($user === null) {
            $this->removeToken($encodedToken);
            $this->unsetCookie();
            return null;
        }
        
        if($this->configData->get('refresh', true)) {
            $token = $this->tokenHandler->refresh($token);
            $this->setCookie($token);
        }
        
        $this->domain->setUser($user, $this->name);
        
        $persistProviders = $this->configData->get('persistProviders', array());
        
        foreach($persistProviders as $providerName) {
            /** @var \PHPixie\Auth\Providers\Provider\Persistent $provider */
            $provider = $this->domain->provider($providerName);
            $provider->persist();
        }
        
        return $user;
    }

    /**
     * @param int $lifetime
     * @throws \PHPixie\Auth\Exception
     */
    public function persist($lifetime = null)
    {
        if($lifetime === null) {
            $lifetime = $this->configData->get('defaultLifetime', 14*24*3600);
        }
        
        $user = $this->domain->requireUser();
        $token = $this->tokenHandler()->create($user->id(), $lifetime);
        $this->setCookie($token);
    }
    
    public function forget()
    {
        $encodedToken = $this->getCookie();
        
        if($encodedToken === null) {
            return;
        }
        
        $this->unsetCookie();
        $this->removeToken($encodedToken);
    }

    /**
     * @param \PHPixie\Security\Tokens\Token $token
     */
    protected function setCookie($token)
    {
        $cookies = $this->cookies();
        $cookies->set(
            $this->cookieName(),
            $token->string(),
            $token->expires() - time(),
            '/',
            null,
            false,
            true
        );
    }
    
    
    protected function getCookie()
    {
        $this->cookieName();
        return $this->cookies()->get($this->cookieName);
    }

    protected function unsetCookie()
    {
        $this->cookies()->remove($this->cookieName());
    }
    
    protected function removeToken($encodedToken)
    {
        $this->tokenHandler()->removeByString($encodedToken);
    }

    protected function cookieName()
    {
        if($this->cookieName === null) {
            $defaultKey = $this->domain->name().'Token';
            $this->cookieName = $this->configData->get('cookie', $defaultKey);
        }
        
        return $this->cookieName;
    }
    
    protected function tokenHandler()
    {
        if($this->tokenHandler === null) {
            $configData = $this->configData->slice('tokens');
            $this->tokenHandler = $this->tokens->handler($configData);
        }
        
        return $this->tokenHandler;
    }

    /**
     * @return \PHPixie\HTTP\Context\Cookies
     */
    protected function cookies()
    {
        /** @var \PHPixie\HTTP\Context $httpContext */
        $httpContext = $this->httpContextContainer->httpContext();
        return $httpContext->cookies();
    }
}
