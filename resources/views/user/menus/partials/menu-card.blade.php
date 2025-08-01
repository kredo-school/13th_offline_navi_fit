<div class="col-md-6 col-xl-4">
    {{-- <!-- 動的化時はdata-menu-id="{{ $menu->id }}"に置換 --> --}}
    <div class="card h-100 shadow-sm border-0 position-relative overflow-hidden menu-card" data-menu-id="1">
        <div class="card-body p-3">
            {{-- カードヘッダー --}}
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex align-items-start">
                    {{-- <!-- 動的化時はid="menu-{{ $menu->id }}" value="{{ $menu->id }}"に置換 --> --}}
                    <input type="checkbox" class="form-check-input me-3 mt-1 menu-checkbox" id="menu-1" value="1">
                    <div>
                        {{-- <!-- 動的化時は{{ $menu->name }}に置換 --> --}}
                        <h3 class="h6 fw-semibold mb-1">Full Body Workout</h3>
                        {{-- <!-- 動的化時は{{ $menu->description ?? 'No description.' }}に置換 --> --}}
                        <p class="text-muted small mb-0">Complete full body training for beginners</p>
                    </div>
                </div>
                {{-- 公開/非公開アイコン --}}
                <!-- 動的化時は条件分岐でアイコンとタイトルを動的に設定 -->
                <i class="fa-solid fa-globe text-success" title="Public Menu"></i>
            </div>

            {{-- メタ情報 --}}
            <div class="row g-2 mb-3">
                <div class="col-6">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="fa-solid fa-calendar me-2"></i>
                        {{-- <!-- 動的化時は{{ $menu->created_at->format('Y/m/d') }}に置換 --> --}}
                        <span>2024/01/15</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="fa-solid fa-bullseye me-2"></i>
                        {{-- <!-- 動的化時は{{ $menu->menuExercises->count() }}に置換 --> --}}
                        <span>8 exercises</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="fa-solid fa-clock me-2"></i>
                        <!-- 動的化時は推定時間の計算結果に置換 -->
                        <span>45 min</span>
                    </div>
                </div>
                <div class="col-6">
                    <!-- 動的化時は<x-difficulty-badge :level="'beginner'" />に置換 -->
                    <span class="badge bg-success">初級者</span>
                </div>
            </div>

            {{-- タグ --}}
            <div class="d-flex flex-wrap gap-1 mb-3">
                <!-- 動的化時はmuscle_groupsから動的に生成 -->
                <span class="badge bg-secondary">全身</span>
                <span class="badge bg-secondary">筋トレ</span>
                <span class="badge bg-secondary">Template Used</span>
            </div>

            {{-- アクションボタン --}}
            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <!-- 動的化時はroute('menus.show', $menu)に置換 -->
                <a href="#" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-eye me-1"></i>
                    Details
                </a>
                <div class="d-flex gap-2">
                    <!-- 動的化時はroute('menus.edit', $menu)に置換 -->
                    <a href="#" class="btn btn-sm btn-outline-secondary" title="Edit">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <!-- 動的化時はdata-menu-idとdata-menu-titleを動的に設定 -->
                    <button class="btn btn-sm btn-outline-danger delete-menu-btn" title="Delete" data-menu-id="1" data-menu-title="Full Body Workout">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>