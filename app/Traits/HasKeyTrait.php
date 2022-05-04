<?php
declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * trait hasKey generate uniqye uuid key
 * @author scotttresor@gmail.com
 */
trait HasKeyTrait
{
    public static function booted(): void
    {
        static::creating(
            fn (Model $model) => $model->key = substr((string)Str::uuid(), 1, 15),
        );
    }
}
