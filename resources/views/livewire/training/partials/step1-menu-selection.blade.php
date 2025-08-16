<div class="space-y-4">
    {{-- Header --}}
    <div class="text-center mb-4">
        <h2 class="h3 fw-bold text-dark mb-2">
            トレーニングメニューを選択
        </h2>
        <p class="text-muted">
            今日のワークアウトに使用するメニューを選んでください
        </p>
    </div>

    {{-- Search and Filters --}}
    <div class="card border-1 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-12 col-lg-6">
                    <div class="position-relative">
                        <i class="fas fa-search position-absolute top-50 translate-middle-y text-muted" 
                           style="left: 12px;"></i>
                        <input type="text" 
                               wire:model.live.debounce.300ms="searchTerm"
                               class="form-control ps-5" 
                               placeholder="メニューを検索...">
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <select wire:model.live="selectedCategory" class="form-select">
                        <option value="all">全カテゴリ</option>
                        @foreach($this->categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <select wire:model.live="selectedDifficulty" class="form-select">
                        <option value="all">全レベル</option>
                        <option value="beginner">初心者</option>
                        <option value="intermediate">中級者</option>
                        <option value="advanced">上級者</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Grid --}}
    <div class="row g-4 mb-4">
        @forelse($this->menus as $menu)
            <div class="col-12 col-md-6 col-lg-4">
                <div wire:click="selectMenu({{ $menu->id }})"
                     class="card h-100 {{ $selectedMenuId === $menu->id ? 'border-primary border-3 shadow-lg' : 'border-1 shadow-sm' }}"
                     style="cursor: pointer; transition: all 0.3s ease;
                            {{ $selectedMenuId === $menu->id ? 'transform: scale(1.05);' : '' }}">
                    
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold text-dark mb-2">
                            {{ $menu->name }}
                        </h5>
                        
                        <div class="mb-3">
                            <small class="text-muted">
                                {{ $menu->menuExercises->count() }}種目
                            </small>
                        </div>
                        
                        {{-- エクササイズリスト --}}
                        <div class="mb-3">
                            @foreach($menu->menuExercises->take(3) as $menuExercise)
                                <div class="small text-muted">
                                    • {{ $menuExercise->exercise->name }}
                                </div>
                            @endforeach
                            @if($menu->menuExercises->count() > 3)
                                <div class="small text-muted">
                                    他{{ $menu->menuExercises->count() - 3 }}種目
                                </div>
                            @endif
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center text-muted small">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock me-1"></i>
                                <span>{{ $menu->estimated_duration }}分</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-dumbbell me-1"></i>
                                <span>{{ $menu->menuExercises->count() }}種目</span>
                            </div>
                        </div>
                        
                        @if($selectedMenuId === $menu->id)
                            <div class="mt-3 text-center">
                                <span class="badge bg-primary">
                                    <i class="fas fa-check me-1"></i>選択中
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">メニューが見つかりません</h4>
                    <p class="text-muted">検索条件を変更するか、新しいメニューを作成してください。</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Next Button --}}
    <div class="d-flex justify-content-end pt-4">
        <button wire:click="goToStep2" 
                type="button" 
                class="btn btn-primary btn-lg px-4 shadow-lg"
                @if(!$selectedMenuId) disabled @endif>
            <span>次へ進む</span>
        </button>
    </div>
</div>