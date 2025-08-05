<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingRecordDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'training_record_id',
        'exercise_id',
        'order_index',
        'set_number',
        'reps',
        'weight',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'weight' => 'decimal:2',
        'order_index' => 'integer',
        'set_number' => 'integer',
        'reps' => 'integer',
    ];

    /**
     * Get the training record that owns the detail.
     */
    public function trainingRecord(): BelongsTo
    {
        return $this->belongsTo(TrainingRecord::class);
    }

    /**
     * Get the exercise for this training record detail.
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * Scope a query to order by execution order and set number.
     */
    public function scopeOrderedByIndex($query)
    {
        return $query->orderBy('order_index')->orderBy('set_number');
    }

    /**
     * Scope a query to filter by training record.
     */
    public function scopeForTrainingRecord($query, $trainingRecordId)
    {
        return $query->where('training_record_id', $trainingRecordId);
    }

    /**
     * Scope a query to filter by exercise.
     */
    public function scopeForExercise($query, $exerciseId)
    {
        return $query->where('exercise_id', $exerciseId);
    }

    /**
     * Scope a query to get sets for a specific exercise in order.
     */
    public function scopeExerciseSets($query, $trainingRecordId, $exerciseId)
    {
        return $query->where('training_record_id', $trainingRecordId)
            ->where('exercise_id', $exerciseId)
            ->orderBy('set_number');
    }

    /**
     * Get the volume (weight * reps) for this training record detail.
     */
    public function getVolumeAttribute(): float
    {
        return $this->weight * $this->reps;
    }
}
