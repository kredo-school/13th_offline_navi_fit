{{-- 
/**
 * Training Detail Personal Records
 * パーソナルレコードセクション（新記録達成の表示）
 */
--}}

@php
    // 個人記録を達成したエクササイズを取得
    $personalRecords = $record->details->filter(function ($detail) {
        return $detail->is_personal_record ?? false;
    });
@endphp

@if ($personalRecords->count() > 0)
    <div class="card border-warning shadow-sm" style="background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);">
        <div class="card-body">
            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="fas fa-award text-warning"></i>
                <h3 class="h5 fw-semibold text-warning-emphasis mb-0">パーソナルレコード</h3>
            </div>

            <div class="d-flex flex-column gap-2">
                @foreach ($personalRecords as $record)
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-warning-emphasis">{{ $record->exercise->name ?? '未設定' }}</span>
                        <div class="d-flex align-items-center gap-2">
                            @if ($record->weight)
                                <span class="fw-medium text-warning-emphasis">{{ $record->weight }}kg</span>
                            @endif
                            <span class="fw-medium text-warning-emphasis">{{ $record->reps }}回</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
