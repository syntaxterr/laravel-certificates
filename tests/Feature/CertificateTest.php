<?php

namespace Syntaxterr\LaravelCertificates\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Syntaxterr\LaravelCertificates\Models\Certificate;
use Syntaxterr\LaravelCertificates\Tests\TestCase;

class CertificateTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_certificate_with_command()
    {
        $this->artisan('cert:create')
            ->expectsOutput('Certificate created.')
            ->assertExitCode(0);

        $this->assertDatabaseCount('certificates', 1);
    }

    public function test_can_list_certificates_with_command()
    {
        Certificate::factory(2)->create();

        $this->artisan('cert:list')
            ->expectsTable(
                ['ID', 'Public Key', 'Length', 'Created', 'Revoked'],
                Certificate::all()->toArray()
            )
            ->assertExitCode(0);
    }
}
