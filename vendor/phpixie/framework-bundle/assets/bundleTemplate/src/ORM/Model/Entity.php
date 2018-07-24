<?php

namespace NS\BNAME\ORM\Model;

use PHPixie\ORM\Models\Type\Database\Entity as DatabaseEntity;
use PHPixie\ORM\Wrappers\Type\Database\Entity as DatabaseEntityWrapper;
use NS\BNAME\BNAMEBuilder;

abstract class Entity extends DatabaseEntityWrapper
{
    /**
     * @var BNAMEBuilder
     */
    protected $builder;

    /**
     * @param DatabaseEntity $entity
     * @param BNAMEBuilder $builder
     */
    public function __construct($entity, $builder)
    {
        $this->builder = $builder;
        parent::__construct($entity);
    }
}
