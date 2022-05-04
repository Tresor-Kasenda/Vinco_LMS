<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicYear extends Model
{
    use HasFactory, HasKeyTrait;

    protected $guarded = [];

    public function personnel(): HasMany
    {
        return $this->hasMany(AcademicYear::class);
    }

}
