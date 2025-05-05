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

    protected $hidden = [
        'workout_id',
    ];

    public static function createWeeklySchedule(array $data)
    {
        return self::create($data);
    }
    public static function getWeeklyScheduleById(string $id)
    {
        return self::find($id);
    }
    public static function updateWeeklySchedule(string $id, array $data)
    {
        $weeklySchedule = self::find($id);
        if ($weeklySchedule) {
            $weeklySchedule->update($data);
            return $weeklySchedule;
        }
        return null;
    }
    public static function deleteWeeklySchedule(string $id)
    {
        $weeklySchedule = self::find($id);
        if ($weeklySchedule) {
            return $weeklySchedule->delete();
        }
        return false;
    }

    /**
     * Get the workout that owns the weekly schedule.
     */
    // This method defines the inverse relationship between WeeklySchedule and Workout
    // It indicates that each WeeklySchedule belongs to a single Workout

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function progresses()
    {
        return $this->hasMany(UserProgress::class);
    }
}
