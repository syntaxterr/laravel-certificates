<?php

namespace Syntaxterr\LaravelCertificates\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Syntaxterr\LaravelCertificates\CertificatesServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            CertificatesServiceProvider::class
        ];
    }
}
