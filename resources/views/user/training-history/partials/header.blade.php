{{-- 
/**
 * Training History Header
 * ヘッダー部分（タイトル、戻るボタン、エクスポートボタン、フィルターボタン）
 */
--}}

<div class="bg-white shadow-sm border-bottom sticky-top">
    <div class="container-xxl">
        <div class="d-flex align-items-center justify-content-between py-3">
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary btn-sm me-3" type="button">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <div>
                    <h1 class="h4 mb-0 text-dark">Training History</h1>
                    <p class="text-muted small mb-0">過去のトレーニング記録を確認</p>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-secondary btn-sm" type="button">
                    <i class="fas fa-download me-1"></i>
                    エクスポート
                </button>
                
                <button class="btn btn-outline-primary btn-sm" type="button">
                    <i class="fas fa-filter me-1"></i>
                    フィルター
                </button>
            </div>
        </div>
    </div>
</div>