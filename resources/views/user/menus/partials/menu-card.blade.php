{{-- 修正案: resources/views/user/menus/partials/menu-card.blade.php --}}
<div class="col-md-6 col-xl-4">
    <div class="card h-100 shadow-sm border-0 position-relative overflow-hidden menu-card"
        data-menu-id="{{ $menu->id }}">
        <div class="card-body p-3">
            {{-- カードヘッダー --}}
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex align-items-start">
                    <input type="checkbox" class="form-check-input me-3 mt-1 menu-checkbox" id="menu-{{ $menu->id }}"
                        value="{{ $menu->id }}">
                    <div>
                        <h3 class="h6 fw-semibold mb-1">{{ $menu->name }}</h3>
                        <p class="text-muted small mb-0">{{ $menu->description ?? 'No description.' }}</p>
                    </div>
                </div>
                {{-- 公開/非公開アイコン --}}
                @if ($menu->is_active)
                    <i class="fa-solid fa-globe text-success" title="Public"></i>
                @else
                    <i class="fa-solid fa-lock text-muted" title="Private"></i>
                @endif
            </div>

            {{-- メタ情報 --}}
            <div class="row g-2 mb-3">
                <div class="col-6">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="fa-solid fa-calendar me-2"></i>
                        <span>{{ $menu->created_at->format('Y/m/d') }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="fa-solid fa-bullseye me-2"></i>
                        <span>{{ $menu->menuExercises->count() }} {{ $menu->menuExercises->count() == 1 ? 'exercise' : 'exercises' }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center text-muted small">
                        <i class="fa-solid fa-clock me-2"></i>
                        <span>{{ $menu->estimated_duration }} min</span>
                    </div>
                </div>
                <div class="col-6">
                    @if ($menu->basedOnTemplate)
                        <span class="badge bg-success">{{ $menu->basedOnTemplate->difficulty }}</span>
                    @else
                        <span class="badge bg-secondary">Custom</span>
                    @endif
                </div>
            </div>

            {{-- タグ --}}
            <div class="d-flex flex-wrap gap-1 mb-3">
                @foreach ($menu->unique_muscle_groups as $muscleGroup)
                    <span class="badge bg-secondary">{{ $muscleGroup }}</span>
                @endforeach

                @if ($menu->basedOnTemplate)
                    <span class="badge bg-secondary">{{ $menu->basedOnTemplate->name }}</span>
                @endif
            </div>

            {{-- アクションボタン --}}
            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="{{ route('menus.show', $menu) }}" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-eye me-1"></i>
                    View
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('menus.edit', $menu) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger delete-menu-btn" title="Delete"
                        data-menu-id="{{ $menu->id }}" data-menu-title="{{ $menu->name }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>