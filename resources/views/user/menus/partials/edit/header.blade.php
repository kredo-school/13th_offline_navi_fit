<div class="bg-white shadow-sm border-bottom">
    <div class="container-fluid px-4 py-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <a href="{{ route('menus.show', $menu) }}" class="btn btn-light rounded-circle me-3"
                    aria-label="メニュー詳細に戻る">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h1 class="h4 mb-1">メニュー編集</h1>
                    <nav class="small text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-decoration-none">Dashboard</a>
                        <span class="mx-2">›</span>
                        <a href="{{ route('menus.index') }}" class="text-muted text-decoration-none">メニュー一覧</a>
                        <span class="mx-2">›</span>
                        <a href="{{ route('menus.show', $menu) }}"
                            class="text-muted text-decoration-none">{{ $menu->name ?? 'メニュー名' }}</a>
                        <span class="mx-2">›</span>
                        <span class="text-primary">編集</span>
                    </nav>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('menus.show', $menu) }}" class="btn btn-outline-secondary">
                    キャンセル
                </a>
                <button type="button" class="btn btn-primary" id="saveButton">
                    <i class="bi bi-check-circle me-1"></i>
                    更新
                </button>
            </div>
        </div>
    </div>
</div>
