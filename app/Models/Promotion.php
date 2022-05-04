<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class, 'subsidiary');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
