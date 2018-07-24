<?php

namespace NS\BNAME\HTTP;

use NS\BNAME\BNAMEBuilder;

/**
 * Your base web processor class
 */
abstract class Processor extends \PHPixie\DefaultBundle\HTTP\Processor
{
    /**
     * @var BNAMEBuilder
     */
    protected $builder;

    /**
     * @param BNAMEBuilder $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }
}