<?php

namespace Syntaxterr\LaravelCertificates;

use Illuminate\Support\ServiceProvider;
use Syntaxterr\LaravelCertificates\Console\Commands\CertCreateCommand;
use Syntaxterr\LaravelCertificates\Console\Commands\CertListCommand;

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
        $this->registerPublishing();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Registers the commands within the application
     * @return void
     */
    private function registerCommands(): void
    {
        if($this->app->runningInConsole()) {
            $this->commands([
                CertCreateCommand::class,
                CertListCommand::class
            ]);
        }
    }

    /**
     * Registers the files that is being published
     * @return void
     */
    private function registerPublishing(): void
    {
        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ]);
    }
}
