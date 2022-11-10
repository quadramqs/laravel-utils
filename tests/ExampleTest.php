<?php

namespace Quadram\LaravelUtils\Tests;

use Orchestra\Testbench\TestCase;
use Quadram\LaravelUtils\LaravelUtilsServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelUtilsServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
