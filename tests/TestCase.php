<?php

namespace Darvis\ModuleBecomeamember\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Darvis\ModuleBecomeamember\BecomeamemberServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            BecomeamemberServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../src/database/migrations');
    }
}
