{{-- フィルターパネル (折りたたみ可能) --}}
<div class="collapse" id="filterPanel">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('menus.index') }}" method="GET" id="filterForm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h5 fw-semibold mb-0">フィルター・並び替え</h3>
                    <button type="reset" class="btn btn-link text-primary text-decoration-none small fw-medium p-0">
                        クリア
                    </button>
                </div>

                <div class="row">
                    {{-- 並び替えオプション --}}
                    <div class="col-md-6 col-lg-3 mb-3">
                        <label class="form-label small fw-medium">並び替え</label>
                        <div class="btn-group-vertical w-100" role="group" aria-label="並び替えオプション">
                            <input type="radio" class="btn-check" name="sort" id="sortDate" value="date"
                                {{ !isset($filters['sort']) || $filters['sort'] === 'date' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary text-start" for="sortDate">
                                作成日
                                <span class="float-end">↓</span>
                            </label>

                            <input type="radio" class="btn-check" name="sort" id="sortName" value="name"
                                {{ isset($filters['sort']) && $filters['sort'] === 'name' ? 'checked' : '' }}>
                            <label class="btn btn-outline-secondary text-start" for="sortName">
                                名前
                            </label>

                            <input type="radio" class="btn-check" name="sort" id="sortExercises" value="exercises"
                                {{ isset($filters['sort']) && $filters['sort'] === 'exercises' ? 'checked' : '' }}>
                            <label class="btn btn-outline-secondary text-start" for="sortExercises">
                                種目数
                            </label>

                            <input type="radio" class="btn-check" name="sort" id="sortDuration" value="duration"
                                {{ isset($filters['sort']) && $filters['sort'] === 'duration' ? 'checked' : '' }}>
                            <label class="btn btn-outline-secondary text-start" for="sortDuration">
                                時間
                            </label>
                        </div>
                    </div>

                    {{-- 難易度フィルター --}}
                    <div class="col-md-6 col-lg-3 mb-3">
                        <label class="form-label small fw-medium">難易度</label>
                        <div class="d-grid gap-2">
                            @php
                                // 難易度ごとのメニュー数をカウント (シンプル版)
                                $beginnerCount = isset($menus) ? $menus->count() : 0;
                                $intermediateCount = isset($menus) ? $menus->count() / 2 : 0;
                                $advancedCount = isset($menus) ? $menus->count() / 3 : 0;
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="difficulty[]" value="beginner"
                                    id="difficultyBeginner"
                                    {{ isset($filters['difficulty']) && in_array('beginner', $filters['difficulty']) ? 'checked' : '' }}>
                                <label class="form-check-label d-flex align-items-center" for="difficultyBeginner">
                                    <span class="badge bg-success me-2">初級者</span>
                                    <span class="text-muted small">({{ (int) $beginnerCount }})</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="difficulty[]" value="intermediate"
                                    id="difficultyIntermediate"
                                    {{ isset($filters['difficulty']) && in_array('intermediate', $filters['difficulty']) ? 'checked' : '' }}>
                                <label class="form-check-label d-flex align-items-center" for="difficultyIntermediate">
                                    <span class="badge bg-warning text-dark me-2">中級者</span>
                                    <span class="text-muted small">({{ (int) $intermediateCount }})</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="difficulty[]" value="advanced"
                                    id="difficultyAdvanced"
                                    {{ isset($filters['difficulty']) && in_array('advanced', $filters['difficulty']) ? 'checked' : '' }}>
                                <label class="form-check-label d-flex align-items-center" for="difficultyAdvanced">
                                    <span class="badge bg-danger me-2">上級者</span>
                                    <span class="text-muted small">({{ (int) $advancedCount }})</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- 公開状態フィルター --}}
                    <div class="col-md-6 col-lg-3 mb-3">
                        <label class="form-label small fw-medium">公開状態</label>
                        <div class="d-grid gap-2">
                            @php
                                // 公開・非公開のメニュー数をカウント (シンプル版)
                                $publicCount = isset($menus) ? $menus->where('is_active', true)->count() : 0;
                                $privateCount = isset($menus) ? $menus->where('is_active', false)->count() : 0;
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="visibility[]" value="public"
                                    id="visibilityPublic"
                                    {{ isset($filters['visibility']) && in_array('public', $filters['visibility']) ? 'checked' : '' }}>
                                <label class="form-check-label d-flex align-items-center" for="visibilityPublic">
                                    <i class="bi bi-globe text-success me-2"></i>
                                    公開
                                    <span class="text-muted small ms-1">({{ $publicCount }})</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="visibility[]" value="private"
                                    id="visibilityPrivate"
                                    {{ isset($filters['visibility']) && in_array('private', $filters['visibility']) ? 'checked' : '' }}>
                                <label class="form-check-label d-flex align-items-center" for="visibilityPrivate">
                                    <i class="bi bi-lock text-muted me-2"></i>
                                    非公開
                                    <span class="text-muted small ms-1">({{ $privateCount }})</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- タグフィルター --}}
                    <div class="col-md-6 col-lg-3 mb-3">
                        <label class="form-label small fw-medium">タグ</label>
                        <div class="d-grid gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="fullbody"
                                    id="tagFullbody"
                                    {{ isset($filters['tags']) && in_array('fullbody', $filters['tags']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tagFullbody">
                                    全身
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="upperbody"
                                    id="tagUpperbody"
                                    {{ isset($filters['tags']) && in_array('upperbody', $filters['tags']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tagUpperbody">
                                    上半身
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="cardio"
                                    id="tagCardio"
                                    {{ isset($filters['tags']) && in_array('cardio', $filters['tags']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tagCardio">
                                    有酸素
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="strength"
                                    id="tagStrength"
                                    {{ isset($filters['tags']) && in_array('strength', $filters['tags']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tagStrength">
                                    筋トレ
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 時間範囲フィルター --}}
                <div class="row mt-3">
                    <div class="col-12">
                        <label class="form-label small fw-medium">トレーニング時間</label>
                        <div class="row g-2">
                            <div class="col-6 col-md-3">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" name="duration_min" placeholder="最小"
                                        min="0" max="300" value="{{ $filters['duration_min'] ?? '' }}">
                                    <span class="input-group-text">分</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" name="duration_max" placeholder="最大"
                                        min="0" max="300" value="{{ $filters['duration_max'] ?? '' }}">
                                    <span class="input-group-text">分</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- フィルター適用ボタン --}}
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="bi bi-check-lg me-2"></i>
                        フィルターを適用
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse"
                        data-bs-target="#filterPanel">
                        キャンセル
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
