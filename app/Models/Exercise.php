<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'muscle_groups',
        'equipment_category',
        'equipment_needed',
        'difficulty',
        'instructions',
        'image_url',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'muscle_groups' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the menu exercises for this exercise.
     */
    public function menuExercises(): HasMany
    {
        return $this->hasMany(MenuExercise::class);
    }

    /**
     * Get the template exercises for this exercise.
     */
    public function templateExercises(): HasMany
    {
        return $this->hasMany(TemplateExercise::class);
    }

    /**
     * Get the training record details for this exercise.
     */
    public function trainingRecordDetails(): HasMany
    {
        return $this->hasMany(TrainingRecordDetail::class);
    }

    /**
     * Scope a query to only include active exercises.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by equipment category.
     */
    public function scopeByEquipmentCategory($query, $category)
    {
        return $query->where('equipment_category', $category);
    }

    /**
     * Scope a query to filter by difficulty level.
     */
    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    /**
     * Scope a query to filter by muscle groups.
     */
    public function scopeByMuscleGroup($query, $muscleGroup)
    {
        return $query->whereJsonContains('muscle_groups', $muscleGroup);
    }

    /**
     * Scope a query to search by name.
     */
    public function scopeSearchByName($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%');
    }

    /**
     * Get exercises suitable for bodyweight training.
     */
    public function scopeBodyweight($query)
    {
        return $query->where('equipment_category', 'bodyweight');
    }

    /**
     * Get exercises suitable for gym training.
     */
    public function scopeGym($query)
    {
        return $query->whereIn('equipment_category', ['barbell', 'dumbbell', 'machine']);
    }
}
