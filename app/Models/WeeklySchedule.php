<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklySchedule extends Model
{
    protected $fillable = [
        'day_number',
        'workout_id',
        'duration',
        'notes',
    ];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function progresses()
    {
        return $this->hasMany(UserProgress::class);
    }
}
