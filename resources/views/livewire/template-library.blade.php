{{-- resources/views/livewire/template-library.blade.php --}}
<div>
    <div class="card border-0 shadow-sm h-100 d-flex flex-column">
        <div class="card-header bg-white border-bottom">
            <h6 class="card-title mb-1">Template Library</h6>
            <small class="text-muted">Click to view details</small>
        </div>

        <div class="card-body flex-fill overflow-auto p-4 template-library-container">
            {{-- Loading State --}}
            {{-- <div wire:loading.delay class="text-center py-4">
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <small class="text-muted d-block mt-2">Loading templates...</small>
            </div> --}}

            <div class="d-flex flex-column gap-3" wire:loading.remove.delay>
                @forelse($templates as $template)
                    <div class="card border template-card" draggable="true">
                        <div class="position-relative">
                            <img src="{{ $this->getThumbnailUrl($template) }}"
                                class="card-img-top" alt="{{ $template->name }}" 
                                style="height: 120px; object-fit: cover;"
                                loading="lazy">
                            {{-- 難易度バッジ --}}
                            {{-- <span class="badge {{ $this->getDifficultyBadgeClass($template->difficulty) }} position-absolute top-0 end-0 m-1"
                                style="font-size: 0.75rem;">
                                {{ $this->getDifficultyLabel($template->difficulty) }}
                            </span> --}}
                        </div>

                        <div class="card-body p-3">
                            <h6 class="card-title mb-1" style="font-size: 0.95rem;">{{ $template->name }}</h6>
                            {{-- <p class="card-text text-muted mb-2" style="font-size: 0.8rem;">
                                {{ Str::limit($template->description ?? 'No description available', 80) }}
                            </p> --}}

                            {{-- Creator Info --}}
                            @if($template->creator)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-user-circle me-1 text-muted" style="font-size: 0.8rem;"></i>
                                    <span class="text-muted" style="font-size: 0.75rem;">
                                        by Admin 
                                        {{-- by {{ $template->creator->name }} --}}
                                    </span>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa-regular fa-clock me-1" style="font-size: 0.8rem;"></i>
                                    <span style="font-size: 0.8rem;">{{ $this->getEstimatedTime($template) }} min</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-bullseye me-1" style="font-size: 0.8rem;"></i>
                                    <span style="font-size: 0.8rem;">
                                        {{ $template->templateExercises?->count() ?? 0 }} exercises
                                    </span>
                                </div>
                            </div>

                            {{-- Additional Stats --}}
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-fire me-1 text-warning" style="font-size: 0.8rem;"></i>
                                    <span style="font-size: 0.8rem;">{{ $this->getEstimatedCalories($template) }} kcal</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star me-1 text-warning" style="font-size: 0.8rem;"></i>
                                    <span style="font-size: 0.8rem;">{{ $this->getTemplateRating($template) }}</span>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="button" 
                                        class="btn btn-outline-primary btn-sm flex-fill"
                                        style="font-size: 0.8rem;" 
                                        wire:click="showTemplateDetails({{ $template->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="showTemplateDetails({{ $template->id }})">
                                    <span wire:loading.remove wire:target="showTemplateDetails({{ $template->id }})">
                                        <i class="fa-solid fa-eye me-1"></i>Details
                                    </span>
                                    <span wire:loading wire:target="showTemplateDetails({{ $template->id }})">
                                        <i class="fas fa-spinner fa-spin me-1"></i>Loading...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-clipboard-list display-6 text-muted mb-2"></i>
                        <p class="mb-0">No templates found</p>
                        <small class="text-muted">Templates will appear here when available</small>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Livewire Template Details Modal --}}
    @if($showModal && $selectedTemplate)
        <div class="modal fade show" 
             style="display: block; background-color: rgba(0,0,0,0.5);"
             tabindex="-1" 
             aria-labelledby="templateModalTitle" 
             aria-hidden="false">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content rounded-4 shadow-lg">
                    {{-- ヘッダー --}}
                    <div class="modal-header border-bottom p-4">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center gap-3">
                                    <h2 class="modal-title fs-3 fw-bold text-dark mb-0" id="templateModalTitle">
                                        {{ $selectedTemplate->name }}
                                    </h2>
                                    {{-- 難易度バッジ --}}
                                    {{-- <span class="badge {{ $this->getDifficultyBadgeClass($selectedTemplate->difficulty) }} bg-opacity-10 px-3 py-2 rounded-pill fw-medium">
                                        {{ $this->getDifficultyLabel($selectedTemplate->difficulty) }}
                                    </span> --}}
                                </div>
                                <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                            </div>
                            <p class="text-muted mb-3">
                                {{ $selectedTemplate->description ?? 'No description available.' }}
                            </p>
                            <div class="d-flex align-items-center gap-4 small text-muted">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fas fa-calendar"></i>
                                    <span>Created: {{ $selectedTemplate->created_at?->format('F j, Y') ?? date('F j, Y') }}</span>
                                </div>
                                {{-- @if($selectedTemplate->creator)
                                    <div class="d-flex align-items-center gap-1">
                                        <i class="fas fa-user"></i>
                                        <span>by {{ $selectedTemplate->creator->name }}</span>
                                    </div>
                                @endif --}}
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fas fa-globe text-success"></i>
                                    <span class="text-success">
                                        {{ $selectedTemplate->is_active ? 'Public' : 'Private' }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-dumbbell"></i>
                                    <span>
                                        {{ $selectedTemplate->templateExercises?->count() ?? 0 }}
                                        {{ ($selectedTemplate->templateExercises?->count() ?? 0) == 1 ? 'exercise' : 'exercises' }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-clock"></i>
                                    <span>{{ $this->getEstimatedTime($selectedTemplate) }} min</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- タブナビゲーション --}}
                    <div class="px-4 pt-4 mb-3">
                        <ul class="nav nav-tabs nav-fill border-0" id="templateDetailsTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active px-4 py-3" id="overview-tab" data-bs-toggle="tab"
                                    data-bs-target="#overview" type="button" role="tab" aria-controls="overview"
                                    aria-selected="true">
                                    Overview
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-4 py-3" id="exercises-tab" data-bs-toggle="tab"
                                    data-bs-target="#exercises" type="button" role="tab" aria-controls="exercises"
                                    aria-selected="false">
                                    Exercises
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-4 py-3" id="stats-tab" data-bs-toggle="tab"
                                    data-bs-target="#stats" type="button" role="tab" aria-controls="stats"
                                    aria-selected="false">
                                    Stats
                                </button>
                            </li>
                        </ul>
                    </div>

                    {{-- タブコンテンツ --}}
                    <div class="modal-body">
                        <div class="tab-content" id="templateTabContent">
                            {{-- 概要タブ --}}
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                {{-- 統計グリッド --}}
                                <div class="row g-3 mb-4">
                                    <div class="col-6 col-md-3">
                                        <div class="bg-primary bg-opacity-10 rounded-3 p-3 text-center">
                                            <i class="fas fa-clock text-primary fs-4 mb-2"></i>
                                            <div class="fs-3 fw-bold text-primary">
                                                {{ $this->getEstimatedTime($selectedTemplate) }}
                                            </div>
                                            <div class="small text-muted">min</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                                            <i class="fas fa-bullseye text-success fs-4 mb-2"></i>
                                            <div class="fs-3 fw-bold text-success">
                                                {{ $selectedTemplate->templateExercises?->count() ?? 0 }}
                                            </div>
                                            <div class="small text-muted">exercises</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="bg-warning bg-opacity-10 rounded-3 p-3 text-center">
                                            <i class="fas fa-fire text-warning fs-4 mb-2"></i>
                                            <div class="fs-3 fw-bold text-warning">
                                                {{ $this->getEstimatedCalories($selectedTemplate) }}
                                            </div>
                                            <div class="small text-muted">kcal</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="bg-info bg-opacity-10 rounded-3 p-3 text-center">
                                            <i class="fas fa-star text-info fs-4 mb-2"></i>
                                            <div class="fs-3 fw-bold text-info">
                                                {{ $this->getTemplateRating($selectedTemplate) }}
                                            </div>
                                            <div class="small text-muted">rating</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- テンプレート情報 --}}
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <h3 class="fs-5 fw-semibold text-dark mb-3">Target Muscle Groups</h3>
                                        <div class="d-flex flex-wrap gap-2">
                                            @php $muscleGroups = $this->getMuscleGroups($selectedTemplate); @endphp
                                            @if (count($muscleGroups) > 0)
                                                @foreach ($muscleGroups as $muscleGroup)
                                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                                        {{ $muscleGroup }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                                                    None specified
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h3 class="fs-5 fw-semibold text-dark mb-3">Equipment Needed</h3>
                                        <div class="d-flex flex-wrap gap-2">
                                            @php $equipment = $this->getEquipmentNeeded($selectedTemplate); @endphp
                                            @if (count($equipment) > 0)
                                                @foreach ($equipment as $item)
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                                        {{ ucfirst($item) }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                                                    Bodyweight only
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 作成者情報 --}}
                                {{-- @if($selectedTemplate->creator)
                                    <div class="bg-light rounded-3 p-4 mb-4">
                                        <h3 class="fs-5 fw-semibold text-dark mb-3">Created by</h3>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-user fs-4"></i>
                                            </div>
                                            <div>
                                                <h4 class="fw-semibold text-dark mb-1">{{ $selectedTemplate->creator->name }}</h4>
                                                <p class="text-muted mb-0 small">Template Creator</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif --}}
                            </div>

                            {{-- エクササイズタブ --}}
                            <div class="tab-pane fade" id="exercises" role="tabpanel" aria-labelledby="exercises-tab">
                                <div class="d-flex flex-column gap-3">
                                    @if ($selectedTemplate->templateExercises && $selectedTemplate->templateExercises->count() > 0)
                                        @foreach ($selectedTemplate->templateExercises as $index => $templateExercise)
                                            <div class="border rounded-3 p-3 hover-shadow">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="badge bg-primary text-white px-3 py-2 rounded-pill fw-medium">
                                                            {{ $index + 1 }}
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <h4 class="fw-semibold text-dark mb-1">
                                                                {{ $templateExercise->exercise?->name ?? 'Exercise Name' }}
                                                            </h4>
                                                            <div class="d-flex align-items-center gap-3 small text-muted">
                                                                <span>{{ $templateExercise->sets ?? 0 }} sets</span>
                                                                <span>{{ $templateExercise->reps ?? 0 }} reps</span>
                                                                @if (isset($templateExercise->weight) && $templateExercise->weight > 0)
                                                                    <span>{{ $templateExercise->weight }}kg</span>
                                                                @endif
                                                                <span>{{ $templateExercise->rest_seconds ?? 60 }}s rest</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        @if($templateExercise->exercise)
                                                            <span class="badge {{ $this->getDifficultyBadgeClass($templateExercise->exercise->difficulty) }} bg-opacity-10 px-2 py-1 rounded-pill small fw-medium">
                                                                {{ $this->getDifficultyLabel($templateExercise->exercise->difficulty) }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- エクササイズ詳細 --}}
                                                @if($templateExercise->exercise)
                                                    <div class="mt-3 pt-3 border-top">
                                                        <div class="row g-3 mb-3">
                                                            <div class="col-md-8">
                                                                <h5 class="fw-medium text-dark mb-2">Target Muscle Groups</h5>
                                                                <div class="d-flex flex-wrap gap-1 mb-3">
                                                                    @if (is_array($templateExercise->exercise->muscle_groups) && count($templateExercise->exercise->muscle_groups) > 0)
                                                                        @foreach ($templateExercise->exercise->muscle_groups as $muscleGroup)
                                                                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">
                                                                                {{ $muscleGroup }}
                                                                            </span>
                                                                        @endforeach
                                                                    @else
                                                                        <span class="badge bg-light text-muted px-2 py-1 rounded-pill small">
                                                                            None specified
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                {{-- <h5 class="fw-medium text-dark mb-2">Equipment</h5> --}}
                                                                <div class="small text-muted">
                                                                    <div class="mb-1">
                                                                        <span class="fw-medium">Category:</span>
                                                                        {{ ucfirst($templateExercise->exercise->muscle_groups[0] ?? 'Bodyweight') }}
                                                                    </div>
                                                                    @if($templateExercise->exercise->equipment_needed)
                                                                        <div>
                                                                            <span class="fw-medium">Equipment:</span>
                                                                            {{ $templateExercise->exercise->equipment_needed }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- 実行手順 --}}
                                                        @if($templateExercise->exercise->instructions)
                                                            <div class="mb-3">
                                                                <h5 class="fw-medium text-dark mb-2">Instructions</h5>
                                                                <p class="small text-dark">
                                                                    {!! nl2br(e($templateExercise->exercise->instructions)) !!}
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center py-5">
                                            <i class="fas fa-dumbbell text-muted mb-4" style="font-size: 4rem;"></i>
                                            <h3 class="fs-5 fw-semibold text-dark mb-2">No Exercises Found</h3>
                                            <p class="text-muted">This template does not contain any exercises yet.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- 統計タブ --}}
                            <div class="tab-pane fade" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="bg-light rounded-3 p-4">
                                            <h3 class="fs-5 fw-semibold text-dark mb-4">Workout Statistics</h3>
                                            <div class="row g-3 text-center">
                                                <div class="col-6">
                                                    <div class="fs-3 fw-bold text-primary">{{ $this->getTotalSets($selectedTemplate) }}</div>
                                                    <div class="small text-muted">Total Sets</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="fs-3 fw-bold text-success">{{ $selectedTemplate->templateExercises?->count() ?? 0 }}</div>
                                                    <div class="small text-muted">Exercises</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bg-light rounded-3 p-4">
                                            <h3 class="fs-5 fw-semibold text-dark mb-4">Usage Statistics</h3>
                                            <div class="row g-3 text-center">
                                                <div class="col-6">
                                                    <div class="fs-3 fw-bold text-warning">{{ $this->getPopularityScore($selectedTemplate) }}</div>
                                                    <div class="small text-muted">Times Used</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="fs-3 fw-bold text-info">{{ $this->getTemplateRating($selectedTemplate) }}</div>
                                                    <div class="small text-muted">User Rating</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" wire:click="closeModal">
                            <i class="fas fa-times me-2"></i>Close
                        </button>
                        <button type="button" 
                                class="btn btn-success" 
                                wire:click="createFromTemplate({{ $selectedTemplate->id }})"
                                wire:loading.attr="disabled"
                                wire:target="createFromTemplate({{ $selectedTemplate->id }})">
                            <span wire:loading.remove wire:target="createFromTemplate({{ $selectedTemplate->id }})">
                                <i class="fas fa-plus me-2"></i>Use This Template
                            </span>
                            <span wire:loading wire:target="createFromTemplate({{ $selectedTemplate->id }})">
                                <i class="fas fa-spinner fa-spin me-2"></i>Creating...
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
            // テンプレート選択イベントのリスナー（親コンポーネント用）
            Livewire.on('templateSelected', (data) => {
                console.log('Template selected:', data);
                // ここで親コンポーネントの処理を追加可能
                // 例: Basic Infoセクションにテンプレート名を設定
                // 例: Exercise Editorにテンプレートのエクササイズを追加
            });
        });

        // モーダル外クリックで閉じる機能
        document.addEventListener('click', function(event) {
            const modal = document.querySelector('.modal.show');
            if (modal && event.target === modal) {
                @this.closeModal();
            }
        });

        // ESCキーでモーダルを閉じる機能
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                @this.closeModal();
            }
        });
    </script>
</div>