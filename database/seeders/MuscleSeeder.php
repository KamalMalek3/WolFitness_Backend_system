<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MuscleSeeder extends Seeder
{
    public function run(): void
    {
        $muscles = [
            'Chest',
            'Back',
            'Shoulders',
            'Biceps',
            'Triceps',
            'Legs',
            'Abs',
            'Forearms',
            'Calves',
            'Glutes',
        ];

        foreach ($muscles as $muscle) {
            DB::table('muscles')->insert([
                'id' => Str::uuid(),
                'name' => $muscle,
            ]);
        }
    }
}
// This seeder will populate the muscles table with a list of common muscle groups.