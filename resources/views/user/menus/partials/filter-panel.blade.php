{{-- Livewire用フィルターパネル --}}
<div class="card shadow-sm border-0 h-100">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="h6 fw-semibold mb-0">Filters & Sorting</h3>
            <button type="button" 
                    wire:click="clearFilters"
                    class="btn btn-link text-primary text-decoration-none small fw-medium p-0">
                Clear
            </button>
        </div>

        {{-- 並び替えオプション --}}
        <div class="mb-4">
            <label class="form-label small fw-medium text-muted">Sort By</label>
            <div class="btn-group-vertical w-100" role="group" aria-label="Sorting options">
                <input type="radio" class="btn-check" wire:model.live="sort" id="sortDate" value="date">
                <label class="btn btn-outline-primary text-start small" for="sortDate">
                    Created Date
                    <span class="float-end">↓</span>
                </label>

                <input type="radio" class="btn-check" wire:model.live="sort" id="sortName" value="name">
                <label class="btn btn-outline-secondary text-start small" for="sortName">
                    Name
                </label>

                {{-- <input type="radio" class="btn-check" wire:model.live="sort" id="sortExercises" value="exercises">
                <label class="btn btn-outline-secondary text-start small" for="sortExercises">
                    Exercise Count
                </label>

                <input type="radio" class="btn-check" wire:model.live="sort" id="sortDuration" value="duration">
                <label class="btn btn-outline-secondary text-start small" for="sortDuration">
                    Duration
                </label> --}}
            </div>
        </div>

        {{-- 公開設定フィルター --}}
        <div class="mb-4">
            <label class="form-label small fw-medium text-muted">Visibility</label>
            <div class="d-grid gap-2">
                <div class="form-check">
                    <input class="form-check-input" 
                           type="radio" 
                           wire:model.live="visibility"
                           value="public" 
                           name="visibility"
                           id="visibilityPublic">
                    <label class="form-check-label small d-flex justify-content-between align-items-center"
                           for="visibilityPublic">
                        <span>
                            <i class="fa-solid fa-globe text-success me-2"></i>Public
                            <span class="text-muted">({{ $visibilityCounts['public'] ?? 0 }})</span>
                        </span>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" 
                           type="radio" 
                           wire:model.live="visibility"
                           value="private" 
                           name="visibility"
                           id="visibilityPrivate">
                    <label class="form-check-label small d-flex justify-content-between align-items-center"
                           for="visibilityPrivate">
                        <span>
                            <i class="fa-solid fa-lock text-muted me-2"></i>Private
                            <span class="text-muted">({{ $visibilityCounts['private'] ?? 0 }})</span>
                        </span>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" 
                           type="radio" 
                           wire:model.live="visibility"
                           value="" 
                           name="visibility"
                           id="visibilityAll">
                    <label class="form-check-label small d-flex justify-content-between align-items-center"
                           for="visibilityAll">
                        <span>
                            <i class="fa-solid fa-layer-group text-muted"></i> All
                            <span class="text-muted">({{ ($visibilityCounts['public'] ?? 0) + ($visibilityCounts['private'] ?? 0) }})</span>
                        </span>
                    </label>
                </div>
            </div>
        </div>

        {{-- タグフィルター（筋肉グループ） --}}
        <div class="mb-4">
            <label class="form-label small fw-medium text-muted">Muscle Groups</label>
            <div class="d-grid gap-2" style="max-height: 200px; overflow-y: auto;">
                @foreach ($muscleGroups as $muscleGroup)
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               wire:model.live="tags"
                               value="{{ $muscleGroup }}" 
                               id="tag{{ str_replace(' ', '', $muscleGroup) }}">
                        <label class="form-check-label small d-flex justify-content-between align-items-center"
                               for="tag{{ str_replace(' ', '', $muscleGroup) }}">
                            <span>
                                <i>{{ $muscleGroup }}</i>
                                <span class="text-muted">({{ $tagCounts[$muscleGroup] ?? 0 }})</span>
                            </span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 時間範囲フィルター
        <div class="mb-4">
            <label class="form-label small fw-medium text-muted">Duration (minutes)</label>
            <div class="row g-2">
                <div class="col-6">
                    <input type="number" 
                           class="form-control form-control-sm" 
                           wire:model.live.debounce.500ms="duration_min"
                           placeholder="Min" 
                           min="0">
                </div>
                <div class="col-6">
                    <input type="number" 
                           class="form-control form-control-sm" 
                           wire:model.live.debounce.500ms="duration_max"
                           placeholder="Max" 
                           min="0">
                </div>
            </div>
        </div> --}}
    </div>
</div>
