<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        // Safety measure to not run in production
        if (! app()->environment('local', 'development')) {
            return;
        }

        // Skip if data already exists
        if (DB::table('templates')->count() > 0) {
            $this->command->info('Templates table already has data. Skipping...');

            return;
        }

        // Get admin user ID
        $adminId = DB::table('users')->where('email', 'admin@example.com')->value('id');
        if (! $adminId) {
            $adminId = DB::table('users')->first()->id ?? 1;
        }

        $now = Carbon::now();

        // Template data
        $templates = [
            [
                'name' => 'Full Body Workout for Beginners',
                'description' => 'A complete full-body workout plan designed for beginners, to be performed 2-3 times per week',
                'difficulty' => 'normal',
                'created_by' => $adminId,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Upper Body Focus Program',
                'description' => 'A specialized program targeting chest, back, shoulders, and arms',
                'difficulty' => 'normal',
                'created_by' => $adminId,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Lower Body Focus Program',
                'description' => 'A specialized program targeting legs and glutes',
                'difficulty' => 'hard',
                'created_by' => $adminId,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '3-Day Split Training',
                'description' => 'A program divided into chest/back, shoulders/arms, and legs',
                'difficulty' => 'hard',
                'created_by' => $adminId,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Bodyweight Training Plan',
                'description' => 'A training plan using only bodyweight exercises that can be done at home',
                'difficulty' => 'easy',
                'created_by' => $adminId,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('templates')->insert($templates);
        $this->command->info('Template data seeded successfully!');
    }
}
