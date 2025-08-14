<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplateExercise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'template_id',
        'exercise_id',
        'order_index',
        'sets',
        'reps',
        'weight',
        'rest_seconds',
        'duration_seconds',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order_index' => 'integer',
        'sets' => 'integer',
        'reps' => 'integer',
        'weight' => 'decimal:2',
        'rest_seconds' => 'integer',
        'duration_seconds' => 'integer',
    ];

    /**
     * Get the template that owns this exercise.
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * Get the exercise for this template exercise.
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * Scope a query to order by execution order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index');
    }

    /**
     * Scope a query to filter by template.
     */
    public function scopeForTemplate($query, $templateId)
    {
        return $query->where('template_id', $templateId);
    }

    /**
     * Check if this is a time-based exercise.
     */
    public function isTimeBased(): bool
    {
        return ! is_null($this->duration_seconds);
    }

    /**
     * Get display format for this exercise.
     */
    public function getDisplayFormat(): string
    {
        $weightInfo = $this->weight ? " ({$this->weight} kg)" : '';

        if ($this->isTimeBased()) {
            return "{$this->sets} sets × {$this->duration_seconds} seconds{$weightInfo}";
        }

        return "{$this->sets} sets × {$this->reps} reps{$weightInfo}";
    }
}
