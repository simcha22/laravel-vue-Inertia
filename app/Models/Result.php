<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'reps_type',
        'level',
        'rehearsals',
        'weights',
        'rounds',
        'percentage',
        'notes',
        'done_at',
        'user_id',
        'exercise_id',
        'meta',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exercise() : BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
