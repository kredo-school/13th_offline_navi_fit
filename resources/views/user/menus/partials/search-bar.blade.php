{{-- 検索バー（英語版） --}}
<div class="mb-4">
    <form action="{{ route('menus.index') }}" method="GET" id="searchForm">
        <div class="row">
            <div class="col-md-6">
                <div class="position-relative">
                    <i class="fa-solid fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" class="form-control ps-5" name="search" id="searchInput" placeholder="Search menus..."
                        value="{{ $filters['search'] ?? '' }}">
                </div>
            </div>
        </div>

        {{-- 現在のフィルター値を維持するための隠しフィールド --}}
        {{-- @if (isset($filters['sort']))
            <input type="hidden" name="sort" value="{{ $filters['sort'] }}">
        @endif

        @if (!empty($filters['difficulty']))
            @foreach ($filters['difficulty'] as $difficulty)
                <input type="hidden" name="difficulty[]" value="{{ $difficulty }}">
            @endforeach
        @endif

        @if (!empty($filters['visibility']))
            @foreach ($filters['visibility'] as $visibility)
                <input type="hidden" name="visibility[]" value="{{ $visibility }}">
            @endforeach
        @endif

        @if (!empty($filters['tags']))
            @foreach ($filters['tags'] as $tag)
                <input type="hidden" name="tags[]" value="{{ $tag }}">
            @endforeach
        @endif

        @if (isset($filters['duration_min']))
            <input type="hidden" name="duration_min" value="{{ $filters['duration_min'] }}">
        @endif

        @if (isset($filters['duration_max']))
            <input type="hidden" name="duration_max" value="{{ $filters['duration_max'] }}">
        @endif
        </div> --}}
    </form>
</div>
