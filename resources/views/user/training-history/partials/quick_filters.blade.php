{{-- 
/**
 * Training History Quick Filters
 * Quick filters (period selection buttons)
 */
--}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('training-history.index') }}" class="btn btn-primary btn-sm">
                All Time
            </a>
            <a href="{{ route('training-history.index', ['filter' => 'this_week']) }}"
                class="btn btn-outline-secondary btn-sm">
                This Week
            </a>
            <a href="{{ route('training-history.index', ['filter' => 'this_month']) }}"
                class="btn btn-outline-secondary btn-sm">
                This Month
            </a>
            <a href="{{ route('training-history.index', ['filter' => 'last_30_days']) }}"
                class="btn btn-outline-secondary btn-sm">
                Last 30 Days
            </a>
        </div>
    </div>
</div>
