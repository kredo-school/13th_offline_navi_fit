<div class="bg-white shadow-sm border-bottom">
    <div class="container-fluid px-4 py-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-light rounded-circle me-3" onclick="history.back()">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <div>
                    <h1 class="h4 mb-1">メニュー編集</h1>
                    <nav class="small text-muted">
                        <span>Dashboard</span>
                        <span class="mx-2">›</span>
                        <span>メニュー一覧</span>
                        <span class="mx-2">›</span>
                        <span>{{ $menu->name ?? 'メニュー名' }}</span>
                        <span class="mx-2">›</span>
                        <span class="text-primary">編集</span>
                    </nav>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-outline-secondary" onclick="history.back()">
                    キャンセル
                </button>
                <button type="button" class="btn btn-primary" id="saveButton">
                    <i class="bi bi-check-circle me-1"></i>
                    更新
                </button>
            </div>
        </div>
    </div>
</div>