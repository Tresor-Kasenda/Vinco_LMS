<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_department')
            ->withTimestamps();
    }

    public function professors(): HasMany
    {
        return $this->hasMany(Professor::class);
    }

    public function subdsidiaries(): HasMany
    {
        return $this->hasMany(Subsidiary::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
