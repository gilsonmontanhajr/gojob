<?php

namespace NS\BNAME\Console;

use NS\BNAME\BNAMEBuilder;
use PHPixie\Console\Command\Config;

/**
 * Your base command class
 */
abstract class Command extends \PHPixie\DefaultBundle\Console\Command
{
    /**
     * @var BNAMEBuilder
     */
    protected $builder;

    /**
     * @param Config $config
     * @param BNAMEBuilder $builder
     */
    public function __construct($config, $builder)
    {
        $this->builder = $builder;
        $this->configure($config);
        parent::__construct($config);
    }

    /**
     * @param Config $config
     * @return void
     */
    abstract protected function configure($config);
}