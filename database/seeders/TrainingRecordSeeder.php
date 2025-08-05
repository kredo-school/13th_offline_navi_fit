<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Template;
use App\Models\TrainingRecord;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TrainingRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user
        $user = User::first();
        if (! $user) {
            $this->command->error('No users found. Please run UserSeeder first.');

            return;
        }

        // Get some templates and menus for reference
        $template = Template::first();
        $menu = Menu::first();

        // Create some training records over the past 30 days
        for ($i = 0; $i < 15; $i++) {
            $daysAgo = rand(0, 30);

            TrainingRecord::create([
                'user_id' => $user->id,
                'training_date' => Carbon::now()->subDays($daysAgo)->format('Y-m-d'),
                'template_id' => $template ? $template->id : null,
                'menu_id' => $menu ? $menu->id : null,
                'notes' => "Training session #$i - ".($daysAgo == 0 ? 'Today' : "$daysAgo days ago"),
            ]);
        }

        $this->command->info('Training records seeded successfully!');
    }
}
