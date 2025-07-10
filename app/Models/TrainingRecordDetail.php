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
        'sets',
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
        'sets' => 'integer',
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
     * Note: This will be implemented when Exercises model is created.
     */
    // public function exercise(): BelongsTo
    // {
    //     // Temprorary: Will be uncommented when Exercise model exists
    //     // return $this->belongsTo(Exercise::class);
    //     return $this->belongsTo(Exercise::class);
    // }

    /**
     * Scope a query to order by excution order.
     */
    public function scopeOrderedByIndex($query)
    {
        return $query->orderBy('order_index');
    }

    /**
     * Scope a query to filter by training record.
     */
    public function scopeForTrainingRecord($query, $trainingRecordId)
    {
        return $query->where('training_record_id', $trainingRecordId);
    }
}
