<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends Model
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
        'is_active',
        'difficulty',
        'created_by',
        'thumbnail_url',
        'thumbnail_path',
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
     * Get the user that should own the template.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the template exercises for this template.
     */
    public function templateExercises(): HasMany
    {
        return $this->hasMany(TemplateExercise::class);
    }

    /**
     * Get the menus based on this template.
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'based_on_template_id');
    }

    /**
     * Scope a query to only include active templates.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to fileter by difficulty.
     */
    public function scopeDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    /**
     * Get the estimated duration of the template.
     */
    public function getEstimatedDurationAttribute()
    {
        // 1回あたりの時間（秒）を種目の特性に応じて調整できるように
        $defaultTimePerRep = 3;

        // 全体の秒数をまず計算
        $totalSeconds = $this->templateExercises->sum(function ($templateExercise) use ($defaultTimePerRep) {
            $sets = $templateExercise->sets ?? 1;
            $reps = $templateExercise->reps ?? 1;
            $restTime = $templateExercise->rest_seconds ?? 0;

            // 稼働時間
            $exerciseTime = $sets * ($defaultTimePerRep * $reps);

            // 休憩時間（最後のセット後は休憩しない想定）
            $totalRestTime = max(0, $sets - 1) * $restTime;

            return $exerciseTime + $totalRestTime;
        });

        // 分単位で返す（切り上げ）
        return ceil($totalSeconds / 60);
    }

    /**
     * Get the total training volume of the template.
     *
     * 計算式: セット数 × 回数 × 重量 の合計
     */
    public function getTotalVolumeAttribute()
    {
        return $this->templateExercises->sum(function ($templateExercise) {
            $sets = $templateExercise->sets ?? 1;   // セット数（未設定なら1）
            $reps = $templateExercise->reps ?? 1;   // 回数（未設定なら1）
            $weight = $templateExercise->weight ?? 0; // 重量（未設定なら0）

            // 各エクササイズのボリューム計算
            return $sets * $reps * $weight;
        });
    }
}
