<?php

namespace PHPixie\FrameworkBundle;

use PHPixie\Auth\Repositories\Repository;
use PHPixie\BundleFramework\Builder;

class AuthRepositories implements \PHPixie\Auth\Repositories\Registry
{
    /**
     * @var Builder
     */
    protected $frameworkBuilder;

    /**
     * @param Builder $frameworkBuilder
     */
    public function __construct($frameworkBuilder)
    {
        $this->frameworkBuilder = $frameworkBuilder;
    }

    public function repository($name)
    {
        $exploded = explode('.', $name, 2);
        if(count($exploded) !== 2 || $exploded[0] !== 'orm') {
            throw new \PHPixie\Auth\Exception("Auth repository '$name' is not defined");
        }

        $repositoryName = $exploded[1];
        $orm = $this->frameworkBuilder->components()->orm();
        $repository = $orm->repository($repositoryName);

        if(!($repository instanceof Repository)) {
            throw new \PHPixie\Auth\Exception("ORM repository '$name' does not implement the 'PHPixie\\Auth\\Repositories\\Repository' interface");
        }

        return $repository;
    }
}