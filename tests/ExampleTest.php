<?php

namespace MiguelRod\SlackApi\Tests;

use Orchestra\Testbench\TestCase;
use MiguelRod\SlackApi\SlackApiServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [SlackApiServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
