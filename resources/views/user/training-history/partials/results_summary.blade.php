{{-- 
/**
 * Training History Results Summary
 * Search results and statistics summary panel
 */
--}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="h6 mb-3">Results Summary</h3>

        <ul class="list-group list-group-flush small">
            <li class="list-group-item d-flex justify-content-between">
                <span>Showing</span>
                <span>{{ $records->firstItem() }} - {{ $records->lastItem() }} of {{ $records->total() }} records</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total Sets</span>
                <span>{{ $totalSets }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total Reps</span>
                <span>{{ $totalReps }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total Volume</span>
                <span>{{ number_format($totalVolume) }} kg</span>
            </li>
        </ul>
    </div>
</div>
