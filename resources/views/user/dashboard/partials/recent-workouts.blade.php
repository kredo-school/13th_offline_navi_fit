<!-- Recent Workouts -->
<div class="card">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-semibold mb-0">Recent Workouts</h5>

            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-graph-up text-muted"></i>
                <a href="{{ route('training-history.index') }}"
                    class="text-primary text-decoration-none small fw-medium">View Details</a>
            </div>
        </div>

        <div class="d-flex flex-column gap-3">
            @forelse($recentWorkouts as $workout)
                <a href="{{ route('training-history.show', $workout->id) }}" class="text-decoration-none text-dark">
                    <div class="bg-light rounded p-3 border hover-shadow">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-secondary rounded" style="width: 64px; height: 64px;"></div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    {{ $workout->menu ? $workout->menu->name : ($workout->template ? $workout->template->name : 'Custom Workout') }}
                                </h6>
                                <div class="d-flex align-items-center gap-3 small text-muted">
                                    <div class="d-flex align-items-center gap-1">
                                        <i class="bi bi-clock small"></i>
                                        <span>{{ $workout->training_date->format('M d, Y') }}</span>
                                    </div>
                                    <span>•</span>
                                    <span>{{ $workout->details->count() }} exercises</span>
                                </div>
                                <div class="mt-2">
                                    @if ($workout->template)
                                        <span class="badge bg-primary px-2 py-1 small">Template</span>
                                    @elseif($workout->menu)
                                        <span class="badge bg-success px-2 py-1 small">Menu</span>
                                    @else
                                        <span class="badge bg-secondary px-2 py-1 small">Custom</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-4">
                    <p class="text-muted mb-0">No recent workouts found.</p>
                    <p class="small text-muted">Start training to see your activity here.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
