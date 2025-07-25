{{-- 
/**
 * Training History Overview Panel
 * 概要パネル（統計情報の表示）
 */
--}}

<div class="card shadow-sm mb-4" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);">
    <div class="card-body text-white">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="h5 mb-0">トレーニング概要</h2>
            <i class="fas fa-trending-up text-success"></i>
        </div>
        
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="bg-white bg-opacity-10 rounded p-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-bullseye me-2"></i>
                        <span class="small opacity-75">総ワークアウト</span>
                    </div>
                    <div class="h3 mb-1">8</div>
                    <div class="small opacity-75">回</div>
                </div>
            </div>
            
            <div class="col-6 col-md-3">
                <div class="bg-white bg-opacity-10 rounded p-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-chart-bar me-2"></i>
                        <span class="small opacity-75">総ボリューム</span>
                    </div>
                    <div class="h3 mb-1">11,800</div>
                    <div class="small opacity-75">kg</div>
                </div>
            </div>
            
            <div class="col-6 col-md-3">
                <div class="bg-white bg-opacity-10 rounded p-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-clock me-2"></i>
                        <span class="small opacity-75">平均時間</span>
                    </div>
                    <div class="h3 mb-1">45</div>
                    <div class="small opacity-75">分</div>
                </div>
            </div>
            
            <div class="col-6 col-md-3">
                <div class="bg-white bg-opacity-10 rounded p-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-fire me-2"></i>
                        <span class="small opacity-75">今週の頻度</span>
                    </div>
                    <div class="h3 mb-1">3</div>
                    <div class="small opacity-75">回/週</div>
                </div>
            </div>
        </div>
        
        <div class="mt-3 p-3 bg-white bg-opacity-10 rounded">
            <div class="d-flex align-items-center">
                <i class="fas fa-trending-up text-success me-2"></i>
                <span class="small">先週比 12.5% 向上</span>
            </div>
        </div>
    </div>
</div>