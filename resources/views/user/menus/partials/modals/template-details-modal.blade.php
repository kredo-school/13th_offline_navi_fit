{{-- 
テンプレート詳細モーダルコンポーネント
用途: トレーニングテンプレートの詳細情報を表示するモーダル
制約: 完全に静的なHTML、Bootstrap 5.3のみ、JavaScript使用禁止
注意: 実際の動的機能（タブ切り替え、画像スライダー、モーダル開閉等）はJavaScriptで実装が必要
--}}

{{-- モーダルバックドロップ --}}
<div class="modal fade" id="templateDetailsModal" tabindex="-1" aria-labelledby="templateDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow-lg">
                {{-- ヘッダー --}}
                <div class="modal-header border-bottom p-4">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <h2 class="modal-title fs-3 fw-bold text-dark mb-0" id="templateDetailsModalLabel">
                                上半身集中トレーニング
                            </h2>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-medium">
                                中級者
                            </span>
                        </div>
                        <p class="text-muted mb-3">
                            胸、背中、肩を中心とした上半身の筋力向上プログラム。初心者から中級者まで対応できる効果的なワークアウトです。
                        </p>
                        <div class="d-flex align-items-center gap-4 small text-muted">
                            <div class="d-flex align-items-center gap-1">
                                <i class="fas fa-calendar"></i>
                                <span>作成: 2024年3月1日</span>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <i class="fas fa-globe text-success"></i>
                                <span class="text-success">公開</span>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="モーダルを閉じる"></button>
                </div>

                {{-- タブナビゲーション --}}
                <div class="px-4 pt-4 mb-3">
                    <!-- 動的化時はJavaScriptでタブ切り替え制御が必要 -->
                    <ul class="nav nav-pills nav-fill gap-1" id="templateTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active d-flex align-items-center gap-2" id="overview-tab" data-bs-toggle="pill" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">
                                <i class="fas fa-bullseye"></i>
                                <span>概要</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center gap-2" id="exercises-tab" data-bs-toggle="pill" data-bs-target="#exercises" type="button" role="tab" aria-controls="exercises" aria-selected="false">
                                <i class="fas fa-dumbbell"></i>
                                <span>エクササイズ</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center gap-2" id="nutrition-tab" data-bs-toggle="pill" data-bs-target="#nutrition" type="button" role="tab" aria-controls="nutrition" aria-selected="false">
                                <i class="fas fa-heart"></i>
                                <span>栄養情報</span>
                            </button>
                        </li>
                    </ul>
                </div>

                {{-- タブコンテンツ --}}
                <div class="modal-body">
                    <div class="tab-content" id="templateTabContent">
                        
                        {{-- 概要タブ --}}
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                
                                {{-- 画像表示 --}}
                                <div class="bg-light rounded-3 overflow-hidden mb-4" style="aspect-ratio: 16/9;">
                                    <img src="https://images.pexels.com/photos/1552252/pexels-photo-1552252.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" 
                                         alt="上半身集中トレーニング" 
                                         class="w-100 h-100 object-fit-cover">
                                </div>

                                {{-- 統計グリッド --}}
                                <div class="row g-3 mb-4">
                                    <div class="col-6 col-md-3">
                                        <div class="bg-primary bg-opacity-10 rounded-3 p-3 text-center">
                                            <i class="fas fa-clock text-primary fs-4 mb-2"></i>
                                            <div class="fs-3 fw-bold text-primary">60</div>
                                            <div class="small text-muted">分</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                                            <i class="fas fa-bullseye text-success fs-4 mb-2"></i>
                                            <div class="fs-3 fw-bold text-success">4</div>
                                            <div class="small text-muted">種目</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="bg-warning bg-opacity-10 rounded-3 p-3 text-center">
                                            <i class="fas fa-bolt text-warning fs-4 mb-2"></i>
                                            <div class="fs-3 fw-bold text-warning">420</div>
                                            <div class="small text-muted">kcal</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="bg-info bg-opacity-10 rounded-3 p-3 text-center">
                                            <i class="fas fa-star text-info fs-4 mb-2"></i>
                                            <div class="fs-3 fw-bold text-info">4.3</div>
                                            <div class="small text-muted">評価</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- テンプレート情報 --}}
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <h3 class="fs-5 fw-semibold text-dark mb-3">対象筋群</h3>
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">胸筋</span>
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">広背筋</span>
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">三角筋</span>
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">上腕三頭筋</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <h3 class="fs-5 fw-semibold text-dark mb-3">必要器具</h3>
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">バーベル</span>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">ダンベル</span>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">プルアップバー</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- 人気度メトリクス --}}
                                <div class="bg-light rounded-3 p-4">
                                    <h3 class="fs-5 fw-semibold text-dark mb-4">人気度</h3>
                                    <div class="row g-3 text-center">
                                        <div class="col-4">
                                            <div class="fs-3 fw-bold text-dark">85%</div>
                                            <div class="small text-muted">人気度</div>
                                        </div>
                                        <div class="col-4">
                                            <div class="fs-3 fw-bold text-dark">78%</div>
                                            <div class="small text-muted">完了率</div>
                                        </div>
                                        <div class="col-4">
                                            <div class="fs-3 fw-bold text-dark">4.3</div>
                                            <div class="small text-muted">ユーザー評価</div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        {{-- エクササイズタブ --}}
                        <div class="tab-pane fade" id="exercises" role="tabpanel" aria-labelledby="exercises-tab">
                            <div class="p-4">
                                <div class="d-flex flex-column gap-3">
                                    
                                    {{-- エクササイズ1 --}}
                                    <div class="border rounded-3 hover-shadow mb-3" x-data="{ expanded: false }">
                                        <div class="p-3" @click="expanded = !expanded" style="cursor: pointer;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="badge bg-primary text-white px-3 py-2 rounded-pill fw-medium">1</div>

                                                    <div>
                                                        <h4 class="fw-semibold text-dark mb-1">ベンチプレス</h4>
                                                        <div class="d-flex align-items-center gap-3 small text-muted">
                                                            <span>4セット</span>
                                                            <span>8回</span>
                                                            <span>80kg</span>
                                                            <span>休憩120秒</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill small fw-medium">中級者</span>
                                                    <span class="small text-muted">120kcal</span>
                                                    <i class="fas fa-chevron-down text-muted transition-transform duration-200" :class="{ 'rotate-180': expanded }"></i>
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
                                                        <img src="https://images.pexels.com/photos/1552252/pexels-photo-1552252.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&fit=crop" 
                                                             alt="ベンチプレスのデモ画像" 
                                                             class="w-100 rounded-3" 
                                                             style="height: 8rem; object-fit: cover;">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="fw-medium text-dark mb-2">対象筋群</h5>
                                                        <div class="d-flex flex-wrap gap-1 mb-3">
                                                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">胸筋</span>
                                                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">三角筋</span>
                                                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">上腕三頭筋</span>
                                                        </div>
                                                        <div class="small text-muted">
                                                            <span class="fw-medium">器具:</span> バーベル
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- 実行手順 --}}
                                                <div>
                                                    <h5 class="fw-medium text-dark mb-2">実行手順</h5>
                                                    <ol class="d-flex flex-column gap-2 ps-0">
                                                        <li class="d-flex align-items-start gap-2 small text-dark">
                                                            <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">1</span>
                                                            <span>ベンチに仰向けになり、肩甲骨を寄せて胸を張る</span>
                                                        </li>
                                                        <li class="d-flex align-items-start gap-2 small text-dark">
                                                            <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">2</span>
                                                            <span>バーベルを肩幅より少し広めの手幅で握る</span>
                                                        </li>
                                                        <li class="d-flex align-items-start gap-2 small text-dark">
                                                            <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">3</span>
                                                            <span>バーベルを胸の上まで下ろし、一瞬停止する</span>
                                                        </li>
                                                        <li class="d-flex align-items-start gap-2 small text-dark">
                                                            <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">4</span>
                                                            <span>胸筋を意識しながらバーベルを押し上げる</span>
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- エクササイズ2 --}}
                                    <div class="border rounded-3 hover-shadow mb-3" x-data="{ expanded: false }">
                                        <div class="p-3" @click="expanded = !expanded" style="cursor: pointer;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="badge bg-primary text-white px-3 py-2 rounded-pill fw-medium">2</div>
                                                    <div>
                                                        <h4 class="fw-semibold text-dark mb-1">プルアップ</h4>
                                                        <div class="d-flex align-items-center gap-3 small text-muted">
                                                            <span>3セット</span>
                                                            <span>10回</span>
                                                            <span>休憩90秒</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill small fw-medium">中級者</span>
                                                    <span class="small text-muted">80kcal</span>
                                                    <i class="fas fa-chevron-down text-muted transition-transform duration-200" :class="{ 'rotate-180': expanded }"></i>
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
                                                    <img src="https://images.pexels.com/photos/4853274/pexels-photo-4853274.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&fit=crop" 
                                                         alt="プルアップのデモ画像" 
                                                         class="w-100 rounded-3" 
                                                         style="height: 8rem; object-fit: cover;">
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="fw-medium text-dark mb-2">対象筋群</h5>
                                                    <div class="d-flex flex-wrap gap-1 mb-3">
                                                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">広背筋</span>
                                                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">上腕二頭筋</span>
                                                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">後三角筋</span>
                                                    </div>
                                                    <div class="small text-muted">
                                                        <span class="fw-medium">器具:</span> プルアップバー
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 実行手順 --}}
                                            <div>
                                                <h5 class="fw-medium text-dark mb-2">実行手順</h5>
                                                <ol class="d-flex flex-column gap-2 ps-0">
                                                    <li class="d-flex align-items-start gap-2 small text-dark">
                                                        <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">1</span>
                                                        <span>プルアップバーを肩幅より少し広めの手幅で握る</span>
                                                    </li>
                                                    <li class="d-flex align-items-start gap-2 small text-dark">
                                                        <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">2</span>
                                                        <span>肩甲骨を寄せながら、顎がバーに届くまで体を引き上げる</span>
                                                    </li>
                                                    <li class="d-flex align-items-start gap-2 small text-dark">
                                                        <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">3</span>
                                                        <span>ゆっくりと開始位置まで体を下ろす</span>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- エクササイズ3 --}}
                                    <div class="border rounded-3 hover-shadow mb-3" x-data="{ expanded: false }">
                                        <div class="p-3" @click="expanded = !expanded" style="cursor: pointer;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="badge bg-primary text-white px-3 py-2 rounded-pill fw-medium">3</div>
                                                    <div>
                                                        <h4 class="fw-semibold text-dark mb-1">ショルダープレス</h4>
                                                        <div class="d-flex align-items-center gap-3 small text-muted">
                                                            <span>3セット</span>
                                                            <span>12回</span>
                                                            <span>25kg</span>
                                                            <span>休憩60秒</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill small fw-medium">初級者</span>
                                                    <span class="small text-muted">60kcal</span>
                                                    <i class="fas fa-chevron-down text-muted transition-transform duration-200" :class="{ 'rotate-180': expanded }"></i>
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
                                                    <img src="https://images.pexels.com/photos/7592303/pexels-photo-7592303.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&fit=crop" 
                                                         alt="ショルダープレスのデモ画像" 
                                                         class="w-100 rounded-3" 
                                                         style="height: 8rem; object-fit: cover;">
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="fw-medium text-dark mb-2">対象筋群</h5>
                                                    <div class="d-flex flex-wrap gap-1 mb-3">
                                                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">三角筋</span>
                                                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">上腕三頭筋</span>
                                                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">僧帽筋</span>
                                                    </div>
                                                    <div class="small text-muted">
                                                        <span class="fw-medium">器具:</span> ダンベル
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 実行手順 --}}
                                            <div>
                                                <h5 class="fw-medium text-dark mb-2">実行手順</h5>
                                                <ol class="d-flex flex-column gap-2 ps-0">
                                                    <li class="d-flex align-items-start gap-2 small text-dark">
                                                        <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">1</span>
                                                        <span>ダンベルを両手に持ち、肩幅で立つ</span>
                                                    </li>
                                                    <li class="d-flex align-items-start gap-2 small text-dark">
                                                        <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">2</span>
                                                        <span>肩の高さからダンベルを頭上に向かって押し上げる</span>
                                                    </li>
                                                    <li class="d-flex align-items-start gap-2 small text-dark">
                                                        <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">3</span>
                                                        <span>ゆっくりと肩の高さまで下ろす</span>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- エクササイズ4 --}}
                                    <div class="border rounded-3 hover-shadow" x-data="{ expanded: false }">
                                        <div class="p-3" @click="expanded = !expanded" style="cursor: pointer;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="badge bg-primary text-white px-3 py-2 rounded-pill fw-medium">4</div>
                                                    <div>
                                                        <h4 class="fw-semibold text-dark mb-1">ディップス</h4>
                                                        <div class="d-flex align-items-center gap-3 small text-muted">
                                                            <span>3セット</span>
                                                            <span>15回</span>
                                                            <span>休憩60秒</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill small fw-medium">中級者</span>
                                                    <span class="small text-muted">90kcal</span>
                                                    <i class="fas fa-chevron-down text-muted transition-transform duration-200" :class="{ 'rotate-180': expanded }"></i>
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
                                                    <img src="https://images.pexels.com/photos/7690163/pexels-photo-7690163.jpeg?auto=compress&cs=tinysrgb&w=300&h=200&fit=crop" 
                                                         alt="ディップスのデモ画像" 
                                                         class="w-100 rounded-3" 
                                                         style="height: 8rem; object-fit: cover;">
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="fw-medium text-dark mb-2">対象筋群</h5>
                                                    <div class="d-flex flex-wrap gap-1 mb-3">
                                                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">胸筋</span>
                                                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">上腕三頭筋</span>
                                                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">前三角筋</span>
                                                    </div>
                                                    <div class="small text-muted">
                                                        <span class="fw-medium">器具:</span> ディップスバー
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 実行手順 --}}
                                            <div>
                                                <h5 class="fw-medium text-dark mb-2">実行手順</h5>
                                                <ol class="d-flex flex-column gap-2 ps-0">
                                                    <li class="d-flex align-items-start gap-2 small text-dark">
                                                        <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">1</span>
                                                        <span>ディップスバーを両手で掴み、腕を伸ばして体を支える</span>
                                                    </li>
                                                    <li class="d-flex align-items-start gap-2 small text-dark">
                                                        <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">2</span>
                                                        <span>ゆっくりと肘を曲げて体を下ろす</span>
                                                    </li>
                                                    <li class="d-flex align-items-start gap-2 small text-dark">
                                                        <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 1.25rem; height: 1.25rem; font-size: 0.75rem;">3</span>
                                                        <span>胸筋を意識しながら元の位置まで押し上げる</span>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- 栄養情報タブ --}}
                        <div class="tab-pane fade" id="nutrition" role="tabpanel" aria-labelledby="nutrition-tab">
                            <div class="text-center py-5">
                                <i class="fas fa-heart text-muted mb-4" style="font-size: 4rem;"></i>
                                <h3 class="fs-5 fw-semibold text-dark mb-2">栄養情報</h3>
                                <p class="text-muted">栄養情報機能は今後のアップデートで追加予定です</p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- フッター --}}
                <div class="modal-footer bg-light border-top p-4">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="small text-muted">
                            最終使用: 2024年3月20日
                        </div>
                        <div class="d-flex gap-3">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                キャンセル
                            </button>
                            <button type="button" class="btn btn-primary d-flex align-items-center gap-2">
                                <i class="fas fa-plus"></i>
                                <span>メニューに追加</span>
                            </button>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>