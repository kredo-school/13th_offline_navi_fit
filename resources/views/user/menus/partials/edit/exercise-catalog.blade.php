{{-- resources/views/user/menus/partials/edit/exercise-catalog.blade.php --}}
<div class="card border-0 shadow-sm h-100 d-flex flex-column">
    <div class="card-header bg-white border-bottom">
        <h6 class="card-title mb-1">Exercise Catalog</h6>
        <small class="text-muted">Click or drag to add</small>
    </div>

    {{-- Filters --}}
    <div class="card-body border-bottom">
        <div class="d-flex flex-column gap-2">
            {{-- Search --}}
            <div class="position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" class="form-control form-control-sm ps-5" placeholder="Search exercises..."
                    id="exerciseSearch">
            </div>

            {{-- Category Filter --}}
            <select class="form-select form-select-sm" id="categoryFilter">
                <option value="all">All Categories</option>
                @if (isset($exercisesByCategory))
                    @foreach ($exercisesByCategory->keys() as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                @endif
            </select>

            {{-- Difficulty Filter --}}
            <select class="form-select form-select-sm" id="difficultyFilter">
                <option value="all">All Levels</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>

            {{-- Sort --}}
            <select class="form-select form-select-sm" id="sortBy">
                <option value="name">By Name</option>
                <option value="category">By Category</option>
                <option value="difficulty">By Difficulty</option>
            </select>
        </div>
    </div>

    {{-- Exercise Grid --}}
    <div class="flex-fill overflow-auto p-0">
        <div class="d-flex flex-column gap-2 p-3 exercise-catalog-container">
            @forelse($exercises ?? [] as $exercise)
                <div class="card border exercise-card w-100" draggable="true" data-exercise="{{ $exercise->name }}"
                    data-exercise-id="{{ $exercise->id }}">
                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="pe-2">
                                <h6 class="card-title mb-1" style="font-size: 0.9rem;">{{ $exercise->name }}</h6>
                                <p class="text-muted mb-2" style="font-size: 0.8rem;">
                                    {{ isset($exercise->muscle_groups[0]) ? $exercise->muscle_groups[0] : '' }} •
                                    {{ $exercise->equipment_category }}
                                </p>
                                <div class="d-flex align-items-center mb-2">
                                    @php
                                        $badgeClass = 'bg-success';
                                        if ($exercise->difficulty === 'intermediate') {
                                            $badgeClass = 'bg-warning text-dark';
                                        } elseif ($exercise->difficulty === 'advanced') {
                                            $badgeClass = 'bg-danger';
                                        }

                                        $difficultyLabel = 'Beginner';
                                        if ($exercise->difficulty === 'intermediate') {
                                            $difficultyLabel = 'Intermediate';
                                        } elseif ($exercise->difficulty === 'advanced') {
                                            $difficultyLabel = 'Advanced';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $difficultyLabel }}</span>
                                </div>

                                {{-- Muscle Groups --}}
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach ($exercise->muscle_groups ?? [] as $muscleGroup)
                                        <span class="badge bg-light text-dark"
                                            style="font-size: 0.7rem;">{{ $muscleGroup }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <img src="{{ $exercise->image_url ?? asset('images/navifit_icon.jpg') }}"
                                class="rounded ms-auto" alt="{{ $exercise->name }}"
                                style="width: 70px; height: 70px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-clipboard-x display-6 text-muted mb-2"></i>
                    <p>No exercises found</p>
                </div>
            @endforelse
        </div>

        {{-- Empty State --}}
        <div class="text-center py-4 text-muted d-none" id="emptyExerciseState">
            <i class="bi bi-funnel display-6 text-muted mb-2"></i>
            <p class="small">No matching exercises found</p>
        </div>
    </div>
</div>
