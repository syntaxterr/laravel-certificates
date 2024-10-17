<?php

namespace Syntaxterr\LaravelCertificates\Tests;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Syntaxterr\LaravelCertificates\CertificatesServiceProvider;

class TestCase extends BaseTestCase
{
    use WithWorkbench;

    protected function getPackageProviders($app): array
    {
        return [
            CertificatesServiceProvider::class
        ];
    }
}
