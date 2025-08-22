<div class="space-y-4">
    {{-- Workout Summary --}}
    <div class="card border-1 shadow-sm mb-4">
        <div class="card-body p-4">
            <h2 class="h4 fw-semibold text-dark mb-4">Workout Summary</h2>

            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="bg-primary bg-opacity-10 rounded-3 p-3 text-center">
                        <div class="h3 fw-bold text-primary mb-1">{{ $this->getCompletedSetsCount() }}</div>
                        <div class="small text-muted">Completed Sets</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                        <div class="h3 fw-bold text-success mb-1">{{ number_format($this->getTotalVolume()) }}</div>
                        <div class="small text-muted">Total Volume (kg)</div>

                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="bg-info bg-opacity-10 rounded-3 p-3 text-center">
                        <div class="h3 fw-bold text-info mb-1">{{ $this->getUniqueExercisesCount() }}</div>
                        <div class="small text-muted">{{ $this->getUniqueExercisesCount() === 1 ? 'Exercise' : 'Exercises' }}</div>

                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 text-center">
                        <div class="h3 fw-bold text-warning mb-1">{{ $this->getEstimatedDuration() }}</div>
                        <div class="small text-muted">Estimated Duration (min)</div>

                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center text-muted small">
                <div class="d-flex align-items-center me-4">
                    <i class="fas fa-calendar me-2"></i>
                    <span>{{ now()->format('Y年m月d日') }}</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-dumbbell me-2"></i>
                    <span>{{ $this->selectedMenu->name ?? '' }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Exercise Details --}}
    @if ($this->selectedMenu)
        @php
            $groupedSets = collect($workoutSets)->groupBy('exercise_id');
        @endphp

        @foreach ($this->selectedMenu->menuExercises as $menuExercise)
            @php
                $exerciseSets = $groupedSets->get($menuExercise->exercise_id, collect());
                $completedSets = $exerciseSets->where('completed', true)->count();
                $totalSets = $exerciseSets->count();
                $exercise = $menuExercise->exercise;
            @endphp

            @if ($totalSets > 0)
                <div class="card border-1 shadow-sm mb-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="h5 fw-semibold text-dark mb-1">{{ $exercise->name }}</h3>
                                <p class="small text-muted mb-0">{{ $completedSets }}/{{ $totalSets }} Sets Completed</p>

                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted fw-normal small">Set</th>
                                        @if($exercise->equipment_category !== 'bodyweight')
                                            <th class="text-muted fw-normal small">Weight (kg)</th>
                                        @endif
                                        <th class="text-muted fw-normal small">Reps</th>
                                        <th class="text-muted fw-normal small">Rest (sec)</th>

                                        <th class="text-muted fw-normal small">Status</th>
                                        <th class="text-muted fw-normal small">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exerciseSets->sortBy('set_number') as $set)
                                        @php
                                            $index = array_search($set, $workoutSets);
                                        @endphp
                                        <tr class="{{ $set['completed'] ? 'bg-success bg-opacity-10' : 'bg-light' }}">
                                            <td class="fw-medium text-dark">{{ $set['set_number'] }}</td>
                                            @if ($exercise->equipment_category !== 'bodyweight')
                                                <td>
                                                    <input wire:model.lazy="workoutSets.{{ $index }}.weight"
                                                        type="number" step="0.5" min="0"
                                                        class="form-control form-control-sm d-inline-block"
                                                        style="width: 70px;">
                                                </td>
                                            @endif
                                            <td>
                                                <input wire:model.lazy="workoutSets.{{ $index }}.reps"
                                                    type="number" min="0"
                                                    class="form-control form-control-sm d-inline-block"
                                                    style="width: 70px;">
                                            </td>
                                            <td>
                                                <input wire:model.lazy="workoutSets.{{ $index }}.rest_seconds"
                                                    type="number" min="0"
                                                    class="form-control form-control-sm d-inline-block"
                                                    style="width: 70px;">
                                            </td>
                                            <td>
                                                <span class="badge {{ $set['completed'] ? 'bg-success' : 'bg-secondary' }} text-white small">
                                                    {{ $set['completed'] ? 'Completed' : 'Incomplete' }}
                                                </span>
                                            </td>
                                            <td>
                                                <button wire:click="toggleSetCompletion('{{ $set['id'] }}')"
                                                        type="button" 
                                                        class="btn btn-link text-primary p-1" 
                                                        title="Toggle Completion">

                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

    {{-- Notes Section --}}
    <div class="card border-1 shadow-sm mb-4">
        <div class="card-body p-4">
            <h3 class="h5 fw-semibold text-dark mb-4">Memo</h3>
            <textarea wire:model="notes"
                      class="form-control" 
                      rows="4" 
                      placeholder="Leave a note about today's workout..."></textarea>

        </div>
    </div>

    {{-- Navigation --}}
    <div class="d-flex justify-content-between pt-4">
        <button wire:click="goToStep2"
                type="button" 
                class="btn btn-outline-secondary">
            Back to Log
        </button>
        <button wire:click="goToStep4"
                type="button" 
                class="btn btn-success btn-lg">
            Save Record
        </button>
    </div>

    {{-- Save Error --}}
    @error('save')
        <div class="alert alert-danger mt-3">
            {{ $message }}
        </div>
    @enderror
</div>
