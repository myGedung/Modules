<?php

namespace myGedung\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use myGedung\Modules\Commands\CommandMakeCommand;
use myGedung\Modules\Commands\ControllerMakeCommand;
use myGedung\Modules\Commands\DisableCommand;
use myGedung\Modules\Commands\DumpCommand;
use myGedung\Modules\Commands\EnableCommand;
use myGedung\Modules\Commands\EventMakeCommand;
use myGedung\Modules\Commands\FactoryMakeCommand;
use myGedung\Modules\Commands\InstallCommand;
use myGedung\Modules\Commands\JobMakeCommand;
use myGedung\Modules\Commands\ListCommand;
use myGedung\Modules\Commands\ListenerMakeCommand;
use myGedung\Modules\Commands\MailMakeCommand;
use myGedung\Modules\Commands\MiddlewareMakeCommand;
use myGedung\Modules\Commands\MigrateCommand;
use myGedung\Modules\Commands\MigrateRefreshCommand;
use myGedung\Modules\Commands\MigrateResetCommand;
use myGedung\Modules\Commands\MigrateRollbackCommand;
use myGedung\Modules\Commands\MigrationMakeCommand;
use myGedung\Modules\Commands\ModelMakeCommand;
use myGedung\Modules\Commands\ModuleMakeCommand;
use myGedung\Modules\Commands\NotificationMakeCommand;
use myGedung\Modules\Commands\PolicyMakeCommand;
use myGedung\Modules\Commands\ProviderMakeCommand;
use myGedung\Modules\Commands\PublishCommand;
use myGedung\Modules\Commands\PublishConfigurationCommand;
use myGedung\Modules\Commands\PublishMigrationCommand;
use myGedung\Modules\Commands\PublishTranslationCommand;
use myGedung\Modules\Commands\RequestMakeCommand;
use myGedung\Modules\Commands\ResourceMakeCommand;
use myGedung\Modules\Commands\RouteProviderMakeCommand;
use myGedung\Modules\Commands\RuleMakeCommand;
use myGedung\Modules\Commands\SeedCommand;
use myGedung\Modules\Commands\SeedMakeCommand;
use myGedung\Modules\Commands\SetupCommand;
use myGedung\Modules\Commands\TestMakeCommand;
use myGedung\Modules\Commands\UnUseCommand;
use myGedung\Modules\Commands\UpdateCommand;
use myGedung\Modules\Commands\UseCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * The available commands
     *
     * @var array
     */
    protected $commands = [
        CommandMakeCommand::class,
        ControllerMakeCommand::class,
        DisableCommand::class,
        DumpCommand::class,
        EnableCommand::class,
        EventMakeCommand::class,
        JobMakeCommand::class,
        ListenerMakeCommand::class,
        MailMakeCommand::class,
        MiddlewareMakeCommand::class,
        NotificationMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        InstallCommand::class,
        ListCommand::class,
        ModuleMakeCommand::class,
        FactoryMakeCommand::class,
        PolicyMakeCommand::class,
        RequestMakeCommand::class,
        RuleMakeCommand::class,
        MigrateCommand::class,
        MigrateRefreshCommand::class,
        MigrateResetCommand::class,
        MigrateRollbackCommand::class,
        MigrationMakeCommand::class,
        ModelMakeCommand::class,
        PublishCommand::class,
        PublishConfigurationCommand::class,
        PublishMigrationCommand::class,
        PublishTranslationCommand::class,
        SeedCommand::class,
        SeedMakeCommand::class,
        SetupCommand::class,
        UnUseCommand::class,
        UpdateCommand::class,
        UseCommand::class,
        ResourceMakeCommand::class,
        TestMakeCommand::class,
    ];

    /**
     * Register the commands.
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides()
    {
        $provides = $this->commands;

        return $provides;
    }
}
