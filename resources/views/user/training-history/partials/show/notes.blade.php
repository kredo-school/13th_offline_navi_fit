{{-- 
/**
 * Training Detail Notes Section
 * メモセクション（編集可能なノート）
 * 
 * 【注意】JavaScript無効のため、編集機能は表示のみ
 */
--}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="h5 fw-semibold mb-0">メモ</h3>
            <button class="btn btn-outline-primary btn-sm" type="button">
                <i class="fas fa-edit"></i>
            </button>
        </div>
        
        {{-- 通常表示モード --}}
        <div id="notes-display">
            <div class="text-muted">
                調子良好。重量を少し上げることができた。次回はベンチプレスで85kgに挑戦したい。
                <!-- 動的化時は{{ $record->notes ?? 'メモはありません' }}に置換 -->
            </div>
        </div>
        
        {{-- 編集モード（JavaScript無効のため非表示） --}}
        <div id="notes-edit" class="d-none">
            <div class="mb-3">
                <textarea 
                    class="form-control" 
                    rows="4" 
                    placeholder="トレーニングのメモを入力...">調子良好。重量を少し上げることができた。次回はベンチプレスで85kgに挑戦したい。</textarea>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm" type="button">
                    <i class="fas fa-check me-1"></i>
                    保存
                </button>
                <button class="btn btn-outline-secondary btn-sm" type="button">
                    <i class="fas fa-times me-1"></i>
                    キャンセル
                </button>
            </div>
        </div>
    </div>
</div>