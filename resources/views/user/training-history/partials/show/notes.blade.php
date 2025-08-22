{{-- 
/**
 * Training Detail Notes Section
 * Notes section
 */
--}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="h5 fw-semibold mb-0">Notes</h3>
            <a href="{{ route('training-history.edit', $record->id) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-edit"></i>
            </a>
        </div>

        <div id="notes-display">
            <div class="text-muted">
                {{ $record->note ?? 'No notes available' }}
            </div>
        </div>
    </div>
</div>
