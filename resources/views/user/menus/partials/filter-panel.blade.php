{{-- フィルターパネル（サイドバー固定表示）英語版 --}}
<div class="card shadow-sm border-0 h-100">
    <div class="card-body p-3">
        <form action="{{ route('menus.index') }}" method="GET" id="filterForm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h6 fw-semibold mb-0">Filters & Sorting</h3>
                <button type="reset" class="btn btn-link text-primary text-decoration-none small fw-medium p-0"
                    id="clearFilters">
                    Clear
                </button>
            </div>

            {{-- 並び替えオプション --}}
            <div class="mb-4">
                <label class="form-label small fw-medium text-muted">Sort By</label>
                <div class="btn-group-vertical w-100" role="group" aria-label="Sorting options">
                    <input type="radio" class="btn-check" name="sort" id="sortDate" value="date"
                        {{ $filters['sort'] == 'date' ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary text-start small" for="sortDate">
                        Created Date
                        <span class="float-end">↓</span>
                    </label>

                    <input type="radio" class="btn-check" name="sort" id="sortName" value="name"
                        {{ $filters['sort'] == 'name' ? 'checked' : '' }}>
                    <label class="btn btn-outline-secondary text-start small" for="sortName">
                        Name
                    </label>

                    <input type="radio" class="btn-check" name="sort" id="sortExercises" value="exercises"
                        {{ $filters['sort'] == 'exercises' ? 'checked' : '' }}>
                    <label class="btn btn-outline-secondary text-start small" for="sortExercises">
                        Exercise Count
                    </label>

                    <input type="radio" class="btn-check" name="sort" id="sortDuration" value="duration"
                        {{ $filters['sort'] == 'duration' ? 'checked' : '' }}>
                    <label class="btn btn-outline-secondary text-start small" for="sortDuration">
                        Duration
                    </label>
                </div>
            </div>

            {{-- 難易度フィルター --}}
            <div class="mb-4">
                <label class="form-label small fw-medium text-muted">Difficulty</label>
                <div class="d-grid gap-2">
                    @php
                        $difficultyLabels = [
                            'beginner' => ['label' => 'Beginner', 'class' => 'bg-success'],
                            'intermediate' => ['label' => 'Intermediate', 'class' => 'bg-warning text-dark'],
                            'advanced' => ['label' => 'Advanced', 'class' => 'bg-danger'],
                        ];
                    @endphp

                    @foreach ($difficultyLabels as $value => $config)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="difficulty[]"
                                value="{{ $value }}" id="difficulty{{ ucfirst($value) }}"
                                {{ in_array($value, $filters['difficulty']) ? 'checked' : '' }}>
                            <label class="form-check-label d-flex align-items-center small"
                                for="difficulty{{ ucfirst($value) }}">
                                <span class="badge {{ $config['class'] }} me-2">{{ $config['label'] }}</span>
                                <span class="text-muted">
                                    ({{ isset($difficultyCounts[$value]) ? $difficultyCounts[$value] : 0 }})
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 公開状態フィルター --}}
            <div class="mb-4">
                <label class="form-label small fw-medium text-muted">Visibility</label>
                <div class="d-grid gap-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="visibility[]" value="public"
                            id="visibilityPublic" {{ in_array('public', $filters['visibility']) ? 'checked' : '' }}>
                        <label class="form-check-label d-flex align-items-center small" for="visibilityPublic">
                            <i class="fa-solid fa-globe text-success me-2"></i>
                            Public
                            <span class="text-muted ms-1">({{ $visibilityCounts['public'] ?? 0 }})</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="visibility[]" value="private"
                            id="visibilityPrivate" {{ in_array('private', $filters['visibility']) ? 'checked' : '' }}>
                        <label class="form-check-label d-flex align-items-center small" for="visibilityPrivate">
                            <i class="fa-solid fa-lock text-muted me-2"></i>
                            Private
                            <span class="text-muted ms-1">({{ $visibilityCounts['private'] ?? 0 }})</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- タグフィルター --}}
            <div class="mb-4">
                <label class="form-label small fw-medium text-muted">Tags</label>
                <div class="d-grid gap-2">
                    @foreach ($muscleGroups as $muscleGroup)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $muscleGroup }}"
                                id="tag{{ Str::studly($muscleGroup) }}"
                                {{ in_array($muscleGroup, $filters['tags']) ? 'checked' : '' }}>
                            <label class="form-check-label d-flex align-items-center small"
                                for="tag{{ Str::studly($muscleGroup) }}">
                                {{ $muscleGroup }}
                                <span class="text-muted ms-1">({{ $tagCounts[$muscleGroup] ?? 0 }})</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 時間範囲フィルター --}}
            <div class="mb-4">
                <label class="form-label small fw-medium text-muted">Training Duration</label>
                <div class="row g-2">
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <input type="number" class="form-control" name="duration_min" placeholder="Min"
                                min="0" max="300" value="{{ $filters['duration_min'] ?? '' }}">
                            <span class="input-group-text">min</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <input type="number" class="form-control" name="duration_max" placeholder="Max"
                                min="0" max="300" value="{{ $filters['duration_max'] ?? '' }}">
                            <span class="input-group-text">min</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- フィルター適用ボタン --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-filter me-1"></i>
                    Apply Filters
                </button>
            </div>
        </form>
    </div>
</div>
