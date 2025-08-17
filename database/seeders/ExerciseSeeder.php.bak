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
            // 既存の8つのエクササイズ
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

            // 追加の22個のエクササイズ
            // バーベル系エクササイズ
            [
                'name' => 'Barbell Row',
                'description' => 'A compound exercise that targets the back muscles',
                'muscle_groups' => json_encode(['back', 'biceps', 'shoulders']),
                'equipment_category' => 'barbell',
                'equipment_needed' => 'Barbell',
                'difficulty' => 'intermediate',
                'instructions' => 'Bend at the hips with knees slightly bent, grab the barbell with an overhand grip, pull it to your lower chest/upper abdomen, then lower it.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Overhead Press',
                'description' => 'A compound exercise for shoulder development',
                'muscle_groups' => json_encode(['shoulders', 'triceps', 'upper chest']),
                'equipment_category' => 'barbell',
                'equipment_needed' => 'Barbell',
                'difficulty' => 'intermediate',
                'instructions' => 'Stand with feet shoulder-width apart, hold barbell at shoulder level, press it overhead until arms are fully extended, then lower it back.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Romanian Deadlift',
                'description' => 'A hip-hinge movement that targets the hamstrings and lower back',
                'muscle_groups' => json_encode(['hamstrings', 'glutes', 'lower back']),
                'equipment_category' => 'barbell',
                'equipment_needed' => 'Barbell',
                'difficulty' => 'intermediate',
                'instructions' => 'Hold barbell in front of thighs, keep back straight, bend at hips while keeping legs nearly straight, lower bar along legs, then return to standing.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Barbell Lunge',
                'description' => 'A unilateral exercise that works the quads, hamstrings, and glutes',
                'muscle_groups' => json_encode(['quads', 'hamstrings', 'glutes', 'core']),
                'equipment_category' => 'barbell',
                'equipment_needed' => 'Barbell',
                'difficulty' => 'intermediate',
                'instructions' => 'Hold barbell across upper back, step forward with one leg, lower until both knees are bent at 90 degrees, return to start, then repeat with other leg.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // ダンベル系エクササイズ
            [
                'name' => 'Dumbbell Bench Press',
                'description' => 'A chest exercise offering greater range of motion than barbell bench press',
                'muscle_groups' => json_encode(['chest', 'shoulders', 'triceps']),
                'equipment_category' => 'dumbbell',
                'equipment_needed' => 'Dumbbells, Bench',
                'difficulty' => 'intermediate',
                'instructions' => 'Lie on bench holding dumbbells at chest level, press weights up until arms are extended, then lower them back to starting position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dumbbell Row',
                'description' => 'A unilateral back exercise',
                'muscle_groups' => json_encode(['back', 'biceps', 'shoulders']),
                'equipment_category' => 'dumbbell',
                'equipment_needed' => 'Dumbbell, Bench',
                'difficulty' => 'beginner',
                'instructions' => 'Place one knee and hand on bench, other foot on floor, hold dumbbell with free hand, pull weight up to hip level, then lower it.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Goblet Squat',
                'description' => 'A squat variation holding a dumbbell or kettlebell in front of the chest',
                'muscle_groups' => json_encode(['quads', 'hamstrings', 'glutes', 'core']),
                'equipment_category' => 'dumbbell',
                'equipment_needed' => 'Dumbbell or Kettlebell',
                'difficulty' => 'beginner',
                'instructions' => 'Hold dumbbell vertically against chest, squat down until thighs are parallel to floor or lower, then return to standing position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dumbbell Lateral Raise',
                'description' => 'An isolation exercise for the lateral deltoids',
                'muscle_groups' => json_encode(['shoulders']),
                'equipment_category' => 'dumbbell',
                'equipment_needed' => 'Dumbbells',
                'difficulty' => 'beginner',
                'instructions' => 'Stand holding dumbbells at sides, raise arms out to sides until parallel with floor, pause briefly, then lower back down with control.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // マシン系エクササイズ
            [
                'name' => 'Chest Press Machine',
                'description' => 'A machine-based alternative to bench press',
                'muscle_groups' => json_encode(['chest', 'shoulders', 'triceps']),
                'equipment_category' => 'machine',
                'equipment_needed' => 'Chest press machine',
                'difficulty' => 'beginner',
                'instructions' => 'Sit at machine with back against pad, grasp handles, push forward until arms are extended, then return to starting position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Seated Row Machine',
                'description' => 'A machine exercise targeting the back muscles',
                'muscle_groups' => json_encode(['back', 'biceps']),
                'equipment_category' => 'machine',
                'equipment_needed' => 'Seated row machine',
                'difficulty' => 'beginner',
                'instructions' => 'Sit at machine with feet on platform, grasp handles, pull toward abdomen while keeping back straight, then return to start position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Leg Extension',
                'description' => 'An isolation exercise for the quadriceps',
                'muscle_groups' => json_encode(['quads']),
                'equipment_category' => 'machine',
                'equipment_needed' => 'Leg extension machine',
                'difficulty' => 'beginner',
                'instructions' => 'Sit in machine with ankles behind pad, extend legs until straight, hold briefly, then return to starting position with control.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Leg Curl',
                'description' => 'An isolation exercise for the hamstrings',
                'muscle_groups' => json_encode(['hamstrings']),
                'equipment_category' => 'machine',
                'equipment_needed' => 'Leg curl machine',
                'difficulty' => 'beginner',
                'instructions' => 'Lie face down on machine with ankles under pad, curl legs up by bending knees, hold briefly, then lower legs back down with control.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 自重系エクササイズ
            [
                'name' => 'Pull-up',
                'description' => 'A bodyweight exercise for upper body strength',
                'muscle_groups' => json_encode(['back', 'biceps', 'shoulders']),
                'equipment_category' => 'bodyweight',
                'equipment_needed' => 'Pull-up bar',
                'difficulty' => 'intermediate',
                'instructions' => 'Hang from bar with hands wider than shoulder-width, pull body up until chin is over bar, then lower back down with control.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dips',
                'description' => 'A bodyweight exercise for the triceps and chest',
                'muscle_groups' => json_encode(['chest', 'triceps', 'shoulders']),
                'equipment_category' => 'bodyweight',
                'equipment_needed' => 'Parallel bars or dip station',
                'difficulty' => 'intermediate',
                'instructions' => 'Hold body between parallel bars with arms extended, lower body by bending elbows until shoulders are below elbows, then push back up.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Bodyweight Squat',
                'description' => 'A fundamental lower body exercise using just your bodyweight',
                'muscle_groups' => json_encode(['quads', 'hamstrings', 'glutes', 'core']),
                'equipment_category' => 'bodyweight',
                'equipment_needed' => null,
                'difficulty' => 'beginner',
                'instructions' => 'Stand with feet shoulder-width apart, lower body by bending knees and hips as if sitting in a chair, then return to standing position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Plank',
                'description' => 'A static exercise that strengthens the core',
                'muscle_groups' => json_encode(['core', 'shoulders', 'back']),
                'equipment_category' => 'bodyweight',
                'equipment_needed' => null,
                'difficulty' => 'beginner',
                'instructions' => 'Start in push-up position but resting on forearms, maintain straight line from head to heels, hold position while keeping core engaged.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // ケーブル系エクササイズ（'machine'カテゴリに変更）
            [
                'name' => 'Cable Tricep Pushdown',
                'description' => 'An isolation exercise for the triceps using a cable machine',
                'muscle_groups' => json_encode(['triceps']),
                'equipment_category' => 'machine',  // 'cable'から'machine'に変更
                'equipment_needed' => 'Cable machine, rope or bar attachment',
                'difficulty' => 'beginner',
                'instructions' => 'Stand facing cable machine with attachment at chest height, grab attachment, push downward until arms are fully extended, then return to start.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Cable Face Pull',
                'description' => 'An exercise targeting the rear deltoids and upper back',
                'muscle_groups' => json_encode(['shoulders', 'upper back']),
                'equipment_category' => 'machine',  // 'cable'から'machine'に変更
                'equipment_needed' => 'Cable machine, rope attachment',
                'difficulty' => 'intermediate',
                'instructions' => 'Stand facing cable machine with rope attachment at head height, pull rope toward face while separating ends, then return to starting position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Cable Bicep Curl',
                'description' => 'A bicep isolation exercise using cables for constant tension',
                'muscle_groups' => json_encode(['biceps']),
                'equipment_category' => 'machine',  // 'cable'から'machine'に変更
                'equipment_needed' => 'Cable machine, straight or curl bar attachment',
                'difficulty' => 'beginner',
                'instructions' => 'Stand facing cable machine with attachment at waist height, curl attachment up to shoulder level, then lower back down with control.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Cable Woodchoppers',
                'description' => 'A rotational exercise for core strength and stability',
                'muscle_groups' => json_encode(['core', 'obliques']),
                'equipment_category' => 'machine',  // 'cable'から'machine'に変更
                'equipment_needed' => 'Cable machine, single handle attachment',
                'difficulty' => 'intermediate',
                'instructions' => 'Stand sideways to cable machine, grasp handle with both hands, pull diagonally across body from high to low, then return to starting position.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 追加のバリエーション
            [
                'name' => 'Incline Bench Press',
                'description' => 'A variation of bench press focusing more on the upper chest',
                'muscle_groups' => json_encode(['chest', 'shoulders', 'triceps']),
                'equipment_category' => 'barbell',
                'equipment_needed' => 'Incline bench, barbell',
                'difficulty' => 'intermediate',
                'instructions' => 'Lie on an incline bench, grip barbell with hands wider than shoulder-width, lower to upper chest, then press up.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Bulgarian Split Squat',
                'description' => 'A unilateral exercise for leg strength and balance',
                'muscle_groups' => json_encode(['quads', 'hamstrings', 'glutes', 'core']),
                'equipment_category' => 'dumbbell',
                'equipment_needed' => 'Bench, dumbbells (optional)',
                'difficulty' => 'intermediate',
                'instructions' => 'Place one foot on bench behind you, other foot forward, lower into a lunge position, then push back up. Can be done with or without weights.',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('exercises')->insert($exercises);
        $this->command->info('Exercise data seeded successfully! '.count($exercises).' exercises added.');
    }
}
