<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateExerciseSeeder extends Seeder
{
    public function run(): void
    {
        // Safety measure to not run in production
        if (! app()->environment('local', 'development')) {
            return;
        }

        // Skip if data already exists
        if (DB::table('template_exercises')->count() > 0) {
            $this->command->info('Template exercises table already has data. Skipping...');

            return;
        }

        $now = Carbon::now();

        // Get exercise IDs by name
        $benchPressId = DB::table('exercises')->where('name', 'Bench Press')->value('id');
        $squatId = DB::table('exercises')->where('name', 'Squat')->value('id');

        // Exit if exercises not found
        if (! $benchPressId || ! $squatId) {
            $this->command->error('Required exercises not found. Make sure to run ExerciseSeeder first.');

            return;
        }

        // Get template IDs by name
        $fullBodyTemplateId = DB::table('templates')->where('name', 'Full Body Workout for Beginners')->value('id');
        $upperBodyTemplateId = DB::table('templates')->where('name', 'Upper Body Focus Program')->value('id');

        // Exit if templates not found
        if (! $fullBodyTemplateId || ! $upperBodyTemplateId) {
            $this->command->error('Required templates not found. Make sure to run TemplateSeeder first.');

            return;
        }

        // Template-exercise relationship data
        $templateExercises = [
            // Full Body Workout exercises
            [
                'template_id' => $fullBodyTemplateId,
                'exercise_id' => $benchPressId,
                'order_index' => 1,
                'sets' => 3,
                'reps' => 10,
                'rest_seconds' => 60,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'template_id' => $fullBodyTemplateId,
                'exercise_id' => $squatId,
                'order_index' => 2,
                'sets' => 3,
                'reps' => 12,
                'rest_seconds' => 60,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Upper Body Focus Program exercises
            [
                'template_id' => $upperBodyTemplateId,
                'exercise_id' => $benchPressId,
                'order_index' => 1,
                'sets' => 4,
                'reps' => 8,
                'rest_seconds' => 90,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // Insert data
        DB::table('template_exercises')->insert($templateExercises);
        $this->command->info('Template exercises relations seeded successfully!');
    }
}
