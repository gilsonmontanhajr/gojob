<?php

namespace PHPixie\Bundles\Bundle\Provides;

interface ORM extends \PHPixie\Bundles\Bundle
{
    public function ormConfig();
    public function ormWrappers();
}