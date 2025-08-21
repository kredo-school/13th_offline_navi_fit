{{-- 
/**
 * Training History Overview Panel
 * Overview panel (displays statistics)
 */
--}}

<div class="card shadow-sm mb-4" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);">
    <div class="card-body text-white">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="h5 mb-0">Training Overview</h2>
            <i class="fas fa-trending-up text-success"></i>
        </div>

        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="bg-white bg-opacity-10 rounded p-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-bullseye me-2"></i>
                        <span class="small opacity-75">Total Workouts</span>
                    </div>
                    <div class="h3 mb-1">{{ $records->count() }}</div>
                    <div class="small opacity-75">sessions</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="bg-white bg-opacity-10 rounded p-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-chart-bar me-2"></i>
                        <span class="small opacity-75">Total Volume</span>
                    </div>
                    <div class="h3 mb-1">
                        {{ number_format($records->sum(fn($r) => $r->details->sum('volume'))) }}
                    </div>
                    <div class="small opacity-75">kg</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="bg-white bg-opacity-10 rounded p-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-clock me-2"></i>
                        <span class="small opacity-75">Average Time</span>
                    </div>
                    <div class="h3 mb-1">
                        {{ $records->count() > 0 ? round($records->sum('duration_minutes') / $records->count()) : 0 }}
                    </div>
                    <div class="small opacity-75">min</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="bg-white bg-opacity-10 rounded p-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-fire me-2"></i>
                        <span class="small opacity-75">This Week</span>
                    </div>
                    <div class="h3 mb-1">
                        {{ $records->whereBetween('training_date', [now()->startOfWeek(), now()->endOfWeek()])->count() }}
                    </div>
                    <div class="small opacity-75">sessions/week</div>
                </div>
            </div>
        </div>

        <div class="mt-3 p-3 bg-white bg-opacity-10 rounded">
            <div class="d-flex align-items-center">
                <i class="fas fa-trending-up text-success me-2"></i>
                <span class="small">12.5% improvement compared to last week</span>
            </div>
        </div>
    </div>
</div>
