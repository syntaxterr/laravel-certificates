<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Syntaxterr\LaravelCertificates\Models\Certificate;

/**
 * @extends Factory<Certificate>
 */
class CertificateFactory extends Factory
{
    protected $model = Certificate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        ];
    }
}
