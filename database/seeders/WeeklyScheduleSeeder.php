<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeeklyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get workout IDs from the workouts table
        $workoutIds = DB::table('workouts')->pluck('id')->toArray();

        if (empty($workoutIds)) {
            $this->command->info('No workouts found. Please run the WorkoutSeeder first.');
            return;
        }

        // Sample notes for variety
        $sampleNotes = [
            'Focus on proper form',
            'Increase weight from last week',
            'Rest 60 seconds between sets',
            'Try to beat personal record',
            'Focus on slow, controlled movements',
            'Keep heart rate above 140 BPM',
            'Remember to breathe properly',
            'Use lighter weights if necessary',
            null, // Some entries with no notes
            null,
        ];

        $schedules = [];

        // Create sample workout schedule
        // Monday - Mostly upper body
        $schedules[] = [
            'day_number' => 1, // Monday
            'workout_id' => $workoutIds[6], // Bench Press
            'duration' => 30,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $schedules[] = [
            'day_number' => 1, // Monday
            'workout_id' => $workoutIds[7], // Bicep Curl
            'duration' => 20,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Tuesday - Cardio day
        $schedules[] = [
            'day_number' => 2, // Tuesday
            'workout_id' => $workoutIds[12], // Jumping Jacks
            'duration' => 15,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $schedules[] = [
            'day_number' => 2, // Tuesday
            'workout_id' => $workoutIds[13], // High Knees
            'duration' => 15,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $schedules[] = [
            'day_number' => 2, // Tuesday
            'workout_id' => $workoutIds[11], // Burpees
            'duration' => 20,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Wednesday - Lower body
        $schedules[] = [
            'day_number' => 3, // Wednesday
            'workout_id' => $workoutIds[2], // Squat
            'duration' => 30,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $schedules[] = [
            'day_number' => 3, // Wednesday
            'workout_id' => $workoutIds[3], // Lunges
            'duration' => 20,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Thursday - Rest or light activity
        $schedules[] = [
            'day_number' => 4, // Thursday
            'workout_id' => $workoutIds[4], // Plank
            'duration' => 15,
            'notes' => 'Active recovery day',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Friday - Full body
        $schedules[] = [
            'day_number' => 5, // Friday
            'workout_id' => $workoutIds[5], // Deadlift
            'duration' => 35,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $schedules[] = [
            'day_number' => 5, // Friday
            'workout_id' => $workoutIds[9], // Shoulder Press
            'duration' => 25,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Saturday - Core focus
        $schedules[] = [
            'day_number' => 6, // Saturday
            'workout_id' => $workoutIds[14], // Russian Twists
            'duration' => 20,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $schedules[] = [
            'day_number' => 6, // Saturday
            'workout_id' => $workoutIds[15], // Leg Raises
            'duration' => 15,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $schedules[] = [
            'day_number' => 6, // Saturday
            'workout_id' => $workoutIds[17], // Bicycle Crunches
            'duration' => 15,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Sunday - Rest day or very light exercise
        $schedules[] = [
            'day_number' => 7, // Sunday
            'workout_id' => $workoutIds[16], // Side Plank
            'duration' => 10,
            'notes' => 'Light recovery exercise',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Alternative schedule - Different arrangement of exercises
        // Monday - Full Body
        $schedules[] = [
            'day_number' => 1, // Monday
            'workout_id' => $workoutIds[0], // Push-Up
            'duration' => 25,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $schedules[] = [
            'day_number' => 1, // Monday
            'workout_id' => $workoutIds[1], // Pull-Up
            'duration' => 20,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Wednesday - HIIT
        $schedules[] = [
            'day_number' => 3, // Wednesday
            'workout_id' => $workoutIds[10], // Mountain Climbers
            'duration' => 25,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $schedules[] = [
            'day_number' => 3, // Wednesday
            'workout_id' => $workoutIds[18], // Jump Squats
            'duration' => 20,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Friday - Lower Body Focus
        $schedules[] = [
            'day_number' => 5, // Friday
            'workout_id' => $workoutIds[19], // Calf Raises
            'duration' => 15,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $schedules[] = [
            'day_number' => 5, // Friday
            'workout_id' => $workoutIds[20], // Side Lunges
            'duration' => 20,
            'notes' => $sampleNotes[array_rand($sampleNotes)],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('weekly_schedule')->insert($schedules);
    }
}