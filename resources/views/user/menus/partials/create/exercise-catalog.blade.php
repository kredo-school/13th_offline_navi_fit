{{-- resources/views/user/menus/partials/create/exercise-catalog.blade.php --}}
<div class="card border-0 shadow-sm h-100 d-flex flex-column">
    <div class="card-header bg-white border-bottom">
        <h6 class="card-title mb-1">エクササイズカタログ</h6>
        <small class="text-muted">クリックまたはドラッグして追加</small>
    </div>

    {{-- Filters --}}
    <div class="card-body border-bottom pb-2">
        <div class="d-flex flex-column gap-2">
            {{-- Search --}}
            <div class="position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" class="form-control form-control-sm ps-5" placeholder="種目を検索..."
                    id="exerciseSearch">
            </div>

            {{-- Category Filter --}}
            <select class="form-select form-select-sm" id="categoryFilter">
                <option value="all">全カテゴリ</option>
                <option value="胸">胸</option>
                <option value="背中">背中</option>
                <option value="脚">脚</option>
                <option value="肩">肩</option>
                <option value="腕">腕</option>
                <option value="コア">コア</option>
                <option value="全身">全身</option>
            </select>

            {{-- Difficulty Filter --}}
            <select class="form-select form-select-sm" id="difficultyFilter">
                <option value="all">全レベル</option>
                <option value="beginner">初級</option>
                <option value="intermediate">中級</option>
                <option value="advanced">上級</option>
            </select>

            {{-- Sort --}}
            <select class="form-select form-select-sm" id="sortBy">
                <option value="name">名前順</option>
                <option value="category">カテゴリ順</option>
                <option value="difficulty">難易度順</option>
            </select>
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
                                        $difficultyLabel = '初級';
                                        if ($exercise->difficulty === 'intermediate') {
                                            $badgeClass = 'bg-warning text-dark';
                                            $difficultyLabel = '中級';
                                        } elseif ($exercise->difficulty === 'advanced') {
                                            $badgeClass = 'bg-danger';
                                            $difficultyLabel = '上級';
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
                                        <i class="bi bi-eye me-1"></i>詳細
                                    </button>
                                    
                                    {{-- メニューに追加ボタン --}}
                                    <button type="button" 
                                            class="btn btn-primary btn-sm flex-fill add-exercise-btn"
                                            data-exercise-id="{{ $exercise->id }}"
                                            data-exercise-name="{{ $exercise->name }}"
                                            style="font-size: 0.75rem;">
                                        <i class="bi bi-plus-lg me-1"></i>追加
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
                    <i class="bi bi-clipboard-x display-6 text-muted mb-2"></i>
                    <p>エクササイズが見つかりません</p>
                </div>
            @endforelse
        </div>
    </div>
</div>