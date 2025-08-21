{{-- 
/**
 * Training Detail Quick Stats
 * Quick statistics (pre-calculated statistical information)
 */
--}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="h5 fw-semibold mb-4">Quick Stats</h3>

        <div class="d-flex flex-column gap-3">
            @if ($record->duration_minutes && $record->details->count() > 0)
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted">Average Time per Set</span>
                    <span class="fw-medium">{{ round($record->duration_minutes / $record->details->count(), 1) }}
                        min</span>
                </div>
            @endif

            @if ($record->details->count() > 0)
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted">Reps per Set</span>
                    <span class="fw-medium">{{ round($record->details->sum('reps') / $record->details->count(), 1) }}
                        reps</span>
                </div>
            @endif

            @if ($record->details->sum('weight') > 0 && $record->details->whereNotNull('weight')->count() > 0)
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted">Average Weight</span>
                    <span
                        class="fw-medium">{{ round($record->details->sum('weight') / $record->details->whereNotNull('weight')->count(), 1) }}
                        kg</span>
                </div>
            @endif

            @if ($record->calories && $record->duration_minutes)
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted">Calorie Efficiency</span>
                    <span class="fw-medium">{{ round($record->calories / $record->duration_minutes, 1) }}
                        kcal/min</span>
                </div>
            @endif
        </div>
    </div>
</div>
