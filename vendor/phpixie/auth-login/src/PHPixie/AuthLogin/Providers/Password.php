<?php

namespace PHPixie\AuthLogin\Providers;

class Password extends \PHPixie\Auth\Providers\Provider\Implementation
{
    /** @var \PHPixie\Security\Password */
    protected $passwordHandler;

    /**
     * @param \PHPixie\Security\Password $passwordHandler
     * @param \PHPixie\Auth\Domains\Domain $domain
     * @param string $name
     * @param \PHPixie\Slice\Type\ArrayData $configData
     */
    public function __construct($passwordHandler, $domain, $name, $configData)
    {
        parent::__construct($domain, $name, $configData);
        $this->passwordHandler = $passwordHandler;
    }

    /**
     * @param string $password
     * @return bool|string
     */
    public function hash($password)
    {
        return $this->passwordHandler->hash($password);
    }

    /**
     * @param string $login
     * @param string $password
     * @return \PHPixie\AuthLogin\Repository\User
     */
    public function login($login, $password)
    {
        $user = $this->repository()->getByLogin($login);
        
        if($user === null) {
            return null;
        }
        
        $hash = $user->passwordHash();
        if(!$this->verify($password, $hash)) {
            return null;
        }

        $this->setUser($user);
        return $user;
    }

    /**
     * @param \PHPixie\AuthLogin\Repository\User $user
     */
    public function setUser($user)
    {
        $this->domain->setUser($user, $this->name);
        $this->persist();
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function verify($password, $hash)
    {
        return $this->passwordHandler->verify($password, $hash);
    }

    public function persist(){
        $persistProviders = $this->configData->get('persistProviders', array());

        foreach($persistProviders as $providerName) {
            /** @var \PHPixie\Auth\Providers\Provider\Persistent $provider */
            $provider = $this->domain->provider($providerName);
            $provider->persist();
        }
    }
}