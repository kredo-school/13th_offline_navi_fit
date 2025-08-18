<!-- Enhanced Weight/Body Form -->
<div class="card">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-semibold mb-0">Weight & Body Composition</h5>
            <i class="bi bi-speedometer2 text-muted"></i>
        </div>

        @php
            // 今日の日付で既に記録があるか確認
            $todayRecord = $latestBodyRecord && $latestBodyRecord->recorded_date->format('Y-m-d') === date('Y-m-d');
        @endphp

        @if ($todayRecord)
            <!-- 今日の記録がある場合の表示 -->
            <div class="alert alert-info mb-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-info-circle me-2"></i>
                    <span>Today's weight has been recorded.</span>
                </div>
            </div>

            <div class="text-center mb-3">
                <div class="fs-2 fw-bold">{{ $latestBodyRecord->weight }} kg</div>
                @if ($latestBodyRecord->body_fat_percentage)
                    <div class="text-muted mt-1">Body Fat: {{ $latestBodyRecord->body_fat_percentage }}%</div>
                @endif
                <div class="small text-muted mt-2">Recorded on: {{ $latestBodyRecord->recorded_date->format('F d, Y') }}
                </div>
            </div>

            <!-- 詳細ページへのリンク -->
            <a href="{{ route('body-records.index') }}"
                class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-pencil"></i>
                <span>Edit / View Records</span>
            </a>
        @else
            <!-- 今日の記録がない場合のフォーム表示 -->
            <form action="{{ route('body-records.store') }}" method="POST" novalidate>
                @csrf

                <!-- エラーメッセージ表示部分を追加 -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="recorded_date" class="form-label small fw-medium">Date</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent">
                            <i class="bi bi-calendar text-muted"></i>
                        </span>
                        <input type="date" id="recorded_date" name="recorded_date" class="form-control"
                            value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label small fw-medium">
                        Weight (kg) *
                    </label>
                    <input type="number" id="weight" name="weight" class="form-control" step="0.1"
                        min="20" max="200" placeholder="Enter weight in kg"
                        value="{{ $latestBodyRecord->weight ?? '' }}" required>
                </div>

                <div class="mb-4">
                    <label for="body_fat_percentage" class="form-label small fw-medium">
                        Body Fat (%)
                    </label>
                    <input type="number" id="body_fat_percentage" name="body_fat_percentage" class="form-control"
                        step="0.1" min="1" max="50" placeholder="Enter body fat percentage"
                        value="{{ $latestBodyRecord->body_fat_percentage ?? '' }}">
                </div>

                <button type="submit"
                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                    <i class="bi bi-save"></i>
                    <span>Save</span>
                </button>
            </form>
        @endif
    </div>
</div>

<!-- Optional: Success Message -->
@if (session('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ session('success') }}
    </div>
@endif
