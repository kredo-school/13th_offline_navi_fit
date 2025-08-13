{{-- resources/views/livewire/exercise-editor.blade.php --}}
<div>
    <div class="card border-0 shadow-sm h-100 d-flex flex-column">
        <div class="card-body d-flex flex-column">
            {{-- Basic Information Section --}}
            <div class="mb-4">
                <h6 class="fw-semibold text-dark mb-3">Basic Information</h6>
                
                {{-- Menu Name --}}
                <div class="mb-3">
                    <label for="menuName" class="form-label small fw-medium">Menu Name *</label>
                    <input type="text" 
                           id="menuName"
                           class="form-control form-control-sm {{ isset($errors['menuName']) ? 'is-invalid' : '' }}"
                           wire:model.live.debounce.300ms="menuName"
                           placeholder="Enter menu name"
                           maxlength="255">
                    @if(isset($errors['menuName']))
                        <div class="invalid-feedback">{{ $errors['menuName'] }}</div>
                    @endif
                </div>

                {{-- Menu Settings --}}
                <div class="row g-2">
                    <div class="col-6">
                        <div class="form-check">
                            <input type="checkbox" 
                                   id="isActive"
                                   class="form-check-input"
                                   wire:model="isActive">
                            <label for="isActive" class="form-check-label small">
                                Public
                            </label>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        {{-- Menu Statistics --}}
                        <small class="text-muted">
                            {{ count($exercises) }} exercises • 
                            {{ $this->getTotalSets() }} sets
                        </small>
                    </div>
                </div>
            </div>

            {{-- Exercise Section --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-semibold text-dark mb-0">Exercises</h6>
                <div class="d-flex gap-2">
                    @if(count($exercises) > 0)
                        <button type="button" 
                                class="btn btn-outline-secondary btn-sm"
                                wire:click="clearMenu"
                                wire:confirm="Are you sure you want to clear all exercises?">
                            <i class="fas fa-trash-alt me-1"></i>Clear All
                        </button>
                    @endif
                    <button type="button" 
                            class="btn btn-success btn-sm"
                            wire:click="saveMenu"
                            wire:loading.attr="disabled"
                            wire:target="saveMenu"
                            {{ count($exercises) === 0 || empty(trim($menuName)) ? 'disabled' : '' }}>
                        <span wire:loading.remove wire:target="saveMenu">
                            <i class="fas fa-save me-1"></i>Save Menu
                        </span>
                        <span wire:loading wire:target="saveMenu">
                            <i class="fas fa-spinner fa-spin me-1"></i>Saving...
                        </span>
                    </button>
                </div>
            </div>

            {{-- Exercise Validation Errors (single location) --}}
            @php
                $exerciseFieldErrors = [];
                if (isset($errors) && is_array($errors)) {
                    foreach ($errors as $key => $msg) {
                        if (is_string($key) && preg_match('/_(sets|reps|weight)$/', $key)) {
                            $exerciseFieldErrors[] = $msg;
                        }
                    }
                }
            @endphp
            @if(isset($errors['exercises']) || count($exerciseFieldErrors) > 0)
                <div class="alert alert-danger alert-dismissible fade show alert-sm" role="alert">
                    @if(isset($errors['exercises']))
                        <div><small>{{ $errors['exercises'] }}</small></div>
                    @endif
                    @if(count($exerciseFieldErrors) > 0)
                        <ul class="mb-0 small ps-3">
                            @foreach($exerciseFieldErrors as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Exercise Table or Empty State --}}
            <div class="flex-fill overflow-auto">
                @if(count($exercises) === 0)
                    {{-- Empty State --}}
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-dumbbell display-6 text-muted mb-3"></i>
                        <h6 class="fw-semibold text-dark mb-2">No exercises added yet</h6>
                        <p class="small mb-0">
                            Add exercises from the Template Library (left) or Exercise Catalog (right)
                        </p>
                    </div>
                @else
                    {{-- Exercise Table --}}
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th width="30" class="text-center">#</th>
                                    <th>Exercise Name</th>
                                    <th width="80" class="text-center">Sets</th>
                                    <th width="80" class="text-center">Reps</th>
                                    <th width="80" class="text-center">kg</th>
                                    <th width="80" class="text-center">Rest(sec)</th>
                                    <th width="80" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($exercises as $index => $exercise)
                                    <tr wire:key="exercise-{{ $index }}">
                                        {{-- Order Index --}}
                                        <td class="text-center align-middle">
                                            <span class="badge bg-primary">{{ $index + 1 }}</span>
                                        </td>

                                        {{-- Exercise Name --}}
                                        <td class="align-middle">
                                            <input type="text" 
                                                   class="form-control form-control-sm {{ isset($errors["exercise_{$index}_name"]) ? 'is-invalid' : '' }}"
                                                   wire:model.live.debounce.300ms="exercises.{{ $index }}.exercise_name"
                                                   placeholder="Exercise name">
                                            @if(isset($errors["exercise_{$index}_name"]))
                                                <div class="invalid-feedback">{{ $errors["exercise_{$index}_name"] }}</div>
                                            @endif
                                        </td>

                                        {{-- Sets --}}
                                        <td class="text-center align-middle">
                                            <div class="input-group input-group-sm">
                                                {{-- <button type="button" 
                                                        class="btn btn-outline-secondary"
                                                        wire:click="incrementValue({{ $index }}, 'sets', -1)"
                                                        {{ ($exercise['sets'] ?? 0) <= 1 ? 'disabled' : '' }}>
                                                    <i class="fas fa-minus"></i>
                                                </button> --}}
                                                <input type="number" 
                                                       class="form-control text-center"
                                                       wire:model.live.debounce.300ms="exercises.{{ $index }}.sets"
                                                       min="1" max="99"
                                                       style="width: 50px;">
                                                {{-- <button type="button" 
                                                        class="btn btn-outline-secondary"
                                                        wire:click="incrementValue({{ $index }}, 'sets', 1)">
                                                    <i class="fas fa-plus"></i>
                                                </button> --}}
                                                
                                            </div>
                                        </td>

                                        {{-- Reps --}}
                                        <td class="text-center align-middle">
                                            <div class="input-group input-group-sm">
                                                <input type="number" 
                                                       class="form-control text-center"
                                                       wire:model.live.debounce.300ms="exercises.{{ $index }}.reps"
                                                       min="1" max="999"
                                                       style="width: 50px;">
                                            </div>
                                        </td>

                                        {{-- Weight --}}
                                        <td class="text-center align-middle">
                                            <div class="input-group input-group-sm">
                                                <input type="number" 
                                                       class="form-control text-center"
                                                       wire:model.live.debounce.300ms="exercises.{{ $index }}.weight"
                                                       min="0" step="0.5"
                                                       style="width: 60px;">
                                            </div>
                                        </td>

                                        {{-- Rest Seconds --}}
                                        <td class="text-center align-middle">
                                            <div class="input-group input-group-sm">
                                                <input type="number" 
                                                       class="form-control text-center"
                                                       wire:model.live.debounce.300ms="exercises.{{ $index }}.rest_seconds"
                                                       min="0" step="15"
                                                       style="width: 60px;">
                                            </div>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="text-center align-middle">
                                            <div class="btn-group" role="group">
                                                {{-- Move Up --}}
                                                {{-- <button type="button" 
                                                        class="btn btn-outline-secondary btn-sm"
                                                        wire:click="moveUp({{ $index }})"
                                                        title="Move up"
                                                        {{ $index === 0 ? 'disabled' : '' }}>
                                                    <i class="fas fa-chevron-up"></i>
                                                </button> --}}
                                                
                                                {{-- Move Down --}}
                                                {{-- <button type="button" 
                                                        class="btn btn-outline-secondary btn-sm"
                                                        wire:click="moveDown({{ $index }})"
                                                        title="Move down"
                                                        {{ $index === count($exercises) - 1 ? 'disabled' : '' }}>
                                                    <i class="fas fa-chevron-down"></i>
                                                </button> --}}
                                                
                                                {{-- Remove --}}
                                                <button type="button" 
                                                        class="btn btn-outline-danger btn-sm"
                                                        wire:click="removeExercise({{ $index }})"
                                                        title="Remove exercise">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Success/Error Messages --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

