<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\TrainingRecord;
use App\Models\TrainingRecordDetail;
use Illuminate\Database\Seeder;

class TrainingRecordDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all training records
        $trainingRecords = TrainingRecord::all();

        if ($trainingRecords->isEmpty()) {
            $this->command->error('No training records found. Please run TrainingRecordSeeder first.');

            return;
        }

        // Get exercises to associate with training records
        $exercises = Exercise::take(5)->get();

        if ($exercises->isEmpty()) {
            $this->command->error('No exercises found. Please run ExerciseSeeder first.');

            return;
        }

        foreach ($trainingRecords as $record) {
            // For each record, add 3-5 exercises
            $exerciseCount = rand(3, 5);

            // Use a subset of exercises
            $recordExercises = $exercises->random(min($exerciseCount, $exercises->count()));

            foreach ($recordExercises as $index => $exercise) {
                // For each exercise, create 3-5 sets
                $setCount = rand(3, 5);

                for ($setNumber = 1; $setNumber <= $setCount; $setNumber++) {
                    TrainingRecordDetail::create([
                        'training_record_id' => $record->id,
                        'exercise_id' => $exercise->id,
                        'order_index' => $index + 1,
                        'set_number' => $setNumber,
                        'reps' => rand(8, 15),
                        'weight' => rand(5, 50) + (rand(0, 1) ? 0.5 : 0),
                        'notes' => rand(0, 5) > 4 ? 'Feeling '.['great', 'good', 'tired', 'strong'][rand(0, 3)] : null,
                    ]);
                }
            }
        }

        $this->command->info('Training record details seeded successfully!');
    }
}
