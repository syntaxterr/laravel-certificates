<?php

namespace Syntaxterr\LaravelCertificates\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Syntaxterr\LaravelCertificates\Models\Certificate;

class CertRotateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cert:rotate {id : Unique identifier}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rotates a specific certificate by revoking it and then create a new certificate.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /** @var Certificate $cert */
        $cert = Certificate::find($this->argument('id'));

        if(!$cert) {
            $this->error("Certificate not found.");
            return Command::INVALID;
        }

        $result = DB::transaction(function () use ($cert) {
            $cert->revoke();

            Certificate::create(['length' => $cert->length]);
        });

        if($result) {
            $this->error('Could not rotate certificate.');
            return Command::FAILURE;
        }

        $this->info('Certificate rotated.');

        return Command::SUCCESS;
    }
}
