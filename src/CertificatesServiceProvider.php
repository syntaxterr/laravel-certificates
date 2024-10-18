<?php

namespace Syntaxterr\LaravelCertificates;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Syntaxterr\LaravelCertificates\Console\Commands\CertCreateCommand;
use Syntaxterr\LaravelCertificates\Console\Commands\CertListCommand;
use Syntaxterr\LaravelCertificates\Console\Commands\CertRevokeCommand;

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
        $this->registerAbout();

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
                CertListCommand::class,
                CertRevokeCommand::class
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

    /**
     * Registers the information displayed on the about command
     * @return void
     */
    private function registerAbout(): void
    {
        AboutCommand::add('Certificates', fn() => [
            'Version' => file_get_contents(__DIR__.'/../VERSION')
        ]);
    }
}
