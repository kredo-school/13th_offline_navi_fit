<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'target_weight',
        'target_date',
        'target_body_fat_percentage',
        'weekly_workout_frequency',
        'is_active',
    ];

    protected $casts = [
        'target_date' => 'date',
        'target_weight' => 'decimal:2',
        'target_body_fat_percentage' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
