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
            @php
                // エクササイズごとにグループ化
                $groupedDetails = $record->details->groupBy('exercise_id');
            @endphp

            @forelse($groupedDetails as $exerciseId => $details)
                @php
                    $exercise = $details->first()->exercise;

                    // 合計ボリューム計算
                    $totalVolume = $details->sum(function ($detail) {
                        return $detail->weight * $detail->reps;
                    });

                    // 1RMの計算（最大の値を取得）
                    $maxOneRM = 0;
                    $bestSet = null;

                    foreach ($details as $detail) {
                        if ($detail->reps <= 36 && $detail->reps > 0 && $detail->weight > 0) {
                            // ブジャルスキーの公式
                            $oneRM = $detail->weight * (36 / (37 - $detail->reps));

                            if ($oneRM > $maxOneRM) {
                                $maxOneRM = $oneRM;
                                $bestSet = $detail;
                            }
                        }
                    }

                    // 前回の1RMを取得（同じエクササイズで最新の記録）
                    $previousRecords = App\Models\TrainingRecordDetail::join(
                        'training_records',
                        'training_records.id',
                        '=',
                        'training_record_details.training_record_id',
                    )
                        ->where('training_records.user_id', $userId)
                        ->where('training_record_details.exercise_id', $exerciseId)
                        ->where('training_records.id', '<', $record->id)
                        ->orderBy('training_records.training_date', 'desc')
                        ->select('training_record_details.*')
                        ->get();

                    $previousMaxOneRM = 0;
                    $previousBestSet = null;

                    foreach ($previousRecords as $prevDetail) {
                        if ($prevDetail->reps <= 36 && $prevDetail->reps > 0 && $prevDetail->weight > 0) {
                            // ブジャルスキーの公式
                            $oneRM = $prevDetail->weight * (36 / (37 - $prevDetail->reps));

                            if ($oneRM > $previousMaxOneRM) {
                                $previousMaxOneRM = $oneRM;
                                $previousBestSet = $prevDetail;
                                break; // 最新の最大1RMだけ取得
                            }
                        }
                    }

                    // 1RMの伸び率
                    $oneRMGrowth = 0;
                    if ($previousMaxOneRM > 0 && $maxOneRM > 0) {
                        $oneRMGrowth = (($maxOneRM - $previousMaxOneRM) / $previousMaxOneRM) * 100;
                    }
                @endphp
                <div class="col-12">
                    <div class="{{ !$loop->last ? 'border-bottom pb-4 mb-3' : '' }}">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="badge bg-primary text-white fw-medium px-3 py-2 rounded-pill">
                                    {{ $loop->index + 1 }}
                                </div>
                                <h4 class="h6 mb-0">{{ $exercise->name ?? '未設定' }}</h4>
                                {{-- パーソナルレコードバッジがあれば表示 --}}
                                @if ($details->contains('is_personal_record', true))
                                    <div class="badge bg-warning-subtle text-warning d-flex align-items-center gap-1">
                                        <i class="fas fa-award" style="font-size: 0.7rem;"></i>
                                        <span>PR</span>
                                    </div>
                                @endif
                            </div>

                            {{-- エクササイズ合計ボリューム --}}
                            <div class="badge bg-secondary text-white px-3 py-2">
                                合計: {{ number_format($totalVolume, 1) }} kg
                            </div>
                        </div>

                        {{-- 1RM計算結果 --}}
                        @if ($maxOneRM > 0)
                            <div class="alert alert-info mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h5 class="mb-1">推定1RM: {{ number_format($maxOneRM, 1) }} kg</h5>
                                        <p class="small mb-0">
                                            ベストセット: {{ $bestSet->weight }}kg × {{ $bestSet->reps }}回
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($oneRMGrowth != 0)
                                            <div class="d-flex align-items-center">
                                                <span class="me-2">前回比:</span>
                                                <span
                                                    class="{{ $oneRMGrowth > 0 ? 'text-success' : 'text-danger' }} fw-bold">
                                                    {{ $oneRMGrowth > 0 ? '+' : '' }}{{ number_format($oneRMGrowth, 1) }}%
                                                </span>
                                                <i
                                                    class="bi {{ $oneRMGrowth > 0 ? 'bi-arrow-up-circle-fill text-success' : 'bi-arrow-down-circle-fill text-danger' }} ms-1"></i>
                                            </div>
                                            @if ($previousBestSet)
                                                <p class="small mb-0">
                                                    前回: {{ $previousBestSet->weight }}kg ×
                                                    {{ $previousBestSet->reps }}回
                                                    ({{ number_format($previousMaxOneRM, 1) }}kg)
                                                </p>
                                            @endif
                                        @else
                                            <p class="small mb-0">前回のデータがありません</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>セット</th>
                                        <th>回数</th>
                                        <th>重量</th>
                                        <th>推定1RM</th>
                                        <th>メモ</th> <!-- 常に表示 -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details->sortBy('set_number') as $detail)
                                        @php
                                            $oneRM = 0;
                                            if ($detail->reps <= 36 && $detail->reps > 0 && $detail->weight > 0) {
                                                $oneRM = $detail->weight * (36 / (37 - $detail->reps));
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $detail->set_number }}</td>
                                            <td>{{ $detail->reps }}</td>
                                            <td>{{ $detail->weight }} kg</td>
                                            <td>
                                                @if ($oneRM > 0)
                                                    {{ number_format($oneRM, 1) }} kg
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $detail->notes ?: '-' }}</td> <!-- 常に表示、内容がなければ「-」 -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
