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
                <div class="card border exercise-card w-100" draggable="true" data-exercise="{{ $exercise->name }}">
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

                                        $difficultyLabel = '初級';
                                        if ($exercise->difficulty === 'intermediate') {
                                            $difficultyLabel = '中級';
                                        } elseif ($exercise->difficulty === 'advanced') {
                                            $difficultyLabel = '上級';
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
                    <p>エクササイズが見つかりません</p>
                </div>
            @endforelse
        </div>
    </div>
</div>