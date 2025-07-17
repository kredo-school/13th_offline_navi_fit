{{-- 
/**
 * Training History Advanced Filters
 * 詳細フィルター（日付範囲、テンプレート、検索）
 * 
 * 【注意】JavaScript無効のため、フィルターの開閉は常に開いた状態で表示
 */
--}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="h6 mb-3">詳細フィルター</h3>
        <div class="row g-3">
            <div class="col-md-3">
                <label for="dateFrom" class="form-label small">開始日</label>
                <input type="date" class="form-control form-control-sm" id="dateFrom" value="">
            </div>
            <div class="col-md-3">
                <label for="dateTo" class="form-label small">終了日</label>
                <input type="date" class="form-control form-control-sm" id="dateTo" value="">
            </div>
            <div class="col-md-3">
                <label for="templateFilter" class="form-label small">テンプレート</label>
                <select class="form-select form-select-sm" id="templateFilter">
                    <option value="all" selected>全テンプレート</option>
                    <option value="upper">上半身集中トレーニング</option>
                    <option value="lower">下半身パワーアップ</option>
                    <option value="hiit">HIIT カーディオ</option>
                    <option value="core">コア強化プログラム</option>
                    <option value="stretch">モーニングストレッチ</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="search" class="form-label small">キーワード検索</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" id="search" placeholder="メニュー名、メモで検索">
                </div>
            </div>
        </div>
        <div class="mt-3 d-flex justify-content-end">
            <button class="btn btn-primary btn-sm" type="button">
                検索
            </button>
        </div>
    </div>
</div>