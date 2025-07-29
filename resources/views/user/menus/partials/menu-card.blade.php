<div class="col-md-6 col-lg-4">
    <div class="card h-100 shadow-sm border-0 position-relative overflow-hidden menu-card" 
         data-menu-id="1">
        <div class="card-body p-4">
            {{-- カードヘッダー --}}
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex align-items-start">
                    <input type="checkbox" 
                           class="form-check-input me-3 mt-1 menu-checkbox" 
                           id="menu-1"
                           value="1">
                    <div>
                        <h3 class="h5 fw-semibold mb-1">初心者向け全身トレーニング</h3>
                        <p class="text-muted small mb-0">基本的なエクササイズで全身をバランスよく鍛えるメニュー</p>
                    </div>
                </div>
                {{-- 公開/非公開アイコン --}}
                <i class="fa-solid fa-globe text-success" title="公開メニュー"></i>
            </div>

            {{-- メタ情報 --}}
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="fa-solid fa-calendar me-2"></i>
                        <span>2025年1月15日</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="fa-solid fa-bullseye me-2"></i>
                        <span>8種目</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="fa-solid fa-clock me-2"></i>
                        <span>45分</span>
                    </div>
                </div>
                <div class="col-6">
                    <x-difficulty-badge :level="'beginner'" />
                </div>
            </div>

            {{-- タグ --}}
            <div class="d-flex flex-wrap gap-1 mb-3">
                <span class="badge bg-secondary">全身</span>
                <span class="badge bg-secondary">筋トレ</span>
                <span class="badge bg-secondary">初心者</span>
            </div>

            {{-- アクションボタン --}}
            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="#" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-eye me-1"></i>
                    詳細
                </a>
                <div class="d-flex gap-2">
                    <a href="#" 
                       class="btn btn-sm btn-outline-secondary" 
                       title="編集">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger delete-menu-btn" 
                            title="削除"
                            data-menu-id="1"
                            data-menu-title="初心者向け全身トレーニング">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
