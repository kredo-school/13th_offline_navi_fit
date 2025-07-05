{{-- resources/views/menu/partials/exercise-catalog.blade.php --}}
<div class="card border-0 shadow-sm h-100 d-flex flex-column">
    <div class="card-header bg-white border-bottom">
        <h6 class="card-title mb-1">エクササイズカタログ</h6>
        <small class="text-muted">クリックまたはドラッグして追加</small>
    </div>
    
    {{-- Filters --}}
    <div class="card-body border-bottom">
        <div class="d-flex flex-column gap-2">
            {{-- Search --}}
            <div class="position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" 
                       class="form-control form-control-sm ps-5" 
                       placeholder="種目を検索..."
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
        <div class="d-flex flex-column gap-2 p-3 exercise-catalog-container">
            {{-- Exercise Card 1 --}}
            <div class="card border exercise-card w-100" draggable="true" data-exercise="ベンチプレス">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pe-2">
                            <h6 class="card-title mb-1" style="font-size: 0.9rem;">ベンチプレス</h6>
                            <p class="text-muted mb-2" style="font-size: 0.8rem;">胸 • バーベル</p>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-warning text-dark">中級</span>
                            </div>
                            
                            {{-- Muscle Groups --}}
                            <div class="d-flex flex-wrap gap-1">
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">胸筋</span>
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">三角筋</span>
                            </div>
                        </div>
                        
                        <img src="{{ asset('images/workout_dummy.jpg') }}" 
                             class="rounded ms-auto" 
                             alt="ベンチプレス"
                             style="width: 70px; height: 70px; object-fit: cover;">
                    </div>
                </div>
            </div>

            {{-- Exercise Card 2 --}}
            <div class="card border exercise-card w-100" draggable="true" data-exercise="スクワット">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pe-2">
                            <h6 class="card-title mb-1" style="font-size: 0.9rem;">スクワット</h6>
                            <p class="text-muted mb-2" style="font-size: 0.8rem;">脚 • バーベル</p>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-success">初級</span>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-1">
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">大腿四頭筋</span>
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">大臀筋</span>
                            </div>
                        </div>
                        
                        <img src="{{ asset('images/workout_dummy.jpg') }}" 
                             class="rounded ms-auto" 
                             alt="スクワット"
                             style="width: 70px; height: 70px; object-fit: cover;">
                    </div>
                </div>
            </div>

            {{-- Exercise Card 3 --}}
            <div class="card border exercise-card w-100" draggable="true" data-exercise="デッドリフト">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pe-2">
                            <h6 class="card-title mb-1" style="font-size: 0.9rem;">デッドリフト</h6>
                            <p class="text-muted mb-2" style="font-size: 0.8rem;">背中 • バーベル</p>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-danger">上級</span>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-1">
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">広背筋</span>
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">ハムストリング</span>
                            </div>
                        </div>
                        
                        <img src="{{ asset('images/workout_dummy.jpg') }}" 
                             class="rounded ms-auto" 
                             alt="デッドリフト"
                             style="width: 70px; height: 70px; object-fit: cover;">
                    </div>
                </div>
            </div>

            {{-- Exercise Card 4 --}}
            <div class="card border exercise-card w-100" draggable="true" data-exercise="プルアップ">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pe-2">
                            <h6 class="card-title mb-1" style="font-size: 0.9rem;">プルアップ</h6>
                            <p class="text-muted mb-2" style="font-size: 0.8rem;">背中 • 自重</p>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-warning text-dark">中級</span>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-1">
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">広背筋</span>
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">上腕二頭筋</span>
                            </div>
                        </div>
                        
                        <img src="{{ asset('images/navifit_icon.jpg') }}" 
                             class="rounded ms-auto" 
                             alt="プルアップ"
                             style="width: 70px; height: 70px; object-fit: cover;">
                    </div>
                </div>
            </div>

            {{-- Exercise Card 5 --}}
            <div class="card border exercise-card w-100" draggable="true" data-exercise="プランク">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pe-2">
                            <h6 class="card-title mb-1" style="font-size: 0.9rem;">プランク</h6>
                            <p class="text-muted mb-2" style="font-size: 0.8rem;">コア • 自重</p>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-success">初級</span>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-1">
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">腹筋</span>
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">体幹</span>
                            </div>
                        </div>
                        
                        <img src="{{ asset('images/navifit_icon.jpg') }}" 
                             class="rounded ms-auto" 
                             alt="プランク"
                             style="width: 70px; height: 70px; object-fit: cover;">
                    </div>
                </div>
            </div>

            {{-- Exercise Card 6 --}}
            <div class="card border exercise-card w-100" draggable="true" data-exercise="腕立て伏せ">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pe-2">
                            <h6 class="card-title mb-1" style="font-size: 0.9rem;">腕立て伏せ</h6>
                            <p class="text-muted mb-2" style="font-size: 0.8rem;">胸 • 自重</p>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-success">初級</span>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-1">
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">胸筋</span>
                                <span class="badge bg-light text-dark" style="font-size: 0.7rem;">上腕三頭筋</span>
                            </div>
                        </div>
                        
                        <img src="{{ asset('images/navifit_icon.jpg') }}" 
                             class="rounded ms-auto" 
                             alt="腕立て伏せ"
                             style="width: 70px; height: 70px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>

        {{-- Empty State --}}
        <div class="text-center py-4 text-muted d-none" id="emptyExerciseState">
            <i class="bi bi-funnel display-6 text-muted mb-2"></i>
            <p class="small">該当する種目が見つかりません</p>
        </div>
    </div>
</div>