{{-- 
/**
 * Training History Header
 * Header section (title, back button)
 */
--}}

<div class="bg-white shadow-sm border-bottom sticky-top">
    <div class="container-xxl">
        <div class="d-flex align-items-center justify-content-between py-3">
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-outline-secondary btn-sm me-3" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <div>
                    <h1 class="h4 mb-0 text-dark">Training Details</h1>
                    <p class="text-muted small mb-0">Detailed information for this training record</p>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('training-history.edit', $record->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-edit me-1"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
