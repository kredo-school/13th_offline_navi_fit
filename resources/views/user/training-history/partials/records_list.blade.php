{{-- 
/**
 * Training History Records List
 * トレーニング記録一覧（デスクトップ版テーブル + モバイル版カード）
 */
--}}

{{-- Desktop Table View --}}
<div class="card shadow-sm mb-4 d-none d-md-block">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="text-nowrap">
                        <div class="d-flex align-items-center">
                            <span>日付</span>
                            <i class="fas fa-chevron-down ms-1 text-muted"></i>
                        </div>
                    </th>
                    <th scope="col">メニュー名</th>
                    <th scope="col">総セット数</th>
                    <th scope="col">総回数</th>
                    <th scope="col">総ボリューム(kg)</th>
                    <th scope="col">時間(分)</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                <!-- トレーニング記録1 -->
                <tr>
                    <td>
                        <div>
                            <div class="fw-medium">2024/03/21 (木)</div>
                            <div class="text-muted small">10:30</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="fw-medium">上半身集中トレーニング</div>
                            <div class="text-muted small">胸・背中・肩</div>
                        </div>
                    </td>
                    <td>12</td>
                    <td>144</td>
                    <td>2,850</td>
                    <td>65</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-outline-primary" title="編集">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="削除">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- トレーニング記録2 -->
                <tr>
                    <td>
                        <div>
                            <div class="fw-medium">2024/03/19 (火)</div>
                            <div class="text-muted small">14:15</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="fw-medium">下半身パワーアップ</div>
                            <div class="text-muted small">脚・お尻強化</div>
                        </div>
                    </td>
                    <td>9</td>
                    <td>81</td>
                    <td>3,200</td>
                    <td>50</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-outline-primary" title="編集">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="削除">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- トレーニング記録3 -->
                <tr>
                    <td>
                        <div>
                            <div class="fw-medium">2024/03/17 (日)</div>
                            <div class="text-muted small">09:00</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="fw-medium">HIIT カーディオ</div>
                            <div class="text-muted small">高強度インターバル</div>
                        </div>
                    </td>
                    <td>15</td>
                    <td>225</td>
                    <td>0</td>
                    <td>25</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-outline-primary" title="編集">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="削除">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- トレーニング記録4 -->
                <tr>
                    <td>
                        <div>
                            <div class="fw-medium">2024/03/15 (金)</div>
                            <div class="text-muted small">16:45</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="fw-medium">コア強化プログラム</div>
                            <div class="text-muted small">体幹集中</div>
                        </div>
                    </td>
                    <td>9</td>
                    <td>90</td>
                    <td>0</td>
                    <td>30</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-outline-primary" title="編集">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="削除">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- トレーニング記録5 -->
                <tr>
                    <td>
                        <div>
                            <div class="fw-medium">2024/03/13 (水)</div>
                            <div class="text-muted small">11:20</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="fw-medium">上半身集中トレーニング</div>
                            <div class="text-muted small">胸・背中・肩</div>
                        </div>
                    </td>
                    <td>12</td>
                    <td>132</td>
                    <td>2,650</td>
                    <td>60</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-outline-primary" title="編集">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="削除">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- トレーニング記録6 -->
                <tr>
                    <td>
                        <div>
                            <div class="fw-medium">2024/03/11 (月)</div>
                            <div class="text-muted small">08:30</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="fw-medium">下半身パワーアップ</div>
                            <div class="text-muted small">脚・お尻強化</div>
                        </div>
                    </td>
                    <td>10</td>
                    <td>90</td>
                    <td>3,100</td>
                    <td>55</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-outline-primary" title="編集">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="削除">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- トレーニング記録7 -->
                <tr>
                    <td>
                        <div>
                            <div class="fw-medium">2024/03/09 (土)</div>
                            <div class="text-muted small">19:00</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="fw-medium">HIIT カーディオ</div>
                            <div class="text-muted small">高強度インターバル</div>
                        </div>
                    </td>
                    <td>12</td>
                    <td>180</td>
                    <td>0</td>
                    <td>20</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-outline-primary" title="編集">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="削除">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- トレーニング記録8 -->
                <tr>
                    <td>
                        <div>
                            <div class="fw-medium">2024/03/07 (木)</div>
                            <div class="text-muted small">07:15</div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="fw-medium">モーニングストレッチ</div>
                            <div class="text-muted small">朝の目覚めストレッチ</div>
                        </div>
                    </td>
                    <td>6</td>
                    <td>60</td>
                    <td>0</td>
                    <td>15</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-outline-primary" title="編集">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="削除">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- Mobile Card View --}}
