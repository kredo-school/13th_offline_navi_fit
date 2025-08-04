{{-- 
/**
 * Training History Quick Filters
 * クイックフィルター（期間選択ボタン）
 */
--}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('training-history.index') }}" class="btn btn-primary btn-sm">
                全期間
            </a>
            <a href="{{ route('training-history.index', ['filter' => 'this_week']) }}"
                class="btn btn-outline-secondary btn-sm">
                今週
            </a>
            <a href="{{ route('training-history.index', ['filter' => 'this_month']) }}"
                class="btn btn-outline-secondary btn-sm">
                今月
            </a>
            <a href="{{ route('training-history.index', ['filter' => 'last_30_days']) }}"
                class="btn btn-outline-secondary btn-sm">
                過去30日
            </a>
        </div>
    </div>
</div>
