<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Workout extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'video_male_url',
        'video_female_url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public static function createWorkout(array $data)
    {
        return self::create($data);
    }

    /**
     * Get the video URLs for the workout based on user gender.
     * take user_id, get the user_gender from the user personal details table
     * and return the video URL based on the gender
     **/

     public function getVideoUrl($userId)
     {
         $user = User::find($userId);
 
         if ($user) {
             $gender = UserPersonalDetail::where('user_id', $userId)->first()->gender;
             return $gender === 'male' ? $this->video_male_url : $this->video_female_url;
         }
         return null;
     }

    //get workout by user_id




    public static function updateWorkout(string $id, array $data)
    {
        $workout = self::find($id);
        if ($workout) {
            $workout->update($data);
            return $workout;
        }
        return null;
    }

    public static function deleteWorkout(string $id)
    {
        $workout = self::find($id);
        if ($workout) {
            return $workout->delete();
        }
        return false;
    }

    
    

    /**
     * Get the weekly schedules for the workout.
     */
    

    public function weeklySchedules()
    {
        return $this->hasMany(WeeklySchedule::class);
    }
}
