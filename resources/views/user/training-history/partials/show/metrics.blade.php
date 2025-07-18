{{-- 
/**
 * Training Detail Metrics Dashboard
 * メトリクスダッシュボード（統計指標と前回比較）
 */
--}}

<div class="row g-3 mb-4">
    {{-- 総セット数 --}}
    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-muted small fw-medium">総セット数</div>
                    {{-- 前回比較（上昇） --}}
                    <div class="badge bg-success-subtle text-success d-flex align-items-center gap-1">
                        <i class="fas fa-trending-up" style="font-size: 0.7rem;"></i>
                        <span>8%</span>
                    </div>
                </div>
                <div class="display-6 fw-bold text-dark">12</div>
            </div>
        </div>
    </div>

    {{-- 総回数 --}}
    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-muted small fw-medium">総回数</div>
                    {{-- 前回比較（上昇） --}}
                    <div class="badge bg-success-subtle text-success d-flex align-items-center gap-1">
                        <i class="fas fa-trending-up" style="font-size: 0.7rem;"></i>
                        <span>9%</span>
                    </div>
                </div>
                <div class="display-6 fw-bold text-dark">144</div>
            </div>
        </div>
    </div>

    {{-- 総ボリューム --}}
    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-muted small fw-medium">総ボリューム</div>
                    {{-- 前回比較（上昇） --}}
                    <div class="badge bg-success-subtle text-success d-flex align-items-center gap-1">
                        <i class="fas fa-trending-up" style="font-size: 0.7rem;"></i>
                        <span>7%</span>
                    </div>
                </div>
                <div class="display-6 fw-bold text-dark">2,850</div>
                <div class="text-muted small">kg</div>
            </div>
        </div>
    </div>

    {{-- 消費カロリー --}}
    <div class="col-6 col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-muted small fw-medium">消費カロリー</div>
                    {{-- 前回比較（変化なし） --}}
                    <div class="badge bg-secondary-subtle text-secondary d-flex align-items-center gap-1">
                        <i class="fas fa-minus" style="font-size: 0.7rem;"></i>
                        <span>0%</span>
                    </div>
                </div>
                <div class="display-6 fw-bold text-dark">420</div>
                <div class="text-muted small">kcal</div>
            </div>
        </div>
    </div>
</div>