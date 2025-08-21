{{-- 
/**
 * Training Detail Metrics Dashboard
 * Metrics dashboard (statistical indicators)
 */
--}}

<div class="row g-3 mb-4">
    {{-- Total Sets --}}
    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-muted small fw-medium">Total Sets</div>
                </div>
                <div class="display-6 fw-bold text-dark">{{ $record->details->count() }}</div>
            </div>
        </div>
    </div>

    {{-- Total Reps --}}
    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-muted small fw-medium">Total Reps</div>
                </div>
                <div class="display-6 fw-bold text-dark">{{ $record->details->sum('reps') }}</div>
            </div>
        </div>
    </div>

    {{-- Total Volume --}}
    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-muted small fw-medium">Total Volume</div>
                </div>
                <div class="display-6 fw-bold text-dark">{{ number_format($record->details->sum('volume')) }}</div>
                <div class="text-muted small">kg</div>
            </div>
        </div>
    </div>

    {{-- Calories or Duration --}}
    @if ($record->duration_minutes)
        <div class="col-6 col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="text-muted small fw-medium">Training Duration</div>
                    </div>
                    <div class="display-6 fw-bold text-dark">{{ $record->duration_minutes }}</div>
                    <div class="text-muted small">min</div>
                </div>
            </div>
        </div>
    @elseif ($record->calories)
        <div class="col-6 col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="text-muted small fw-medium">Calories Burned</div>
                    </div>
                    <div class="display-6 fw-bold text-dark">{{ $record->calories }}</div>
                    <div class="text-muted small">kcal</div>
                </div>
            </div>
        </div>
    @else
        <!-- Display other metrics or nothing -->
    @endif
</div>
