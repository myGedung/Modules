<?php

namespace myGedung\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use myGedung\Modules\Contracts\RepositoryInterface;
use myGedung\Modules\Laravel\Repository;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register some binding.
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, Repository::class);
    }
}
