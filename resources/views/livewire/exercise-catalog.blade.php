{{-- resources/views/user/menus/partials/create/exercise-catalog.blade.php --}}
<div class="card border-0 shadow-sm h-100 d-flex flex-column">
    <div class="card-header bg-white border-bottom">
        <h6 class="card-title mb-1">Exercise Catalog</h6>
        <small class="text-muted">Click or drag to add</small>
    </div>

    {{-- Filters --}}
    <div class="card-body border-bottom pb-2">
        <div class="d-flex flex-column gap-2">
            {{-- Search --}}
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" 
                       class="form-control border-start-0" 
                       placeholder="Search for exercises"
                       id="exerciseSearch"
                       wire:model.live.debounce.300ms='searchExercise'
                       autocomplete="off"
                       style="border-left: none;">
                <button class="btn btn-outline-secondary" 
                        type="button" 
                        wire:click="clear"
                        title="Clear the search terms">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Category Filter --}}
            <select class="form-select form-select-sm"
                wire:model.live='categoryFilter'
                id="categoryFilter">
                <option value="all">All Categories</option>
                <option value="chest">Chest</option>
                <option value="back">Back</option>
                <option value="legs">Legs</option>
                <option value="shoulders">Shoulders</option>
                <option value="arms">Arms</option>
                <option value="core">Core</option>
            </select>

            {{-- Difficulty Filter --}}
            <select class="form-select form-select-sm" 
                wire:model.live='difficultyFilter'
                id="difficultyFilter">
                <option value="all">All Levels</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>

            {{-- Sort --}}
            {{-- <select class="form-select form-select-sm" 
                wire:model.live='sortBy'
                id="sortBy">
                <option value="name">Sort by Name</option>
                <option value="difficulty">Sort by Difficulty</option>
            </select> --}}
        </div>
    </div>

    {{-- Exercise Grid --}}
    <div class="flex-fill overflow-auto p-0">
        <div class="d-flex flex-column gap-2 pt-2 px-3 pb-3 exercise-catalog-container">
            @forelse($exercises as $exercise)
                <div class="card border exercise-card w-100" draggable="true" data-exercise="{{ $exercise->name }}" data-exercise-id="{{ $exercise->id }}">
                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="pe-2 flex-grow-1">
                                <h6 class="card-title mb-1" style="font-size: 0.9rem;">{{ $exercise->name }}</h6>
                                <p class="text-muted mb-2" style="font-size: 0.8rem;">
                                    {{ isset($exercise->muscle_groups[0]) ? $exercise->muscle_groups[0] : '' }} •
                                    {{ $exercise->equipment_category }}
                                </p>
                                
                                {{-- 難易度バッジ --}}
                                <div class="d-flex align-items-center mb-2">
                                    @php
                                        $badgeClass = 'bg-success';
                                        $difficultyLabel = 'Beginner';
                                        if ($exercise->difficulty === 'intermediate') {
                                            $badgeClass = 'bg-warning text-dark';
                                            $difficultyLabel = 'Intermediate';
                                        } elseif ($exercise->difficulty === 'advanced') {
                                            $badgeClass = 'bg-danger';
                                            $difficultyLabel = 'Advanced';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $difficultyLabel }}</span>
                                </div>

                                {{-- Muscle Groups --}}
                                <div class="d-flex flex-wrap gap-1 mb-2">
                                    @foreach ($exercise->muscle_groups ?? [] as $muscleGroup)
                                        <span class="badge bg-light text-dark"
                                            style="font-size: 0.7rem;">{{ $muscleGroup }}</span>
                                    @endforeach
                                </div>

                                {{-- Action Buttons --}}
                                <div class="d-flex gap-1">
                                    {{-- 詳細表示ボタン --}}
                                     <button type="button" 
                                             class="btn btn-outline-primary btn-sm flex-fill" 
                                             data-bs-toggle="modal" 
                                             data-bs-target="#exerciseDetailModal"
                                             data-exercise-id="{{ $exercise->id }}"
                                             style="font-size: 0.75rem;">
                                         <i class="fas fa-eye me-1"></i>Details
                                     </button>
                                    
                                        {{-- メニューに追加ボタン --}}
                                     <button type="button" 
                                             class="btn btn-primary btn-sm flex-fill add-exercise-btn"
                                             data-exercise-id="{{ $exercise->id }}"
                                             data-exercise-name="{{ $exercise->name }}"
                                             style="font-size: 0.75rem;">
                                         <i class="fas fa-plus me-1"></i>Add
                                     </button>
                                </div>
                            </div>

                            {{-- Exercise Image --}}
                            <div class="flex-shrink-0">
                                <img src="{{ $exercise->image_url ?? asset('images/navifit_icon.jpg') }}"
                                    class="rounded" alt="{{ $exercise->name }}"
                                    style="width: 70px; height: 70px; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-clipboard-list display-6 text-muted mb-2"></i>
                    <p>No exercises found</p>
                    @if($searchExercise || $categoryFilter !== 'all' || $difficultyFilter !== 'all')
                        <button wire:click="clear" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="fas fa-undo me-1"></i>Clear Filters
                        </button>
                    @endif
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    // Livewireイベントをリッスンして入力フィールドをクリア
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('clearSearchInput', () => {
            const searchInput = document.getElementById('exerciseSearch');
            if (searchInput) {
                searchInput.value = '';
                searchInput.focus();
            }
        });

        // セレクトの表示も 'all' に戻す
        Livewire.on('resetFilterSelects', () => {
            const category = document.getElementById('categoryFilter');
            const difficulty = document.getElementById('difficultyFilter');
            if (category) category.value = 'all';
            if (difficulty) difficulty.value = 'all';
        });
    });
</script>