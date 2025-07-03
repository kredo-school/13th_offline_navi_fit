<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BodyRecord extends Model
{
    protected $fillable = [
        'user_id',
        'recorded_date',
        'weight',
        'body_fat_percentage',
        'memo',
    ];

    protected $casts = [
        'recorded_date' => 'date',
        'weight' => 'decimal:2',
        'body_fat_percentage' => 'decimal:2',
    ];

    /**
     * Get the user that owns the body record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include records for a specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to order by recorded date descending.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('recorded_date', 'desc');
    }
}
