<?php

namespace myGedung\Modules\Tests;

use myGedung\Modules\Contracts\RepositoryInterface;
use myGedung\Modules\Laravel\Repository;

class ContractsServiceProviderTest extends BaseTestCase
{
    /** @test */
    public function it_binds_repository_interface_with_implementation()
    {
        $this->assertInstanceOf(Repository::class, app(RepositoryInterface::class));
    }
}
