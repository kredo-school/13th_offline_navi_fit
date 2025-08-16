<div class="col-12 col-sm-6 col-xl-4 mb-4">
    <div class="card h-100 shadow-sm border-0 rounded-4 position-relative overflow-hidden menu-card"
        data-menu-id="{{ $menu->id }}">
        <div class="card-body p-3">

            {{-- ヘッダー --}}
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="d-flex align-items-center">
                    <div class="form-check me-2">
                        <input class="form-check-input menu-checkbox" type="checkbox" id="menu-{{ $menu->id }}"
                            value="{{ $menu->id }}">
                        <label for="menu-{{ $menu->id }}" class="visually-hidden">
                            Select {{ $menu->name }}
                        </label>
                    </div>
                    <div class="min-w-0">
                        <h3 class="h6 fw-semibold mb-0 text-truncate">
                            <a href="{{ route('menus.show', $menu) }}" class="text-decoration-none text-body">
                                {{ $menu->name }}
                            </a>
                        </h3>
                    </div>
                </div>

                {{-- 公開/非公開アイコン（ツールチップ付き） --}}
                <div class="ms-2">
                    @if ($menu->is_active)
                        <i class="fa-solid fa-globe text-success" data-bs-toggle="tooltip" data-bs-title="Public"></i>
                    @else
                        <i class="fa-solid fa-lock text-muted" data-bs-toggle="tooltip" data-bs-title="Private"></i>
                    @endif
                </div>
            </div>

            {{-- メタ情報（コンパクトに横並び） --}}
            <div class="d-flex flex-wrap gap-3 small text-secondary mt-3 mb-3">
                <span class="d-inline-flex align-items-center" title="Last updated">
                    <i class="fa-solid fa-clock-rotate-left me-1"></i>
                    {{ $menu->updated_at->format('Y/m/d') }}
                </span>
                <span class="d-inline-flex align-items-center">
                    <i class="fa-solid fa-dumbbell me-1"></i>
                    {{ $menu->menuExercises->count() }}
                    {{ $menu->menuExercises->count() == 1 ? 'exercise' : 'exercises' }}
                </span>
                <span class="d-inline-flex align-items-center">
                    <i class="fa-solid fa-clock me-1"></i>
                    {{ $menu->estimated_duration }} min
                </span>
            </div>

            {{-- タグ（読みやすい薄色ピルバッジ） --}}
            <div class="mb-3">
                <!-- 1行目: Muscle Groups -->
                <div class="d-flex flex-wrap gap-2 mb-2">
                    @foreach ($menu->unique_muscle_groups->take(4) as $muscleGroup)
                        <span class="badge rounded-pill bg-light text-secondary border">{{ $muscleGroup }}</span>
                    @endforeach
                    @if ($menu->unique_muscle_groups->count() > 4)
                        <span
                            class="badge rounded-pill bg-light text-secondary border">+{{ $menu->unique_muscle_groups->count() - 4 }}
                            more</span>
                    @endif
                </div>

                <!-- 2行目: Menu Type -->
                <div class="d-flex">
                    <span
                        class="badge rounded-pill bg-light text-secondary border">{{ $this->getMenuType($menu) }}</span>
                </div>
            </div>

            {{-- アクション --}}
            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="{{ route('menus.show', $menu) }}" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-eye me-1"></i>View
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('menus.edit', $menu) }}" class="btn btn-sm btn-outline-secondary" title="Edit"
                        data-bs-toggle="tooltip" data-bs-title="Edit" aria-label="Edit {{ $menu->name }}">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <button wire:click="deleteMenu({{ $menu->id }})"
                        wire:confirm="Are you sure you want to delete '{{ $menu->name }}'?"
                        class="btn btn-sm btn-outline-danger" title="Delete" data-bs-toggle="tooltip"
                        data-bs-title="Delete" aria-label="Delete {{ $menu->name }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .menu-card {
        transition: box-shadow .2s ease, transform .2s ease;
    }

    .menu-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--bs-box-shadow-lg) !important;
    }

    .menu-card .badge {
        font-weight: 500;
    }
</style>
