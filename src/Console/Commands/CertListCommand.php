<?php

namespace Syntaxterr\LaravelCertificates\Console\Commands;

use Illuminate\Console\Command;
use Syntaxterr\LaravelCertificates\Models\Certificate;

class CertListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cert:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a list of certificates.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->table(
            ['ID', 'Public Key', 'Length', 'Created', 'Revoked'],
            Certificate::all()->toArray()
        );

        return 0;
    }
}
