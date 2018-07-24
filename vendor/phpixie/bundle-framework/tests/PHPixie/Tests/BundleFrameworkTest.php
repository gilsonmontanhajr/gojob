<?php

namespace PHPixie\Tests;

/**
 * @coversDefaultClass \PHPixie\BundleFramework
 */
class BundleFrameworkTest extends \PHPixie\Tests\FrameworkTest
{
    protected function framework()
    {
        return $this->getMockBuilder('\PHPixie\BundleFramework')
            ->setMethods(array('buildBuilder'))
            ->disableOriginalConstructor()
            ->getMock();
    }
    
    protected function builder()
    {
        return $this->abstractMock('\PHPixie\BundleFramework\Builder');
    }
}