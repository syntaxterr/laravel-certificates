<?php

namespace Syntaxterr\LaravelCertificates;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Syntaxterr\LaravelCertificates\Console\Commands\CertCreateCommand;
use Syntaxterr\LaravelCertificates\Console\Commands\CertListCommand;
use Syntaxterr\LaravelCertificates\Console\Commands\CertRevokeCommand;
use Syntaxterr\LaravelCertificates\Console\Commands\CertRotateCommand;
use Syntaxterr\LaravelCertificates\Models\Certificate;

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
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->registerCommands();
        $this->registerPublishing();
        //$this->registerAbout();
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
                CertRevokeCommand::class,
                CertRotateCommand::class
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
        $certificates = Certificate::all(['id', 'revoked_at']);

        AboutCommand::add('Certificates', [
            'Version' => file_get_contents(__DIR__.'/../VERSION'),
            'Total' => $certificates->count(),
            'Active' => $certificates->where('revoked_at', null)->count(),
            'Revoked' => $certificates->where('revoked_at', '!=', null)->count(),
        ]);
    }
}