<div class="d-md-none">
    <div class="row g-3 mb-4">
        <!-- モバイル記録カード1 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="fw-medium">2024/03/21 (木) 10:30</div>
                            <div class="text-muted small">上半身集中トレーニング</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">編集</a></li>
                                <li><a class="dropdown-item text-danger" href="#">削除</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <h3 class="h6 mb-3">胸・背中・肩</h3>
                    
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <div class="fw-medium">12</div>
                            <div class="text-muted small">セット</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">144</div>
                            <div class="text-muted small">回数</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">2,850</div>
                            <div class="text-muted small">kg</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">65</div>
                            <div class="text-muted small">分</div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-3">
                        <p class="text-muted small mb-0">
                            調子良好。重量を少し上げることができた。
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- モバイル記録カード2 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="fw-medium">2024/03/19 (火) 14:15</div>
                            <div class="text-muted small">下半身パワーアップ</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">編集</a></li>
                                <li><a class="dropdown-item text-danger" href="#">削除</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <h3 class="h6 mb-3">脚・お尻強化</h3>
                    
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <div class="fw-medium">9</div>
                            <div class="text-muted small">セット</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">81</div>
                            <div class="text-muted small">回数</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">3,200</div>
                            <div class="text-muted small">kg</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">50</div>
                            <div class="text-muted small">分</div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-3">
                        <p class="text-muted small mb-0">
                            スクワットで新記録達成！
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- モバイル記録カード3 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="fw-medium">2024/03/17 (日) 09:00</div>
                            <div class="text-muted small">HIIT カーディオ</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">編集</a></li>
                                <li><a class="dropdown-item text-danger" href="#">削除</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <h3 class="h6 mb-3">高強度インターバル</h3>
                    
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <div class="fw-medium">15</div>
                            <div class="text-muted small">セット</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">225</div>
                            <div class="text-muted small">回数</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">0</div>
                            <div class="text-muted small">kg</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">25</div>
                            <div class="text-muted small">分</div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-3">
                        <p class="text-muted small mb-0">
                            短時間で効率的にトレーニング完了
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- モバイル記録カード4 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="fw-medium">2024/03/15 (金) 16:45</div>
                            <div class="text-muted small">コア強化プログラム</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">編集</a></li>
                                <li><a class="dropdown-item text-danger" href="#">削除</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <h3 class="h6 mb-3">体幹集中</h3>
                    
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <div class="fw-medium">9</div>
                            <div class="text-muted small">セット</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">90</div>
                            <div class="text-muted small">回数</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">0</div>
                            <div class="text-muted small">kg</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">30</div>
                            <div class="text-muted small">分</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- モバイル記録カード5 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="fw-medium">2024/03/13 (水) 11:20</div>
                            <div class="text-muted small">上半身集中トレーニング</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">編集</a></li>
                                <li><a class="dropdown-item text-danger" href="#">削除</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <h3 class="h6 mb-3">胸・背中・肩</h3>
                    
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <div class="fw-medium">12</div>
                            <div class="text-muted small">セット</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">132</div>
                            <div class="text-muted small">回数</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">2,650</div>
                            <div class="text-muted small">kg</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">60</div>
                            <div class="text-muted small">分</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- モバイル記録カード6 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="fw-medium">2024/03/11 (月) 08:30</div>
                            <div class="text-muted small">下半身パワーアップ</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">編集</a></li>
                                <li><a class="dropdown-item text-danger" href="#">削除</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <h3 class="h6 mb-3">脚・お尻強化</h3>
                    
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <div class="fw-medium">10</div>
                            <div class="text-muted small">セット</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">90</div>
                            <div class="text-muted small">回数</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">3,100</div>
                            <div class="text-muted small">kg</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">55</div>
                            <div class="text-muted small">分</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- モバイル記録カード7 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="fw-medium">2024/03/09 (土) 19:00</div>
                            <div class="text-muted small">HIIT カーディオ</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">編集</a></li>
                                <li><a class="dropdown-item text-danger" href="#">削除</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <h3 class="h6 mb-3">高強度インターバル</h3>
                    
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <div class="fw-medium">12</div>
                            <div class="text-muted small">セット</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">180</div>
                            <div class="text-muted small">回数</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">0</div>
                            <div class="text-muted small">kg</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">20</div>
                            <div class="text-muted small">分</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- モバイル記録カード8 -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="fw-medium">2024/03/07 (木) 07:15</div>
                            <div class="text-muted small">モーニングストレッチ</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">編集</a></li>
                                <li><a class="dropdown-item text-danger" href="#">削除</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <h3 class="h6 mb-3">朝の目覚めストレッチ</h3>
                    
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <div class="fw-medium">6</div>
                            <div class="text-muted small">セット</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">60</div>
                            <div class="text-muted small">回数</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">0</div>
                            <div class="text-muted small">kg</div>
                        </div>
                        <div class="col-3">
                            <div class="fw-medium">15</div>
                            <div class="text-muted small">分</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>