<?php

namespace PHPixie\AuthLogin;

interface Repository extends \PHPixie\Auth\Repositories\Repository
{
    /**
     * @param string $login
     * @return Repository\User
     */
    public function getByLogin($login);
}