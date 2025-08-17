<div class="col-12 col-sm-6 col-xl-4 mb-4">
    <div class="card border shadow-sm rounded-4 position-relative overflow-hidden menu-card"
        data-menu-id="{{ $menu->id }}">
        {{-- サムネイル画像 - テンプレートの画像があれば表示、なければ新しいデフォルト画像 --}}
        @php
            // テンプレートの画像を取得
            $imagePath = null;

            // ベースとなったテンプレートの画像を確認
            if (isset($menu->based_on_template_id) && $menu->basedOnTemplate && $menu->basedOnTemplate->image_path) {
                $imagePath = $menu->basedOnTemplate->image_path;
            }

            // 新しく追加したデフォルト画像の配列
            $fallbackImages = [
                'images/menus/default1.jpg',
                'images/menus/default2.jpg',
                'images/menus/default3.jpg',
                'images/menus/default4.jpg',
                'images/menus/default5.jpg',
            ];

            // メニューIDに基づいて画像を選択
            $imageIndex = $menu->id % count($fallbackImages);
            $fallbackImage = $fallbackImages[$imageIndex];
        @endphp

        <div class="position-relative">
            <img src="{{ $imagePath ? asset('storage/' . $imagePath) : asset($fallbackImage) }}" class="card-img-top"
                alt="{{ $menu->name }}" style="height: 120px; object-fit: cover;" loading="lazy">
        </div>

        <div class="card-body p-3">
            {{-- ヘッダー - カードタイトルとアイコンの配置を調整 --}}
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="min-w-0">
                    <h6 class="card-title mb-1" style="font-size: 0.95rem;">
                        <a href="{{ route('menus.show', $menu) }}" class="text-decoration-none text-body">
                            {{ $menu->name }}
                        </a>
                    </h6>
                </div>

                {{-- チェックボックスと公開/非公開アイコン --}}
                <div class="d-flex align-items-center">
                    <div class="form-check me-2">
                        <input class="form-check-input menu-checkbox" type="checkbox" id="menu-{{ $menu->id }}"
                            value="{{ $menu->id }}">
                        <label for="menu-{{ $menu->id }}" class="visually-hidden">
                            Select {{ $menu->name }}
                        </label>
                    </div>
                    <div>
                        @if ($menu->is_active)
                            <i class="fa-solid fa-globe text-success" data-bs-toggle="tooltip"
                                data-bs-title="Public"></i>
                        @else
                            <i class="fa-solid fa-lock text-muted" data-bs-toggle="tooltip" data-bs-title="Private"></i>
                        @endif
                    </div>
                </div>
            </div>

            {{-- メタ情報  --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center">
                    <i class="fa-regular fa-clock me-1" style="font-size: 0.8rem;"></i>
                    <span style="font-size: 0.8rem;">{{ $menu->updated_at->format('Y/m/d') }}</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-dumbbell me-1" style="font-size: 0.8rem;"></i>
                    <span style="font-size: 0.8rem;">
                        {{ $menu->menuExercises->count() }}
                        {{ $menu->menuExercises->count() == 1 ? 'exercise' : 'exercises' }}
                    </span>
                </div>
            </div>

            {{-- 追加メタ情報 --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-hourglass-half me-1" style="font-size: 0.8rem;"></i>
                    <span style="font-size: 0.8rem;">{{ $menu->estimated_duration }} min</span>
                </div>
            </div>

            {{-- タグ（muscle groups） --}}
            <div class="d-flex flex-wrap gap-2 mb-3">
                @foreach ($menu->unique_muscle_groups->take(3) as $muscleGroup)
                    <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">
                        {{ $muscleGroup }}
                    </span>
                @endforeach
                @if ($menu->unique_muscle_groups->count() > 3)
                    <span class="badge bg-light text-secondary px-2 py-1 rounded-pill small">
                        +{{ $menu->unique_muscle_groups->count() - 3 }} more
                    </span>
                @endif
            </div>

            {{-- アクション - template-libraryのボタンスタイルに合わせる --}}
            <div class="d-flex gap-2">
                <a href="{{ route('menus.show', $menu) }}" class="btn btn-outline-primary btn-sm flex-fill"
                    style="font-size: 0.8rem;">
                    <i class="fa-solid fa-eye me-1"></i>View
                </a>
                <a href="{{ route('menus.edit', $menu) }}" class="btn btn-outline-secondary btn-sm"
                    style="font-size: 0.8rem;" title="Edit" aria-label="Edit {{ $menu->name }}">
                    <i class="fa-solid fa-pencil"></i>
                </a>
                <button wire:click="deleteMenu({{ $menu->id }})"
                    wire:confirm="Are you sure you want to delete '{{ $menu->name }}'?"
                    class="btn btn-outline-danger btn-sm" style="font-size: 0.8rem;" title="Delete"
                    aria-label="Delete {{ $menu->name }}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .menu-card {
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .menu-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--bs-box-shadow) !important;
    }

    .menu-card .badge {
        font-weight: 500;
    }
</style>
