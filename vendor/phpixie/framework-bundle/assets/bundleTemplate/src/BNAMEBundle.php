<?php

namespace NS\BNAME;
use PHPixie\DefaultBundle;
use PHPixie\BundleFramework\Builder as FrameworkBuilder;

/**
 * Default application bundle
 */
class BNAMEBundle extends DefaultBundle
{
    /**
     * Build bundle builder
     * @param FrameworkBuilder $frameworkBuilder
     * @return BNAMEBuilder
     */
    protected function buildBuilder($frameworkBuilder)
    {
        return new BNAMEBuilder($frameworkBuilder);
    }
}