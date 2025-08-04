<!-- Weight/Body Form -->
<div class="card">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-semibold mb-0">Weight & Body Composition</h5>
            <i class="bi bi-speedometer2 text-muted"></i>
        </div>

        <form action="{{ route('body-records.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-medium">Date</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent">
                        <i class="bi bi-calendar text-muted"></i>
                    </span>
                    <input type="date" name="recorded_date" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-medium">Weight (kg) *</label>
                <input type="number" name="weight" class="form-control" step="0.1" min="20" max="200"
                    placeholder="e.g. 70.5" value="{{ $latestBodyRecord->weight ?? '' }}">
            </div>

            <div class="mb-4">
                <label class="form-label small fw-medium">Body Fat (%)</label>
                <input type="number" name="body_fat_percentage" class="form-control" step="0.1" min="1"
                    max="50" placeholder="e.g. 18.5" value="{{ $latestBodyRecord->body_fat_percentage ?? '' }}">
            </div>

            <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-save"></i>
                <span>Save</span>
            </button>
        </form>
    </div>
</div>
