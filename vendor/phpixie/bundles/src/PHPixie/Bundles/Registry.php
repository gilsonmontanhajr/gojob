<?php

namespace PHPixie\Bundles;

interface Registry
{
    public function get($name, $isRequired = true);
    public function bundles();
}