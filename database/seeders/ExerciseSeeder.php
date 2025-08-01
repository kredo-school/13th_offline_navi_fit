<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        // Safety measure to not run in production
        if (! app()->environment('local', 'development')) {
            return;
        }

        // Skip if data already exists
        if (DB::table('exercises')->count() > 0) {
            $this->command->info('Exercises table already has data. Skipping...');

            return;
        }

        $now = Carbon::now();

        // Basic exercise data
        $exercises = [
            [
                'name' => 'Bench Press',
                'description' => 'A compound upper body exercise that targets the chest, front shoulders, and triceps',
                'muscle_groups' => json_encode(['chest', 'shoulders', 'triceps']),
                'equipment_category' => 'barbell',
                'equipment_needed' => 'Flat bench, barbell',
                'difficulty' => 'intermediate',
                'instructions' => 'Lie on a bench, grip the barbell with hands wider than shoulder-width, lower to chest, then press up.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Squat',
                'description' => 'A fundamental compound movement for lower body strength',
                'muscle_groups' => json_encode(['quads', 'hamstrings', 'glutes', 'core']),
                'equipment_category' => 'barbell',
                'equipment_needed' => 'Barbell, squat rack',
                'difficulty' => 'intermediate',
                'instructions' => 'Place barbell on shoulders, bend knees and hips to lower until thighs are parallel to floor, then return to starting position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Deadlift',
                'description' => 'A compound exercise that works the back, glutes, and hamstrings',
                'muscle_groups' => json_encode(['back', 'glutes', 'hamstrings', 'core']),
                'equipment_category' => 'barbell',
                'equipment_needed' => 'Barbell',
                'difficulty' => 'advanced',
                'instructions' => 'Stand with feet shoulder-width apart, bend to grip the barbell, keep back straight, and lift by extending hips and knees.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Lat Pulldown',
                'description' => 'An exercise that primarily targets the latissimus dorsi muscles',
                'muscle_groups' => json_encode(['back', 'biceps']),
                'equipment_category' => 'machine',
                'equipment_needed' => 'Lat pulldown machine',
                'difficulty' => 'beginner',
                'instructions' => 'Sit at the machine, grip the bar, and pull it down to chest level before slowly returning to the starting position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Leg Press',
                'description' => 'A machine-based exercise focusing on leg muscles',
                'muscle_groups' => json_encode(['quads', 'hamstrings', 'glutes']),
                'equipment_category' => 'machine',
                'equipment_needed' => 'Leg press machine',
                'difficulty' => 'beginner',
                'instructions' => 'Sit in the machine, place feet on the platform, and push it away by extending your legs, then slowly return to starting position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dumbbell Shoulder Press',
                'description' => 'An exercise that targets the shoulder muscles',
                'muscle_groups' => json_encode(['shoulders', 'triceps']),
                'equipment_category' => 'dumbbell',
                'equipment_needed' => 'Dumbbells',
                'difficulty' => 'intermediate',
                'instructions' => 'Hold dumbbells at shoulder height, press them overhead until arms are extended, then lower back to starting position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Push-up',
                'description' => 'A bodyweight exercise that works the chest, shoulders, and arms',
                'muscle_groups' => json_encode(['chest', 'shoulders', 'triceps', 'core']),
                'equipment_category' => 'bodyweight',
                'equipment_needed' => null,
                'difficulty' => 'beginner',
                'instructions' => 'Start in plank position with hands slightly wider than shoulders, lower your body until chest nearly touches the floor, then push back up.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dumbbell Curl',
                'description' => 'An isolation exercise that targets the biceps',
                'muscle_groups' => json_encode(['biceps']),
                'equipment_category' => 'dumbbell',
                'equipment_needed' => 'Dumbbells',
                'difficulty' => 'beginner',
                'instructions' => 'Hold dumbbells with arms extended, keep elbows fixed at sides, curl the weights up toward shoulders, then lower slowly.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('exercises')->insert($exercises);
        $this->command->info('Exercise data seeded successfully!');
    }
}
