<?php

namespace PHPixie\AuthHTTP\Providers;

class Session extends    \PHPixie\Auth\Providers\Provider\Implementation
              implements \PHPixie\Auth\Providers\Provider\Persistent
{
    /** @var \PHPixie\Framework\Context */
    protected $httpContextContainer;
    /** @var string */
    protected $sessionKey;

    /**
     * @param \PHPixie\Framework\Context $httpContextContainer
     * @param \PHPixie\Auth\Domains\Domain $domain
     * @param string $name
     * @param \PHPixie\Slice\Type\ArrayData $configData
     */
    public function __construct($httpContextContainer, $domain, $name, $configData)
    {
        $this->httpContextContainer = $httpContextContainer;
        
        parent::__construct($domain, $name, $configData);
    }

    /**
     * @return \PHPixie\AuthLogin\Repository\User
     */
    public function check()
    {
        $session = $this->session();
        $userId = $session->get($this->sessionKey());
        if($userId === null) {
            return null;
        }
        
        $user = $this->repository()->getById($userId);
        if($user === null) {
            $this->forget();
            return null;
        }
        
        $this->domain->setUser($user, $this->name);
        return $user;
    }
    
    public function persist()
    {
        $user = $this->domain->requireUser();
        $this->session()->set($this->sessionKey(), $user->id());
    }
    
    public function forget()
    {
        $this->session()->remove($this->sessionKey());
    }

    /**
     * @return \PHPixie\HTTP\Context\Session
     */
    protected function session()
    {
        $httpContext = $this->httpContextContainer->httpContext();
        return $httpContext->session();
    }

    /**
     * @return string
     */
    protected function sessionKey()
    {
        if($this->sessionKey === null) {
            $defaultKey = $this->domain->name().'UserId';
            $this->sessionKey = $this->configData->get('key', $defaultKey);
        }
        
        return $this->sessionKey;
    }
}