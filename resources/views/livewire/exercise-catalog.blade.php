{{-- resources/views/livewire/exercise-catalog.blade.php --}}
<div>
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
                    <option value="全身">Full Body</option>
                    <option value="cardio">Cardio</option>
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
                <select class="form-select form-select-sm" 
                    wire:model.live='sortBy'
                    id="sortBy">
                    <option value="name">Sort by Name</option>
                    <option value="difficulty">Sort by Difficulty</option>
                </select>
            </div>
        </div>

        {{-- Exercise Grid --}}
        <div class="flex-fill overflow-auto p-0">
            <div class="d-flex flex-column gap-2 pt-2 px-3 pb-3 exercise-catalog-container">
                @forelse($exercises as $exercise)
                    <div class="card border exercise-card w-100" 
                         draggable="true" 
                         data-exercise="{{ $exercise->name }}" 
                         data-exercise-id="{{ $exercise->id }}">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="pe-2 flex-grow-1">
                                    <h6 class="card-title mb-1" style="font-size: 0.9rem;">{{ $exercise->name }}</h6>
                                    <p class="text-muted mb-2" style="font-size: 0.8rem;">
                                        {{ isset($exercise->muscle_groups[0]) ? $exercise->muscle_groups[0] : 'General' }} •
                                        {{ $exercise->equipment_category ?? 'No equipment' }}
                                    </p>
                                    
                                    {{-- 難易度バッジ --}}
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge {{ $this->getDifficultyBadgeClass($exercise->difficulty) }}">
                                            {{ $this->getDifficultyLabel($exercise->difficulty) }}
                                        </span>
                                    </div>

                                    {{-- Muscle Groups --}}
                                    <div class="d-flex flex-wrap gap-1 mb-2">
                                        @if($exercise->muscle_groups && is_array($exercise->muscle_groups))
                                            @foreach (array_slice($exercise->muscle_groups, 0, 3) as $muscleGroup)
                                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">
                                                    {{ $muscleGroup }}
                                                </span>
                                            @endforeach
                                            @if(count($exercise->muscle_groups) > 3)
                                                <span class="badge bg-light text-muted" style="font-size: 0.7rem;">
                                                    +{{ count($exercise->muscle_groups) - 3 }}
                                                </span>
                                            @endif
                                        @endif
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div class="d-flex gap-1">
                                        {{-- 詳細表示ボタン --}}
                                        <button type="button" 
                                                class="btn btn-outline-primary btn-sm flex-fill" 
                                                wire:click="showExerciseDetails({{ $exercise->id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="showExerciseDetails({{ $exercise->id }})"
                                                style="font-size: 0.75rem;">
                                            <span wire:loading.remove wire:target="showExerciseDetails({{ $exercise->id }})">
                                                <i class="fas fa-eye me-1"></i>Details
                                            </span>
                                            <span wire:loading wire:target="showExerciseDetails({{ $exercise->id }})">
                                                <i class="fas fa-spinner fa-spin me-1"></i>Loading...
                                            </span>
                                        </button>
                                        
                                        {{-- メニューに追加ボタン --}}
                                        <button type="button" 
                                                class="btn btn-primary btn-sm flex-fill add-exercise-btn"
                                                wire:click="addToMenu({{ $exercise->id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="addToMenu({{ $exercise->id }})"
                                                style="font-size: 0.75rem;">
                                            <span wire:loading.remove wire:target="addToMenu({{ $exercise->id }})">
                                                <i class="fas fa-plus me-1"></i>Add
                                            </span>
                                            <span wire:loading wire:target="addToMenu({{ $exercise->id }})">
                                                <i class="fas fa-spinner fa-spin me-1"></i>Adding...
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                {{-- Exercise Image --}}
                                <div class="flex-shrink-0">
                                    <img src="{{ $exercise->image_url ?? asset('images/navifit_icon.jpg') }}"
                                        class="rounded" alt="{{ $exercise->name }}"
                                        style="width: 70px; height: 70px; object-fit: cover;"
                                        loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-clipboard-list display-6 text-muted mb-2"></i>
                        <p class="mb-0">No exercises found</p>
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

    {{-- Livewire Exercise Details Modal --}}
    @if($showModal && $selectedExercise)
        <div class="modal fade show" 
             style="display: block; background-color: rgba(0,0,0,0.5);"
             tabindex="-1" 
             aria-labelledby="exerciseModalTitle" 
             aria-hidden="false">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    {{-- Modal Header --}}
                    <div class="modal-header border-bottom">
                        <div class="flex-grow-1">
                            <h2 class="modal-title fs-4 fw-bold text-dark mb-2" id="exerciseModalTitle">
                                {{ $selectedExercise->name }}
                            </h2>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge {{ $this->getDifficultyBadgeClass($selectedExercise->difficulty) }} px-3 py-2 rounded-pill">
                                    {{ $this->getDifficultyLabel($selectedExercise->difficulty) }}
                                </span>
                                <span class="text-muted small">
                                    {{ $selectedExercise->equipment_category ?? 'No Category' }}
                                </span>
                                @if($selectedExercise->equipment_needed)
                                    <span class="text-muted small">•</span>
                                    <span class="text-muted small">
                                        {{ $selectedExercise->equipment_needed }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="modal-body">
                        {{-- Media Section --}}
                        <div class="ratio ratio-16x9 bg-light rounded mb-4">
                            @if ($selectedExercise->image_url)
                                <img src="{{ $selectedExercise->image_url }}" 
                                     alt="{{ $selectedExercise->name }}"
                                     class="object-fit-cover rounded">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light rounded">
                                    <div class="text-center">
                                        <i class="fas fa-image text-muted mb-2" style="font-size: 3rem;"></i>
                                        <p class="text-muted mb-0">No image available</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Stats Grid --}}
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-3">
                                <div class="bg-primary bg-opacity-10 rounded p-3 text-center">
                                    <i class="fas fa-bullseye text-primary fs-4 mb-2"></i>
                                    <div class="small text-muted">Target Muscles</div>
                                    <div class="fw-medium text-dark">
                                        {{ is_array($selectedExercise->muscle_groups) ? count($selectedExercise->muscle_groups) : 0 }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="bg-success bg-opacity-10 rounded p-3 text-center">
                                    <i class="fas fa-dumbbell text-success fs-4 mb-2"></i>
                                    <div class="small text-muted">Equipment</div>
                                    <div class="fw-medium text-dark" style="font-size: 0.85rem;">
                                        {{ $selectedExercise->equipment_needed ?? 'None' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="bg-warning bg-opacity-10 rounded p-3 text-center">
                                    <i class="fas fa-layer-group text-warning fs-4 mb-2"></i>
                                    <div class="small text-muted">Category</div>
                                    <div class="fw-medium text-dark" style="font-size: 0.85rem;">
                                        {{ ucfirst($selectedExercise->equipment_category ?? 'General') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="bg-info bg-opacity-10 rounded p-3 text-center">
                                    <i class="fas fa-chart-line text-info fs-4 mb-2"></i>
                                    <div class="small text-muted">Level</div>
                                    <div class="fw-medium text-dark">
                                        {{ $this->getDifficultyLabel($selectedExercise->difficulty) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        @if($selectedExercise->description)
                            <div class="mb-4">
                                <h5 class="fw-semibold text-dark mb-3">Description</h5>
                                <p class="text-muted lh-lg">
                                    {{ $selectedExercise->description }}
                                </p>
                            </div>
                        @endif

                        {{-- Target Muscles --}}
                        <div class="mb-4">
                            <h5 class="fw-semibold text-dark mb-3">Target Muscle Groups</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @if (is_array($selectedExercise->muscle_groups) && count($selectedExercise->muscle_groups) > 0)
                                    @foreach ($selectedExercise->muscle_groups as $muscle)
                                        <span class="badge bg-secondary">{{ $muscle }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">None specified</span>
                                @endif
                            </div>
                        </div>

                        {{-- Instructions --}}
                        @if($selectedExercise->instructions)
                            <div class="mb-4">
                                <h5 class="fw-semibold text-dark mb-3">Instructions</h5>
                                <div class="lh-lg">
                                    {!! nl2br(e($selectedExercise->instructions)) !!}
                                </div>
                            </div>
                        @endif

                        {{-- Equipment Details --}}
                        @if($selectedExercise->equipment_needed)
                            <div class="mb-4">
                                <h5 class="fw-semibold text-dark mb-3">Equipment Needed</h5>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    {{ $selectedExercise->equipment_needed }}
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Modal Footer --}}
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" wire:click="closeModal">
                            <i class="fas fa-times me-2"></i>Close
                        </button>
                        <button type="button" 
                                class="btn btn-primary" 
                                wire:click="addToMenu({{ $selectedExercise->id }})"
                                wire:loading.attr="disabled"
                                wire:target="addToMenu({{ $selectedExercise->id }})">
                            <span wire:loading.remove wire:target="addToMenu({{ $selectedExercise->id }})">
                                <i class="fas fa-plus me-2"></i>Add to Menu
                            </span>
                            <span wire:loading wire:target="addToMenu({{ $selectedExercise->id }})">
                                <i class="fas fa-spinner fa-spin me-2"></i>Adding...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Success/Error Messages --}}
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- JavaScript for UI Enhancement --}}
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Livewireイベントをリッスンして入力フィールドをクリア
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
                const sort = document.getElementById('sortBy');
                if (category) category.value = 'all';
                if (difficulty) difficulty.value = 'all';
                if (sort) sort.value = 'name';
            });

            // エクササイズ追加イベントのリスナー（親コンポーネント用）
            Livewire.on('exerciseAdded', (data) => {
                console.log('Exercise added:', data);
                // ここで親コンポーネントの処理を追加可能
            });
        });

        // モーダル外クリックで閉じる機能
        document.addEventListener('click', function(event) {
            const modal = document.querySelector('.modal.show');
            if (modal && event.target === modal) {
                @this.closeModal();
            }
        });
    </script>
</div>