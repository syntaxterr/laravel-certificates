<?php

namespace Syntaxterr\LaravelCertificates;

use Illuminate\Support\ServiceProvider;
use Syntaxterr\LaravelCertificates\Console\Commands\CertCreateCommand;

class CertificatesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerCommands();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ]);
    }

    private function registerCommands(): void
    {
        if($this->app->runningInConsole()) {
            $this->commands([
                CertCreateCommand::class
            ]);
        }
    }
}
