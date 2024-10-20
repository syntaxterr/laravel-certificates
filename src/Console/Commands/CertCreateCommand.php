<?php

namespace Syntaxterr\LaravelCertificates\Console\Commands;

use Illuminate\Console\Command;
use Syntaxterr\LaravelCertificates\Models\Certificate;

class CertCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cert:create {--L|length=2048 : RSA key length, default: 2048 bit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new certificate with a public key and a private key.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $cert = Certificate::create(['length' => (int)$this->option('length')]);

        if(!$cert) {
            $this->error('Unable to create the certificate.');
            return 1;
        }

        $this->info('Certificate created.');
        return 0;
    }
}
