<?php

namespace Syntaxterr\LaravelCertificates\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use phpseclib3\Crypt\RSA;
use phpseclib\Crypt\RSA as LegacyRSA;

/**
 * Certificate Model
 * @property string $id
 * @property string $public_key
 * @property string $private_key
 * @property int $length
 * @property Carbon $created_at
 * @property Carbon $revoked_at
 */
class Certificate extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'private_key' => 'encrypted',
            'created_at' => 'datetime',
            'revoked_at' => 'datetime'
        ];
    }

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($certificate) {
            $certificate->id = ($certificate->id === null) ? Str::random() : $certificate->id;
            $certificate->created_at = ($certificate->created_at === null) ? Carbon::now() : $certificate->created_at;
            $certificate->length = ($certificate->length === null) ? 4096 : $certificate->length;

            if(class_exists(LegacyRSA::class)){
                $keys = (new LegacyRSA())->createKey($certificate->length);

                $certificate->private_key = Arr::get($keys, 'privatekey');
                $certificate->public_key = Arr::get($keys, 'publickey');
            } else {
                $key = RSA::createKey($certificate->length);
                $certificate->private_key = (string)$key;
                $certificate->public_key = (string)$key->getPublicKey();
            }
        });
    }
}
