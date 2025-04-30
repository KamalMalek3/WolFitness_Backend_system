<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkoutSeeder extends Seeder
{
    public function run(): void
    {
        $workouts = [
            [
                'name' => 'Push-Up',
                'muscle' => 'Chest',
                'male_video' => 'https://www.youtube.com/watch?v=_l3ySVKYVJ8',
                'female_video' => 'https://www.youtube.com/watch?v=IODxDxX7oi4',
            ],
            [
                'name' => 'Pull-Up',
                'muscle' => 'Back',
                'male_video' => 'https://www.youtube.com/watch?v=eGo4IYlbE5g',
                'female_video' => 'https://www.youtube.com/watch?v=bEv6CCg2BC8',
            ],
        ];

        $muscleIds = DB::table('muscles')->pluck('id', 'name');

        foreach ($workouts as $workout) {
            DB::table('workouts')->insert([
                'id' => Str::uuid(),
                'name' => $workout['name'],
                'muscle_id' => $muscleIds[$workout['muscle']],
                'video_male_url' => $workout['male_video'],
                'video_female_url' => $workout['female_video'],
            ]);
        }
    }
}
