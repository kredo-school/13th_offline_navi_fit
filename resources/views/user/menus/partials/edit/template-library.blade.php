{{-- resources/views/menu/partials/template-library.blade.php --}}
<div class="card border-0 shadow-sm h-100 d-flex flex-column">
    <div class="card-header bg-white border-bottom">
        <h6 class="card-title mb-1">テンプレートライブラリ</h6>
        <small class="text-muted">ドラッグして中央に追加</small>
    </div>
    
    <div class="card-body flex-fill overflow-auto p-4">
        <div class="d-flex flex-column gap-3">
            {{-- Template Card 1 --}}
            <div class="card border template-card" draggable="true">
                <div class="position-relative">
                    <img src="https://images.pexels.com/photos/1552252/pexels-photo-1552252.jpeg?auto=compress&cs=tinysrgb&w=200&h=80&fit=crop" 
                         class="card-img-top" 
                         alt="上半身基本"
                         style="height: 80px; object-fit: cover;">
                    <span class="badge bg-success position-absolute top-0 end-0 m-1" style="font-size: 0.75rem;">初級</span>
                </div>
                
                <div class="card-body p-3">
                    <h6 class="card-title mb-1" style="font-size: 0.95rem;">上半身基本</h6>
                    <p class="card-text text-muted mb-2" style="font-size: 0.8rem;">胸、背中、肩の基本種目</p>
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <i class="fa-regular fa-clock me-1" style="font-size: 0.8rem;"></i>
                            <span style="font-size: 0.8rem;">45分</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-bullseye me-1" style="font-size: 0.8rem;"></i>
                            <span style="font-size: 0.8rem;">3種目</span>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary btn-sm flex-fill" style="font-size: 0.8rem;">
                            <i class="fa-solid fa-plus me-1"></i>追加
                        </button>
                        <button type="button" 
                                class="btn btn-outline-secondary btn-sm" 
                                style="font-size: 0.8rem;">
                            <i class="fa-solid fa-chevron-down me-1" style="font-size: 0.75rem;"></i>
                        </button>
                    </div>
                </div>
            </div>
x`
            {{-- Template Card 2 --}}
            <div class="card border template-card" draggable="true">
                <div class="position-relative">
                    <img src="https://images.pexels.com/photos/2294361/pexels-photo-2294361.jpeg?auto=compress&cs=tinysrgb&w=200&h=80&fit=crop" 
                         class="card-img-top" 
                         alt="下半身強化"
                         style="height: 80px; object-fit: cover;">
                    <span class="badge bg-warning position-absolute top-0 end-0 m-1" style="font-size: 0.75rem;">中級</span>
                </div>
                
                <div class="card-body p-3">
                    <h6 class="card-title mb-1" style="font-size: 0.95rem;">下半身強化</h6>
                    <p class="card-text text-muted mb-2" style="font-size: 0.8rem;">脚とお尻の筋力向上</p>
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <i class="fa-regular fa-clock me-1" style="font-size: 0.8rem;"></i>
                            <span style="font-size: 0.8rem;">40分</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-bullseye me-1" style="font-size: 0.8rem;"></i>
                            <span style="font-size: 0.8rem;">3種目</span>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary btn-sm flex-fill" style="font-size: 0.8rem;">
                            <i class="fa-solid fa-plus me-1"></i>追加
                        </button>
                        <button type="button" 
                                class="btn btn-outline-secondary btn-sm" 
                                style="font-size: 0.8rem;">
                            <i class="fa-solid fa-chevron-down me-1" style="font-size: 0.75rem;"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Template Card 3 --}}
            <div class="card border template-card" draggable="true">
                <div class="position-relative">
                    <img src="https://images.pexels.com/photos/1431282/pexels-photo-1431282.jpeg?auto=compress&cs=tinysrgb&w=200&h=80&fit=crop" 
                         class="card-img-top" 
                         alt="コア集中"
                         style="height: 80px; object-fit: cover;">
                    <span class="badge bg-success position-absolute top-0 end-0 m-1" style="font-size: 0.75rem;">初級</span>
                </div>
                
                <div class="card-body p-3">
                    <h6 class="card-title mb-1" style="font-size: 0.95rem;">コア集中</h6>
                    <p class="card-text text-muted mb-2" style="font-size: 0.8rem;">体幹強化メニュー</p>
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <i class="fa-regular fa-clock me-1" style="font-size: 0.8rem;"></i>
                            <span style="font-size: 0.8rem;">25分</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-bullseye me-1" style="font-size: 0.8rem;"></i>
                            <span style="font-size: 0.8rem;">3種目</span>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary btn-sm flex-fill" style="font-size: 0.8rem;">
                            <i class="fa-solid fa-plus me-1"></i>追加
                        </button>
                        <button type="button" 
                                class="btn btn-outline-secondary btn-sm" 
                                style="font-size: 0.8rem;">
                            <i class="fa-solid fa-chevron-down me-1" style="font-size: 0.75rem;"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Template Card 4 --}}
            <div class="card border template-card" draggable="true">
                <div class="position-relative">
                    <img src="https://images.pexels.com/photos/2247179/pexels-photo-2247179.jpeg?auto=compress&cs=tinysrgb&w=200&h=80&fit=crop" 
                         class="card-img-top" 
                         alt="HIIT"
                         style="height: 80px; object-fit: cover;">
                    <span class="badge bg-danger position-absolute top-0 end-0 m-1" style="font-size: 0.75rem;">上級</span>
                </div>
                
                <div class="card-body p-3">
                    <h6 class="card-title mb-1" style="font-size: 0.95rem;">HIIT</h6>
                    <p class="card-text text-muted mb-2" style="font-size: 0.8rem;">高強度インターバル</p>
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <i class="fa-regular fa-clock me-1" style="font-size: 0.8rem;"></i>
                            <span style="font-size: 0.8rem;">20分</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-bullseye me-1" style="font-size: 0.8rem;"></i>
                            <span style="font-size: 0.8rem;">2種目</span>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary btn-sm flex-fill" style="font-size: 0.8rem;">
                            <i class="fa-solid fa-plus me-1"></i>追加
                        </button>
                        <button type="button" 
                                class="btn btn-outline-secondary btn-sm" 
                                style="font-size: 0.8rem;">
                            <i class="fa-solid fa-chevron-down me-1" style="font-size: 0.75rem;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


