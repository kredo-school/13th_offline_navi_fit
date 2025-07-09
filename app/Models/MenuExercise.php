<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuExercise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_id',
        'exercise_id',
        'order_index',
        'sets',
        'reps',
        'weight',
        'rest_seconds',
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
        'rest_seconds' => 'integer',
    ];

    /**
     * Get the menu that owns the MenuExercise.
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the exercise details.
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * Scope a quary to order by index.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index');
    }

    /**
     * Scope a query to filter by menu.
     */
    public function scopeForMenu($query, $menuId)
    {
        return $query->where('menu_id', $menuId);
    }
}
