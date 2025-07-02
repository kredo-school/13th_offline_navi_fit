{{-- フィルターパネル (折りたたみ可能) --}}
<div class="collapse" id="filterPanel">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <form action="#" method="GET" id="filterForm">
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
                            <input type="radio" class="btn-check" name="sort" id="sortDate" value="date" checked>
                            <label class="btn btn-outline-primary text-start" for="sortDate">
                                作成日
                                <span class="float-end">↓</span>
                            </label>
                            
                            <input type="radio" class="btn-check" name="sort" id="sortName" value="name">
                            <label class="btn btn-outline-secondary text-start" for="sortName">
                                名前
                            </label>
                            
                            <input type="radio" class="btn-check" name="sort" id="sortExercises" value="exercises">
                            <label class="btn btn-outline-secondary text-start" for="sortExercises">
                                種目数
                            </label>
                            
                            <input type="radio" class="btn-check" name="sort" id="sortDuration" value="duration">
                            <label class="btn btn-outline-secondary text-start" for="sortDuration">
                                時間
                            </label>
                        </div>
                    </div>
                    
                    {{-- 難易度フィルター --}}
                    <div class="col-md-6 col-lg-3 mb-3">
                        <label class="form-label small fw-medium">難易度</label>
                        <div class="d-grid gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="difficulty[]" value="beginner" id="difficultyBeginner">
                                <label class="form-check-label d-flex align-items-center" for="difficultyBeginner">
                                    <span class="badge bg-success me-2">初級者</span>
                                    <span class="text-muted small">(3)</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="difficulty[]" value="intermediate" id="difficultyIntermediate">
                                <label class="form-check-label d-flex align-items-center" for="difficultyIntermediate">
                                    <span class="badge bg-warning text-dark me-2">中級者</span>
                                    <span class="text-muted small">(5)</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="difficulty[]" value="advanced" id="difficultyAdvanced">
                                <label class="form-check-label d-flex align-items-center" for="difficultyAdvanced">
                                    <span class="badge bg-danger me-2">上級者</span>
                                    <span class="text-muted small">(2)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    {{-- 公開状態フィルター --}}
                    <div class="col-md-6 col-lg-3 mb-3">
                        <label class="form-label small fw-medium">公開状態</label>
                        <div class="d-grid gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="visibility[]" value="public" id="visibilityPublic">
                                <label class="form-check-label d-flex align-items-center" for="visibilityPublic">
                                    <i class="bi bi-globe text-success me-2"></i>
                                    公開
                                    <span class="text-muted small ms-1">(7)</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="visibility[]" value="private" id="visibilityPrivate">
                                <label class="form-check-label d-flex align-items-center" for="visibilityPrivate">
                                    <i class="bi bi-lock text-muted me-2"></i>
                                    非公開
                                    <span class="text-muted small ms-1">(3)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    {{-- タグフィルター --}}
                    <div class="col-md-6 col-lg-3 mb-3">
                        <label class="form-label small fw-medium">タグ</label>
                        <div class="d-grid gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="fullbody" id="tagFullbody">
                                <label class="form-check-label" for="tagFullbody">
                                    全身
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="upperbody" id="tagUpperbody">
                                <label class="form-check-label" for="tagUpperbody">
                                    上半身
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="cardio" id="tagCardio">
                                <label class="form-check-label" for="tagCardio">
                                    有酸素
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="strength" id="tagStrength">
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
                                    <input type="number" 
                                           class="form-control" 
                                           name="duration_min" 
                                           placeholder="最小"
                                           min="0"
                                           max="300">
                                    <span class="input-group-text">分</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="input-group input-group-sm">
                                    <input type="number" 
                                           class="form-control" 
                                           name="duration_max" 
                                           placeholder="最大"
                                           min="0"
                                           max="300">
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
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#filterPanel">
                        キャンセル
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>