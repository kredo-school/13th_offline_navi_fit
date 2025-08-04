{{-- 
/**
 * Training Detail Exercise Details
 * エクササイズ詳細（各種目の詳細情報）
 */
--}}

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="h5 fw-semibold mb-4">エクササイズ詳細</h3>

        <div class="row g-4">
            @forelse($record->details as $index => $detail)
                <div class="col-12">
                    <div class="{{ !$loop->last ? 'border-bottom pb-4' : '' }}">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="badge bg-primary text-white fw-medium px-3 py-2 rounded-pill">
                                    {{ $index + 1 }}
                                </div>
                                <h4 class="h6 mb-0">{{ $detail->exercise->name ?? '未設定' }}</h4>
                                {{-- パーソナルレコードバッジがあれば表示 --}}
                                @if ($detail->is_personal_record)
                                    <div class="badge bg-warning-subtle text-warning d-flex align-items-center gap-1">
                                        <i class="fas fa-award" style="font-size: 0.7rem;"></i>
                                        <span>PR</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <div class="bg-light rounded p-3 text-center">
                                    <div class="h4 fw-bold mb-1">{{ $detail->sets ?? 1 }}</div>
                                    <div class="text-muted small">セット</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="bg-light rounded p-3 text-center">
                                    <div class="h4 fw-bold mb-1">{{ $detail->reps }}</div>
                                    <div class="text-muted small">回数</div>
                                </div>
                            </div>
                            @if ($detail->weight)
                                <div class="col-6 col-md-3">
                                    <div class="bg-light rounded p-3 text-center">
                                        <div class="h4 fw-bold mb-1">{{ $detail->weight }}</div>
                                        <div class="text-muted small">kg</div>
                                    </div>
                                </div>
                            @endif
                            @if ($detail->duration_seconds)
                                <div class="col-6 col-md-3">
                                    <div class="bg-light rounded p-3 text-center">
                                        <div class="h4 fw-bold mb-1">{{ $detail->duration_seconds }}</div>
                                        <div class="text-muted small">秒</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">
                    エクササイズ記録はありません
                </div>
            @endforelse
        </div>
    </div>
</div>
