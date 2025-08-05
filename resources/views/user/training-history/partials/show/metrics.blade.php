{{-- 
/**
 * Training Detail Metrics Dashboard
 * メトリクスダッシュボード（統計指標）
 */
--}}

<div class="row g-3 mb-4">
    {{-- 総セット数 --}}
    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-muted small fw-medium">総セット数</div>
                </div>
                <div class="display-6 fw-bold text-dark">{{ $record->details->count() }}</div>
            </div>
        </div>
    </div>

    {{-- 総回数 --}}
    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-muted small fw-medium">総回数</div>
                </div>
                <div class="display-6 fw-bold text-dark">{{ $record->details->sum('reps') }}</div>
            </div>
        </div>
    </div>

    {{-- 総ボリューム --}}
    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-muted small fw-medium">総ボリューム</div>
                </div>
                <div class="display-6 fw-bold text-dark">{{ number_format($record->details->sum('volume')) }}</div>
                <div class="text-muted small">kg</div>
            </div>
        </div>
    </div>

    {{-- 消費カロリー --}}
    @if ($record->duration_minutes)
        <div class="col-6 col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="text-muted small fw-medium">トレーニング時間</div>
                    </div>
                    <div class="display-6 fw-bold text-dark">{{ $record->duration_minutes }}</div>
                    <div class="text-muted small">分</div>
                </div>
            </div>
        </div>
    @elseif ($record->calories)
        <div class="col-6 col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="text-muted small fw-medium">消費カロリー</div>
                    </div>
                    <div class="display-6 fw-bold text-dark">{{ $record->calories }}</div>
                    <div class="text-muted small">kcal</div>
                </div>
            </div>
        </div>
    @else
        <!-- 他の指標を表示するか、何も表示しない -->
    @endif
</div>
