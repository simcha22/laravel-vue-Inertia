<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWorkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'meta',
        'user_id',
        'workout_id'
    ];

    public function workout() :BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
