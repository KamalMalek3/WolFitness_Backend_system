<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserProgress extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'weekly_schedule_id',
        'duration_completed',
        'date',
    ];

    protected $hidden = [
        'user_id',
        'weekly_schedule_id',
    ];

    public static function createUserProgress(array $data)
    {
        return self::create($data);
    }

    public static function getUserProgressById(string $id)
    {
        return self::find($id);
    }

    public static function updateUserProgress(string $id, array $data)
    {
        $userProgress = self::find($id);
        if ($userProgress) {
            $userProgress->update($data);
            return $userProgress;
        }
        return null;
    }

    public static function deleteUserProgress(string $id)
    {
        $userProgress = self::find($id);
        if ($userProgress) {
            return $userProgress->delete();
        }
        return false;
    }
    /**
     * Get the user that owns the progress.
     */
    // This method defines the inverse relationship between UserProgress and User
    // It indicates that each UserProgress belongs to a single User
    // The user() method returns the User model associated with the UserProgress
    // The belongsTo() method establishes the relationship
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function weeklySchedule()
    {
        return $this->belongsTo(WeeklySchedule::class);
    }
}
