{{-- 
/**
 * Training Detail Quick Stats
 * クイック統計（各種計算済み統計情報）
 */
--}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="h5 fw-semibold mb-4">クイック統計</h3>

        <div class="d-flex flex-column gap-3">
            @if ($record->duration_minutes && $record->details->count() > 0)
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted">平均セット時間</span>
                    <span class="fw-medium">{{ round($record->duration_minutes / $record->details->count(), 1) }}分</span>
                </div>
            @endif

            @if ($record->details->count() > 0)
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted">セット当たり回数</span>
                    <span
                        class="fw-medium">{{ round($record->details->sum('reps') / $record->details->count(), 1) }}回</span>
                </div>
            @endif

            @if ($record->details->sum('weight') > 0 && $record->details->whereNotNull('weight')->count() > 0)
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted">平均重量</span>
                    <span
                        class="fw-medium">{{ round($record->details->sum('weight') / $record->details->whereNotNull('weight')->count(), 1) }}kg</span>
                </div>
            @endif

            @if ($record->calories && $record->duration_minutes)
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted">カロリー効率</span>
                    <span class="fw-medium">{{ round($record->calories / $record->duration_minutes, 1) }}kcal/分</span>
                </div>
            @endif
        </div>
    </div>
</div>
