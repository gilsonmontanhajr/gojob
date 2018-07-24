<?php

namespace NS\BNAME;

class HTTP extends \PHPixie\DefaultBundle\HTTP
{
    protected $classMap = array(
        'greet' => 'NS\BNAME\HTTP\Greet'
    );
}