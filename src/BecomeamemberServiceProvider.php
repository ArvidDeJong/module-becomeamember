<?php

namespace Darvis\ModuleBecomeamember;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\{Config, Route, View};
use Illuminate\Contracts\Foundation\Application;
use Livewire\Livewire;

class BecomeamemberServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register config
        $this->mergeConfigFrom(
            __DIR__ . '/config/module_becomeamember.php',
            'module_becomeamember'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'module-becomeamember');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Register Livewire components
        Livewire::component('becomeamember-list-row', \Darvis\ModuleBecomeamember\Livewire\BecomeamemberListRow::class);
        Livewire::component('becomeamember-list', \Darvis\ModuleBecomeamember\Livewire\BecomeamemberList::class);
        Livewire::component('becomeamember-create', \Darvis\ModuleBecomeamember\Livewire\BecomeamemberCreate::class);
        Livewire::component('becomeamember-update', \Darvis\ModuleBecomeamember\Livewire\BecomeamemberUpdate::class);
        Livewire::component('becomeamember-read', \Darvis\ModuleBecomeamember\Livewire\BecomeamemberRead::class);
        Livewire::component('becomeamember-settings', \Darvis\ModuleBecomeamember\Livewire\BecomeamemberSettings::class);
        Livewire::component('becomeamember-button-email', \Darvis\ModuleBecomeamember\Livewire\BecomeamemberButtonEmail::class);

        // Publish assets when running in console
        if ($this->app->runningInConsole()) {
            // Publish config   
            $this->publishes([
                __DIR__ . '/config/module_becomeamember.php' => base_path('config/module_becomeamember.php'),
            ], 'becomeamember-config');

            // Publish views
            $this->publishes([
                __DIR__ . '/resources/views' => base_path('resources/views/vendor/becomeamember'),
            ], 'becomeamember-views');

            // Publish lang
            $this->publishes([
                __DIR__ . '/resources/lang' => base_path('resources/lang/vendor/becomeamember'),
            ], 'becomeamember-lang');
        }
    }
}
