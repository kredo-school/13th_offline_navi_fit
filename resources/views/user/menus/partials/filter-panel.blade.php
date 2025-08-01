{{-- フィルターパネル（サイドバー固定表示） --}}
<div class="card shadow-sm border-0 h-100">
    <div class="card-body p-3">
        <!-- 動的化時はroute('menus.index')に置換 -->
        <form action="#" method="GET" id="filterForm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h6 fw-semibold mb-0">フィルター・並び替え</h3>
                <button type="reset" class="btn btn-link text-primary text-decoration-none small fw-medium p-0">
                    クリア
                </button>
            </div>

            {{-- 並び替えオプション --}}
            <div class="mb-4">
                <label class="form-label small fw-medium text-muted">並び替え</label>
                <div class="btn-group-vertical w-100" role="group" aria-label="並び替えオプション">
                    <!-- 動的化時は条件分岐でchecked状態を制御 -->
                    <input type="radio" class="btn-check" name="sort" id="sortDate" value="date" checked>
                    <label class="btn btn-outline-primary text-start small" for="sortDate">
                        作成日
                        <span class="float-end">↓</span>
                    </label>

                    <input type="radio" class="btn-check" name="sort" id="sortName" value="name">
                    <label class="btn btn-outline-secondary text-start small" for="sortName">
                        名前
                    </label>

                    <input type="radio" class="btn-check" name="sort" id="sortExercises" value="exercises">
                    <label class="btn btn-outline-secondary text-start small" for="sortExercises">
                        種目数
                    </label>

                    <input type="radio" class="btn-check" name="sort" id="sortDuration" value="duration">
                    <label class="btn btn-outline-secondary text-start small" for="sortDuration">
                        時間
                    </label>
                </div>
            </div>

            {{-- 難易度フィルター --}}
            <div class="mb-4">
                <label class="form-label small fw-medium text-muted">難易度</label>
                <div class="d-grid gap-2">
                    <!-- 動的化時はメニュー数のカウントを動的に生成 -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="difficulty[]" value="beginner" id="difficultyBeginner">
                        <label class="form-check-label d-flex align-items-center small" for="difficultyBeginner">
                            <span class="badge bg-success me-2">初級者</span>
                            <span class="text-muted">(12)</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="difficulty[]" value="intermediate" id="difficultyIntermediate">
                        <label class="form-check-label d-flex align-items-center small" for="difficultyIntermediate">
                            <span class="badge bg-warning text-dark me-2">中級者</span>
                            <span class="text-muted">(8)</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="difficulty[]" value="advanced" id="difficultyAdvanced">
                        <label class="form-check-label d-flex align-items-center small" for="difficultyAdvanced">
                            <span class="badge bg-danger me-2">上級者</span>
                            <span class="text-muted">(5)</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- 公開状態フィルター --}}
            <div class="mb-4">
                <label class="form-label small fw-medium text-muted">公開状態</label>
                <div class="d-grid gap-2">
                    <!-- 動的化時は公開・非公開数を動的に計算 -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="visibility[]" value="public" id="visibilityPublic">
                        <label class="form-check-label d-flex align-items-center small" for="visibilityPublic">
                            <i class="bi bi-globe text-success me-2"></i>
                            公開
                            <span class="text-muted ms-1">(18)</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="visibility[]" value="private" id="visibilityPrivate">
                        <label class="form-check-label d-flex align-items-center small" for="visibilityPrivate">
                            <i class="bi bi-lock text-muted me-2"></i>
                            非公開
                            <span class="text-muted ms-1">(7)</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- タグフィルター --}}
            <div class="mb-4">
                <label class="form-label small fw-medium text-muted">タグ</label>
                <div class="d-grid gap-2">
                    <!-- 動的化時はタグの選択状態を条件分岐で制御 -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="fullbody" id="tagFullbody">
                        <label class="form-check-label small" for="tagFullbody">
                            全身
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="upperbody" id="tagUpperbody">
                        <label class="form-check-label small" for="tagUpperbody">
                            上半身
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="cardio" id="tagCardio">
                        <label class="form-check-label small" for="tagCardio">
                            有酸素
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="strength" id="tagStrength">
                        <label class="form-check-label small" for="tagStrength">
                            筋トレ
                        </label>
                    </div>
                </div>
            </div>

            {{-- 時間範囲フィルター --}}
            <div class="mb-4">
                <label class="form-label small fw-medium text-muted">トレーニング時間</label>
                <div class="row g-2">
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <!-- 動的化時はvalue="{{ $filters['duration_min'] ?? '' }}"に置換 -->
                            <input type="number" class="form-control" name="duration_min" placeholder="最小" min="0" max="300" value="">
                            <span class="input-group-text">分</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <!-- 動的化時はvalue="{{ $filters['duration_max'] ?? '' }}"に置換 -->
                            <input type="number" class="form-control" name="duration_max" placeholder="最大" min="0" max="300" value="">
                            <span class="input-group-text">分</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- フィルター適用ボタン --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-check-lg me-2"></i>
                    フィルターを適用
                </button>
            </div>
        </form>
    </div>
</div>