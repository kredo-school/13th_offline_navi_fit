{{-- 
/**
 * Training History Header
 * ヘッダー部分（タイトル、戻るボタン）
 */
--}}

<div class="bg-white shadow-sm border-bottom sticky-top">
    <div class="container-xxl">
        <div class="d-flex align-items-center justify-content-between py-3">
            <div class="d-flex align-items-center">
                <a href="{{ route('training-history.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="h4 mb-0 text-dark">トレーニング詳細</h1>
                    <p class="text-muted small mb-0">トレーニング記録の詳細情報</p>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('training-history.edit', $record->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-edit me-1"></i>
                    編集
                </a>
            </div>
        </div>
    </div>
</div>
