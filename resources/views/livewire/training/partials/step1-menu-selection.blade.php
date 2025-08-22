<div class="space-y-4">
    {{-- Header --}}
    {{-- <div class="text-center mb-4">
        <h2 class="h3 fw-bold text-dark mb-2">
            トレーニングメニューを選択
        </h2>
        <p class="text-muted">
            今日のワークアウトに使用するメニューを選んでください
        </p>
    </div> --}}

    {{-- Search and Filters --}}
    <div class="card border-1 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-12 col-lg-6">
                    <div class="position-relative">
                        <i class="fas fa-search position-absolute top-50 translate-middle-y text-muted"
                            style="left: 12px;"></i>
                        <input type="text" wire:model.live.debounce.300ms="searchTerm" class="form-control ps-5"
                            placeholder="Search for your workout plan"...">
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <select wire:model.live="selectedCategory" class="form-select">
                        <option value="all">All Categories</option>
                        @foreach ($this->categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-3 d-flex align-items-end">
                    {{-- Next Button --}}
                    <button wire:click="goToStep2" type="button"
                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                        style="height: 38px; font-weight: 500;" @if (!$selectedMenuId) disabled @endif>
                        <i class="fas fa-arrow-right me-2"></i>
                        <span>Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Grid --}}
    <div class="row g-4 mb-4">
        @forelse($this->menus as $menu)
            <div class="col-12 col-md-6 col-lg-4" wire:key="menu-{{ $menu->id }}">
                <div wire:click="selectMenu({{ $menu->id }})"
                    class="card menu-card h-100 border-2 {{ $selectedMenuId === $menu->id ? 'border-primary shadow-lg' : 'border-light' }}"
                    style="cursor: pointer; border-radius: 0.75rem;
                        {{ $selectedMenuId === $menu->id ? 'transform: scale(1.05);' : '' }}">

                    {{-- Card Image/Header --}}
                    @php
                        // 新しいデフォルト画像の配列
                        $defaultImages = [
                            'templates/defaults/default1.jpg',
                            'templates/defaults/default2.jpg',
                            'templates/defaults/default3.jpg',
                            'templates/defaults/default4.jpg',
                            'templates/defaults/default5.jpg',
                            'templates/defaults/default6.jpg',
                            'templates/defaults/default7.jpg',
                        ];

                        // メニューIDに基づいて決定論的にランダムな画像を選択
                        $imageIndex = $menu->id % count($defaultImages);
                        $menuImage = $defaultImages[$imageIndex];
                    @endphp

                    <div class="position-relative overflow-hidden" style="border-radius: 0.75rem 0.75rem 0 0;">
                        <img src="{{ asset('storage/' . $menuImage) }}" class="w-100" alt="{{ $menu->name }}"
                            style="height: 200px; object-fit: cover;">
                    </div>

                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold text-dark mb-2" style="line-height: 1.4;">
                            {{ $menu->name }}
                        </h5>

                        {{-- Description placeholder - adjust height to match template --}}
                        <p class="text-muted small mb-3" style="min-height: 2.5rem; line-height: 1.4;">
                            {{ $menu->description ?? 'description' }}
                        </p>

                        {{-- Stats --}}
                        <div class="d-flex justify-content-between align-items-center text-muted small mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock me-1"></i>
                                <span>{{ $menu->estimated_duration }}min</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-dumbbell me-1"></i>
                                <span>{{ $menu->menuExercises->count() }}
                                    {{ $menu->menuExercises->count() === 1 ? 'exercise' : 'exercises' }}</span>
                            </div>
                        </div>

                        {{-- Exercise List as Tags --}}
                        <div class="d-flex flex-wrap gap-1">
                            @foreach ($menu->menuExercises->take(3) as $index => $menuExercise)
                                <span class="badge bg-light text-dark small px-2 py-1">
                                    {{ $menuExercise->exercise->name }}
                                </span>
                            @endforeach
                            @if ($menu->menuExercises->count() > 3)
                                <span class="badge bg-light text-muted small px-2 py-1">
                                    +{{ $menu->menuExercises->count() - 3 }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5" style="padding: 4rem 0;">
                    <i class="fas fa-filter fa-4x text-muted mb-4"></i>
                    <h4 class="text-dark fw-semibold mb-2">No menus match your search criteria</h4>
                    <p class="text-muted">Try changing your search keywords or filters</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Next Button --}}
    {{-- <div class="d-flex justify-content-end pt-4">
        <button wire:click="goToStep2" type="button" class="btn btn-primary btn-lg px-4 shadow-lg" @if (!$selectedMenuId) disabled @endif>
            <span>次へ進む</span>
        </button>
    </div> --}}
</div>

<style>
    .menu-card {
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .menu-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--bs-box-shadow) !important;
    }

    .menu-card .badge {
        font-weight: 500;
    }
</style>
