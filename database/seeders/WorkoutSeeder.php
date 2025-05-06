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
                'male_video' => 'https://www.youtube.com/watch?v=_l3ySVKYVJ8',
                'female_video' => 'https://www.youtube.com/watch?v=IODxDxX7oi4',
            ],
            [
                'name' => 'Pull-Up',
                'male_video' => 'https://www.youtube.com/watch?v=eGo4IYlbE5g',
                'female_video' => 'https://www.youtube.com/watch?v=bEv6CCg2BC8',
            ],
            [
                'name' => 'Squat',
                'male_video' => 'https://www.youtube.com/watch?v=YaXPRqUwItQ',
                'female_video' => 'https://www.youtube.com/watch?v=aclHkVaku9U',
            ],
            [
                'name' => 'Lunges',
                'male_video' => 'https://www.youtube.com/watch?v=QOVaHwm-Q6U',
                'female_video' => 'https://www.youtube.com/watch?v=COKYKgQ8KR0',
            ],
            [
                'name' => 'Plank',
                'male_video' => 'https://www.youtube.com/watch?v=pSHjTRCQxIw',
                'female_video' => 'https://www.youtube.com/watch?v=ASdvN_XEl_c',
            ],
            [
                'name' => 'Deadlift',
                'male_video' => 'https://www.youtube.com/watch?v=ytGaGIn3SjE',
                'female_video' => 'https://www.youtube.com/watch?v=1ZXobu7JvvE',
            ],
            [
                'name' => 'Bench Press',
                'male_video' => 'https://www.youtube.com/watch?v=rT7DgCr-3pg',
                'female_video' => 'https://www.youtube.com/watch?v=4Efz7U6YVnA',
            ],
            [
                'name' => 'Bicep Curl',
                'male_video' => 'https://www.youtube.com/watch?v=ykJmrZ5v0Oo',
                'female_video' => 'https://www.youtube.com/watch?v=1Tq3QdYUuHs',
            ],
            [
                'name' => 'Tricep Dips',
                'male_video' => 'https://www.youtube.com/watch?v=0326dy_-CzM',
                'female_video' => 'https://www.youtube.com/watch?v=2z8JmcrW-As',
            ],
            [
                'name' => 'Shoulder Press',
                'male_video' => 'https://www.youtube.com/watch?v=B-aVuyhvLHU',
                'female_video' => 'https://www.youtube.com/watch?v=2yjwXTZQDDI',
            ],
            [
                'name' => 'Mountain Climbers',
                'male_video' => 'https://www.youtube.com/watch?v=nmwgirgXLYM',
                'female_video' => 'https://www.youtube.com/watch?v=wQq3ybaLZeA',
            ],
            [
                'name' => 'Burpees',
                'male_video' => 'https://www.youtube.com/watch?v=TU8QYVW0gDU',
                'female_video' => 'https://www.youtube.com/watch?v=JZQA08SlJnM',
            ],
            [
                'name' => 'Jumping Jacks',
                'male_video' => 'https://www.youtube.com/watch?v=c4DAnQ6DtF8',
                'female_video' => 'https://www.youtube.com/watch?v=UpH7rm0cYbM',
            ],
            [
                'name' => 'High Knees',
                'male_video' => 'https://www.youtube.com/watch?v=OAJ_J3EZkdY',
                'female_video' => 'https://www.youtube.com/watch?v=8opcQdC-V-U',
            ],
            [
                'name' => 'Russian Twists',
                'male_video' => 'https://www.youtube.com/watch?v=wkD8rjkodUI',
                'female_video' => 'https://www.youtube.com/watch?v=DJQGX2J4IVw',
            ],
            [
                'name' => 'Leg Raises',
                'male_video' => 'https://www.youtube.com/watch?v=JB2oyawG9KI',
                'female_video' => 'https://www.youtube.com/watch?v=l4kQd9eWclE',
            ],
            [
                'name' => 'Side Plank',
                'male_video' => 'https://www.youtube.com/watch?v=Kp8wcV3GjW0',
                'female_video' => 'https://www.youtube.com/watch?v=Kp8wcV3GjW0',
            ],
            [
                'name' => 'Bicycle Crunches',
                'male_video' => 'https://www.youtube.com/watch?v=9FGilxCbdz8',
                'female_video' => 'https://www.youtube.com/watch?v=9FGilxCbdz8',
            ],
            [
                'name' => 'Jump Squats',
                'male_video' => 'https://www.youtube.com/watch?v=U4s4mEQ5VqU',
                'female_video' => 'https://www.youtube.com/watch?v=U4s4mEQ5VqU',
            ],
            [
                'name' => 'Calf Raises',
                'male_video' => 'https://www.youtube.com/watch?v=-M4-G8p8fmc',
                'female_video' => 'https://www.youtube.com/watch?v=-M4-G8p8fmc',
            ],
            [
                'name' => 'Side Lunges',
                'male_video' => 'https://www.youtube.com/watch?v=2z8JmcrW-As',
                'female_video' => 'https://www.youtube.com/watch?v=2z8JmcrW-As',
            ],
            [
                'name' => 'Reverse Crunches',
                'male_video' => 'https://www.youtube.com/watch?v=hyv14e2QDq0',
                'female_video' => 'https://www.youtube.com/watch?v=hyv14e2QDq0',
            ],
        ];

        foreach ($workouts as $workout) {
            DB::table('workouts')->insert([
                'id' => Str::uuid(),
                'name' => $workout['name'],
                'video_male_url' => $workout['male_video'],
                'video_female_url' => $workout['female_video'],
            ]);
        }
    }
}
