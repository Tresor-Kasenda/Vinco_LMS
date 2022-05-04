<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class, 'promotion');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'promotion');
    }

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class, 'promotion');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'promotion');
    }
}
