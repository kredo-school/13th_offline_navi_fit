<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="space-y-5">
                {{-- Success Animation --}}
                <div class="text-center mb-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle mb-4" 
                         style="width: 96px; height: 96px;">
                        <i class="fas fa-check-circle text-success" style="font-size: 48px;"></i>
                    </div>
                    <h1 class="h2 fw-bold text-dark mb-3">
                        お疲れ様でした！
                    </h1>
                    <p class="h5 text-muted">
                        トレーニング記録が正常に保存されました
                    </p>
                </div>

                {{-- Workout Summary --}}
                <div class="card border-1 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h2 class="h4 fw-semibold text-dark mb-4">今回のワークアウト</h2>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar text-muted me-3" style="font-size: 20px;"></i>
                                    <div>
                                        <div class="small text-muted">日付</div>
                                        <div class="fw-medium">{{ now()->format('Y年m月d日') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-trophy text-muted me-3" style="font-size: 20px;"></i>
                                    <div>
                                        <div class="small text-muted">メニュー</div>
                                        <div class="fw-medium">{{ $this->selectedMenu->name ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-12">
                                <div class="bg-success bg-opacity-10 rounded-3 p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white rounded-circle p-3 me-4">
                                            <i class="fas fa-check-circle text-success" style="font-size: 20px;"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium text-dark">ワークアウト完了</div>
                                            <div class="small text-muted">{{ $this->getCompletedSetsCount() }}セットを完了しました</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-warning bg-opacity-10 rounded-3 p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white rounded-circle p-3 me-4">
                                            <i class="fas fa-trophy text-warning" style="font-size: 20px;"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium text-dark">総ボリューム</div>
                                            <div class="small text-muted">{{ number_format($this->getTotalVolume()) }}kg の重量を扱いました</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Motivational Message --}}
                <div class="card bg-gradient text-white mb-4" 
                     style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body p-4 text-center">
                        <h3 class="h5 fw-semibold mb-3">
                            素晴らしい努力です！
                        </h3>
                        <p class="mb-0">
                            継続は力なり。今日の頑張りが明日の成果につながります。<br>
                            次回のトレーニングも頑張りましょう！
                        </p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-4">
                        <button wire:click="redirectToStats"
                                type="button" 
                                class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-chart-line me-2"></i>
                            <span>統計を見る</span>
                        </button>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <button wire:click="createNew"
                                type="button" 
                                class="btn btn-success w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-trophy me-2"></i>
                            <span>新しい記録</span>
                        </button>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <button wire:click="goHome"
                                type="button" 
                                class="btn btn-outline-secondary w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-home me-2"></i>
                            <span>ホームに戻る</span>
                        </button>
                    </div>
                </div>

                {{-- Auto-redirect notice --}}
                <div class="text-center">
                    <p class="small text-muted mb-0">
                        5秒後に自動的にダッシュボードに戻ります
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        @this.goHome();
    }, 5000);
</script>