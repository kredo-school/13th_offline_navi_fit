{{-- 
/**
 * Training Detail Personal Records
 * Personal record section (display of new records achieved)
 */
--}}

@php
    // Get exercises that achieved personal records
    $personalRecords = $record->details->filter(function ($detail) {
        return $detail->is_personal_record ?? false;
    });
@endphp

@if ($personalRecords->count() > 0)
    <div class="card border-warning shadow-sm" style="background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);">
        <div class="card-body">
            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="fas fa-award text-warning"></i>
                <h3 class="h5 fw-semibold text-warning-emphasis mb-0">Personal Records</h3>
            </div>

            <div class="d-flex flex-column gap-2">
                @foreach ($personalRecords as $record)
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-warning-emphasis">{{ $record->exercise->name ?? 'Not set' }}</span>
                        <div class="d-flex align-items-center gap-2">
                            @if ($record->weight)
                                <span class="fw-medium text-warning-emphasis">{{ $record->weight }}kg</span>
                            @endif
                            <span class="fw-medium text-warning-emphasis">{{ $record->reps }} reps</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
