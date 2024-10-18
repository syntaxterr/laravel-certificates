<?php

namespace Syntaxterr\LaravelCertificates\Console\Commands;

use Illuminate\Console\Command;
use Syntaxterr\LaravelCertificates\Models\Certificate;

class CertRevokeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cert:revoke {id : Unique identifier}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revokes a specific certificate.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $cert = Certificate::find($this->argument('id'));

        if(!$cert) {
            $this->error("Certificate not found.");
            return 2;
        }

        $cert->revoke();

        $this->info('Certificate revoked.');
        return 0;
    }
}
