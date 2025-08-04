{{-- 
/**
 * Training Detail Hero Section
 * ヒーローセクション（グラデーション背景、メインタイトル、基本情報）
 */
--}}

<div class="card shadow-sm mb-4 position-relative overflow-hidden"
    style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);">
    {{-- Background icon --}}
    <div class="position-absolute top-0 end-0 opacity-25">
        <i class="fas fa-bullseye" style="font-size: 8rem; color: white;"></i>
    </div>

    <div class="card-body text-white position-relative p-5">
        <div class="d-flex align-items-center mb-2">
            <i class="fas fa-calendar me-2"></i>
            <span class="text-white-50">{{ $record->training_date->format('Y年m月d日 (D) H:i') }}</span>
        </div>

        <h2 class="display-6 fw-bold mb-2">{{ $record->menu->name ?? 'トレーニング記録' }}</h2>

        <p class="h5 text-white-75 mb-4">{{ $record->template->title ?? '未設定' }}</p>

        <div class="d-flex flex-wrap gap-3 small">
            @if ($record->duration_minutes)
                <div class="d-flex align-items-center">
                    <i class="fas fa-clock me-1"></i>
                    <span>{{ $record->duration_minutes }}分</span>
                </div>
            @endif

            <div class="d-flex align-items-center">
                <i class="fas fa-bullseye me-1"></i>
                <span>{{ $record->details->count('exercise_id') }}種目</span>
            </div>

            @if ($record->calories)
                <div class="d-flex align-items-center">
                    <i class="fas fa-fire me-1"></i>
                    <span>{{ $record->calories }}kcal</span>
                </div>
            @endif
        </div>
    </div>
</div>
