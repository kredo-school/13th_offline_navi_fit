<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'based_on_template_id',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the menu.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the template that this menu is based on.
     */
    public function basedOnTemplate(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'based_on_template_id');
    }

    /**
     * Get the menu exercises for this menu.
     */
    public function menuExercises(): HasMany
    {
        return $this->hasMany(MenuExercise::class);
    }

    /**
     * Scope a query to only include active menus.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include menus for a specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get the training records for the menu.
     */
    public function trainingRecords(): HasMany
    {
        return $this->hasMany(TrainingRecord::class);
    }

    /**
     * Get the estimated duration for this menu in minutes.
     */
    public function getEstimatedDurationAttribute(): int
    {
        $totalTime = 0;

        foreach ($this->menuExercises as $menuExercise) {
            // Add time for each set (average 45 seconds per set)
            $setTime = ($menuExercise->sets ?? 0) * 45;

            // Add rest time between sets
            $restTime = ($menuExercise->sets ?? 0) * ($menuExercise->rest_seconds ?? 60);

            // For first set, no rest before
            if ($menuExercise->sets > 0) {
                $restTime -= ($menuExercise->rest_seconds ?? 60);
            }

            $totalTime += $setTime + $restTime;
        }

        // Convert to minutes and round up
        return ceil($totalTime / 60);
    }

    /**
     * Get unique muscle groups from all exercises in this menu.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUniqueMuscleGroupsAttribute()
    {
        $muscleGroups = collect();

        foreach ($this->menuExercises as $menuExercise) {
            if ($menuExercise->exercise && $menuExercise->exercise->muscle_groups) {
                $muscleGroups = $muscleGroups->merge($menuExercise->exercise->muscle_groups);
            }
        }

        return $muscleGroups->unique();
    }
}
