<?php

namespace PHPixie;

use \PHPixie\Bundles\Bundle\Provides;

class FrameworkBundle implements
    Provides\Console,
    Provides\Auth
{
    protected $frameworkBuilder;
    protected $console;
    protected $auth;
    
    public function __construct($frameworkBuilder)
    {
        $this->frameworkBuilder = $frameworkBuilder;
    }

    public function authRepositories()
    {
        if($this->auth === null) {
            $this->auth = new FrameworkBundle\AuthRepositories($this->frameworkBuilder);
        }

        return $this->auth;
    }

    public function consoleProvider()
    {
        if($this->console === null) {
            $this->console = new FrameworkBundle\Console($this->frameworkBuilder);
        }
        
        return $this->console;
    }
    
    public function name()
    {
        return 'framework';
    }
}