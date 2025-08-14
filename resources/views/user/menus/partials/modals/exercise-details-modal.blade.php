{{-- 改善されたexercise-details-modal.blade.php --}}
<div class="modal fade" id="exerciseDetailModal" tabindex="-1" aria-labelledby="exerciseModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            {{-- Modal Header --}}
            <div class="modal-header border-bottom">
                <div class="flex-grow-1">
                    <h2 class="modal-title fs-4 fw-bold text-dark mb-2" id="exerciseModalTitle">
                        {{ isset($exercise) ? $exercise->name : 'Exercise Details' }}
                    </h2>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-success px-3 py-2 rounded-pill" id="exerciseDifficulty">
                            {{ isset($exercise) ? $exercise->difficulty : 'Beginner' }}
                        </span>
                        <span class="text-muted small" id="exerciseCategory">
                            {{ isset($exercise) ? $exercise->equipment_category : 'Category' }}
                        </span>
                        <span class="text-muted small">•</span>
                        <span class="text-muted small" id="exerciseEquipment">
                            {{ isset($exercise) && $exercise->equipment_needed ? $exercise->equipment_needed : 'No equipment' }}
                        </span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Modal Body --}}
            <div class="modal-body">
                {{-- Media Section --}}
                <div class="ratio ratio-16x9 bg-light rounded mb-4">
                    <div class="col-md-6">
                        @if ($exercise->image_path)
                            <img src="{{ asset('storage/' . $exercise->image_path) }}" class="img-fluid rounded mb-3"
                                alt="{{ $exercise->name }}">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                style="height: 300px;">
                                <i class="fas fa-dumbbell fa-4x text-muted"></i>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Stats Grid --}}
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="bg-primary bg-opacity-10 rounded p-3 text-center">
                            <i class="bi bi-bullseye text-primary fs-4 mb-2"></i>
                            <div class="small text-muted">Target Muscles</div>
                            <div class="fw-medium text-dark" id="muscleGroupCount">
                                {{ isset($exercise) && is_array($exercise->muscle_groups) ? count($exercise->muscle_groups) : 0 }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-success bg-opacity-10 rounded p-3 text-center">
                            <i class="bi bi-gear text-success fs-4 mb-2"></i>
                            <div class="small text-muted">Equipment</div>
                            <div class="fw-medium text-dark" id="equipmentDisplay">
                                {{ isset($exercise) && $exercise->equipment_needed ? $exercise->equipment_needed : 'None' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-warning bg-opacity-10 rounded p-3 text-center">
                            <i class="bi bi-clock text-warning fs-4 mb-2"></i>
                            <div class="small text-muted">Est. Time</div>
                            <div class="fw-medium text-dark" id="estimatedTime">
                                {{ isset($exercise) && $exercise->estimated_time ? $exercise->estimated_time : '-' }}
                                min
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-danger bg-opacity-10 rounded p-3 text-center">
                            <i class="bi bi-lightning text-danger fs-4 mb-2"></i>
                            <div class="small text-muted">Calories</div>
                            <div class="fw-medium text-dark" id="caloriesBurn">
                                {{ isset($exercise) && $exercise->estimated_calories ? $exercise->estimated_calories : '-' }}
                                kcal
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <h5 class="fw-semibold text-dark mb-3">Description</h5>
                    <p class="text-muted lh-lg" id="exerciseDescription">
                        {{ isset($exercise) && $exercise->description ? $exercise->description : 'No description available.' }}
                    </p>
                </div>

                {{-- Target Muscles --}}
                <div class="mb-4">
                    <h5 class="fw-semibold text-dark mb-3">Target Muscle Groups</h5>
                    <div class="d-flex flex-wrap gap-2" id="muscleGroupsList">
                        @if (isset($exercise) && is_array($exercise->muscle_groups) && count($exercise->muscle_groups) > 0)
                            @foreach ($exercise->muscle_groups as $muscle)
                                <span class="badge bg-secondary">{{ $muscle }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">None specified</span>
                        @endif
                    </div>
                </div>

                {{-- Instructions --}}
                <div class="mb-4">
                    <h5 class="fw-semibold text-dark mb-3">Instructions</h5>
                    <div class="lh-lg" id="instructionsList">
                        @if (isset($exercise) && $exercise->instructions)
                            {{ $exercise->instructions }}
                        @else
                            <span class="text-muted">No instructions provided</span>
                        @endif
                    </div>
                </div>

                {{-- Tips --}}
                <div class="mb-4">
                    <h5 class="fw-semibold text-dark mb-3">Tips & Notes</h5>
                    <div class="lh-lg" id="tipsList">
                        @if (isset($exercise) && isset($exercise->tips))
                            {{ $exercise->tips }}
                        @else
                            <span class="text-muted">No tips available</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="addToMenuBtn">
                    <i class="bi bi-plus-lg me-2"></i>
                    Add to Menu
                </button>
            </div>
        </div>
    </div>
</div>
