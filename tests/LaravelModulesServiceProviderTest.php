<?php

namespace myGedung\Modules\Tests;

use myGedung\Modules\Laravel\Repository;

class LaravelModulesServiceProviderTest extends BaseTestCase
{
    /** @test */
    public function it_binds_modules_key_to_repository_class()
    {
        $this->assertInstanceOf(Repository::class, app('modules'));
    }
}
