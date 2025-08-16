{{-- 
テンプレート詳細モーダルコンポーネント
用途: トレーニングテンプレートの詳細情報を表示するモーダル
制約: 完全に静的なHTML、Bootstrap 5.3のみ、JavaScript使用禁止
注意: 実際の動的機能（タブ切り替え、画像スライダー、モーダル開閉等）はJavaScriptで実装が必要
--}}

{{-- モーダルバックドロップ --}}
<div class="modal fade" id="templateDetailsModal" tabindex="-1" aria-labelledby="templateDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow-lg">
            {{-- ヘッダー --}}
            <div class="modal-header border-bottom p-4">
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-3">
                            <h2 class="modal-title fs-3 fw-bold text-dark mb-0" id="templateDetailsModalLabel">
                                @if (isset($template))
                                    {{ $template->name }}
                                @else
                                    Template Details
                                @endif
                            </h2>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-medium">
                                @if (isset($template))
                                    {{ ucfirst($template->difficulty) }}
                                @else
                                    Intermediate
                                @endif
                            </span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <p class="text-muted mb-3">
                        @if (isset($template))
                            {{ $template->description }}
                        @else
                            Template description will be displayed here.
                        @endif
                    </p>
                    <div class="d-flex align-items-center gap-4 small text-muted">
                        <div class="d-flex align-items-center gap-1">
                            <i class="fas fa-calendar"></i>
                            <span>
                                @if (isset($template) && isset($template->created_at))
                                    Created: {{ $template->created_at->format('F j, Y') }}
                                @else
                                    Created: {{ date('F j, Y') }}
                                @endif
                            </span>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <i class="fas fa-globe text-success"></i>
                            <span class="text-success">
                                @if (isset($template))
                                    {{ $template->is_active ? 'Public' : 'Private' }}
                                @else
                                    Public
                                @endif
                            </span>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <i class="fa-solid fa-dumbbell"></i>
                            <span>
                                @if (isset($template) && isset($template->templateExercises))
                                    {{ $template->templateExercises->count() }}
                                @else
                                    0
                                @endif
                                {{ isset($template) && isset($template->templateExercises) && $template->templateExercises->count() == 1 ? 'exercise' : 'exercises' }}
                            </span>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <i class="fa-solid fa-clock"></i>
                            <span id="templateEstimatedTime">
                                @if (isset($template) && isset($template->estimated_duration))
                                    {{ $template->estimated_duration }}
                                @else
                                    0
                                @endif
                                min
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- タブナビゲーション --}}
            <div class="px-4 pt-4 mb-3">
                <!-- 動的化時はJavaScriptでタブ切り替え制御が必要 -->
                {{-- タブナビゲーション --}}
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
                    {{-- 将来実装 --}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link px-4 py-3" id="reviews-tab" data-bs-toggle="tab"
                            data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews"
                            aria-selected="false">
                            Reviews
                        </button>
                    </li>
                </ul>
            </div>

            {{-- タブコンテンツ --}}
            <div class="modal-body">
                <div class="tab-content" id="templateTabContent">

                    {{-- 概要タブ --}}
                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                        aria-labelledby="overview-tab">

                        {{-- テンプレート画像表示（もし画像があれば） --}}
                        @if (isset($template) && isset($template->image_path) && !empty($template->image_path))
                            <div class="mb-4 text-center">
                                <img src="{{ asset('storage/' . $template->image_path) }}" alt="{{ $template->name }}"
                                    class="img-fluid rounded-3" style="max-height: 200px; object-fit: contain;">
                            </div>
                        @endif

                        {{-- 統計グリッド --}}
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-4">
                                <div class="bg-primary bg-opacity-10 rounded-3 p-3 text-center">
                                    <i class="fas fa-clock text-primary fs-4 mb-2"></i>
                                    <div class="fs-3 fw-bold text-primary">
                                        @if (isset($template) && isset($template->estimated_duration))
                                            {{ $template->estimated_duration }}
                                        @else
                                            0
                                        @endif
                                    </div>
                                    <div class="small text-muted">min</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                                    <i class="fas fa-bullseye text-success fs-4 mb-2"></i>
                                    <div class="fs-3 fw-bold text-success">
                                        @if (isset($template) && isset($template->templateExercises))
                                            {{ $template->templateExercises->count() }}
                                        @else
                                            0
                                        @endif
                                    </div>
                                    <div class="small text-muted">exercises</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="bg-info bg-opacity-10 rounded-3 p-3 text-center">
                                    <i class="fas fa-star text-info fs-4 mb-2"></i>
                                    <div class="fs-3 fw-bold text-info">
                                        @if (isset($template) && isset($template->difficulty))
                                            {{ ucfirst($template->difficulty) }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                    <div class="small text-muted">difficulty</div>
                                </div>
                            </div>
                        </div>

                        {{-- テンプレート情報 --}}
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <h3 class="fs-5 fw-semibold text-dark mb-3">Target Muscle Groups</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    @if (isset($template) &&
                                            isset($template->muscle_groups) &&
                                            is_array($template->muscle_groups) &&
                                            count($template->muscle_groups) > 0)
                                        @foreach ($template->muscle_groups as $muscleGroup)
                                            <span
                                                class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">{{ $muscleGroup }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-light text-muted px-3 py-2 rounded-pill">None
                                            selected</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h3 class="fs-5 fw-semibold text-dark mb-3">Equipment Needed</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    @if (isset($template) &&
                                            isset($template->equipment_needed) &&
                                            is_array($template->equipment_needed) &&
                                            count($template->equipment_needed) > 0)
                                        @foreach ($template->equipment_needed as $equipment)
                                            <span
                                                class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">{{ $equipment }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-light text-muted px-3 py-2 rounded-pill">None
                                            selected</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- エクササイズタブ --}}
                    <div class="tab-pane fade" id="exercises" role="tabpanel" aria-labelledby="exercises-tab">
                        <div class="p-4">
                            <div class="d-flex flex-column gap-3">
                                @if (isset($template) && isset($template->templateExercises) && $template->templateExercises->count() > 0)
                                    @foreach ($template->templateExercises as $index => $templateExercise)
                                        {{-- エクササイズアイテム --}}
                                        <div class="border rounded-3 hover-shadow mb-3" x-data="{ expanded: false }">
                                            <div class="p-3" @click="expanded = !expanded"
                                                style="cursor: pointer;">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div
                                                            class="badge bg-primary text-white px-3 py-2 rounded-pill fw-medium">
                                                            {{ $index + 1 }}
                                                        </div>

                                                        <div>
                                                            <h4 class="fw-semibold text-dark mb-1">
                                                                {{ $templateExercise->exercise->name ?? 'Exercise Name' }}
                                                            </h4>
                                                            <div
                                                                class="d-flex align-items-center gap-3 small text-muted">
                                                                <span>{{ $templateExercise->sets ?? 0 }} sets</span>
                                                                <span>{{ $templateExercise->reps ?? 0 }} reps</span>
                                                                @if (isset($templateExercise->weight) && $templateExercise->weight > 0)
                                                                    <span>{{ $templateExercise->weight }}kg</span>
                                                                @endif
                                                                <span>{{ $templateExercise->rest_seconds ?? 0 }}s
                                                                    rest</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span
                                                            class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill small fw-medium">
                                                            {{ ucfirst($templateExercise->exercise->difficulty ?? 'Intermediate') }}
                                                        </span>
                                                        <i class="fas fa-chevron-down text-muted transition-transform duration-200"
                                                            :class="{ 'rotate-180': expanded }"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- エクササイズ詳細（折りたたみ） --}}
                                            <div x-show="expanded"
                                                x-transition:enter="transition-all duration-300 ease-out"
                                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                                x-transition:leave="transition-all duration-200 ease-in"
                                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                                x-transition:leave-end="opacity-0 transform -translate-y-2"
                                                class="mt-3 pt-3 border-top mx-3">
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-6">
                                                        <h5 class="fw-medium text-dark mb-2">Target Muscle Groups</h5>
                                                        <div class="d-flex flex-wrap gap-1 mb-3">
                                                            @if (isset($templateExercise->exercise->muscle_groups) &&
                                                                    is_array($templateExercise->exercise->muscle_groups) &&
                                                                    count($templateExercise->exercise->muscle_groups) > 0)
                                                                @foreach ($templateExercise->exercise->muscle_groups as $muscleGroup)
                                                                    <span
                                                                        class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">{{ $muscleGroup }}</span>
                                                                @endforeach
                                                            @else
                                                                <span
                                                                    class="badge bg-light text-muted px-2 py-1 rounded-pill small">None
                                                                    specified</span>
                                                            @endif
                                                        </div>
                                                        <div class="small text-muted">
                                                            <span class="fw-medium">Equipment:</span>
                                                            {{ $templateExercise->exercise->equipment_needed ?? 'None' }}
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- 実行手順 --}}
                                                <div class="mb-3">
                                                    <h5 class="fw-medium text-dark mb-2">Instructions</h5>
                                                    @if (isset($templateExercise->exercise->instructions) && !empty($templateExercise->exercise->instructions))
                                                        <p class="small text-dark">
                                                            {{ $templateExercise->exercise->instructions }}</p>
                                                    @else
                                                        <p class="text-muted small">No instructions provided.</p>
                                                    @endif
                                                </div>
                                            </div>
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
                    </div>

                    {{-- レビュータブ（将来実装用） --}}
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="text-center py-5">
                            <i class="fas fa-star text-muted mb-4" style="font-size: 4rem;"></i>
                            <h3 class="fs-5 fw-semibold text-dark mb-2">Reviews</h3>
                            <p class="text-muted">Review feature will be added in a future update.</p>
                        </div>
                    </div>
                    {{-- テンプレート画像表示 --}}
                    @if (isset($template) && isset($template->image_path) && !empty($template->image_path))
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $template->image_path) }}" alt="{{ $template->name }}"
                                class="img-fluid rounded-3" style="max-height: 200px; object-fit: contain;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
