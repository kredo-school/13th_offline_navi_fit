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
        <form method="GET" action="{{ route('training-history.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="dateFrom" class="form-label small">開始日</label>
                    <input type="date" name="date_from" id="dateFrom" class="form-control form-control-sm"
                        value="{{ request('date_from') }}">
                </div>
                <div class="col-md-3">
                    <label for="dateTo" class="form-label small">終了日</label>
                    <input type="date" name="date_to" id="dateTo" class="form-control form-control-sm"
                        value="{{ request('date_to') }}">
                </div>
                <div class="col-md-3">
                    <label for="templateFilter" class="form-label small">テンプレート</label>
                    <select name="template" id="templateFilter" class="form-select form-select-sm">
                        <option value="">全テンプレート</option>
                        <option value="upper" {{ request('template') === 'upper' ? 'selected' : '' }}>上半身集中トレーニング
                        </option>
                        <option value="lower" {{ request('template') === 'lower' ? 'selected' : '' }}>下半身パワーアップ
                        </option>
                        <option value="hiit" {{ request('template') === 'hiit' ? 'selected' : '' }}>HIIT カーディオ
                        </option>
                        <option value="core" {{ request('template') === 'core' ? 'selected' : '' }}>コア強化プログラム</option>
                        <option value="stretch" {{ request('template') === 'stretch' ? 'selected' : '' }}>モーニングストレッチ
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="search" class="form-label small">キーワード検索</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" name="keyword" id="search" class="form-control"
                            value="{{ request('keyword') }}" placeholder="メニュー名、メモで検索">
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <button class="btn btn-primary btn-sm" type="submit">検索</button>
            </div>
        </form>
    </div>
</div>
