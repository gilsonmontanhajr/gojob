<?php

namespace PHPixie\AuthLogin\Repository;

interface User extends \PHPixie\Auth\Repositories\Repository\User
{
    /**
     * @return string
     */
    public function passwordHash();
}