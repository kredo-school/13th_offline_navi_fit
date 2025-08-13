@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Header -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
                    <h2 class="mb-0">Edit Template: {{ $template->name }}</h2>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.templates.show', $template) }}" class="btn btn-outline-secondary"
                            aria-label="View Template" title="View Template">
                            <i class="fas fa-eye"></i> View Template
                        </a>
                        <a href="{{ route('admin.templates.index') }}" class="btn btn-outline-secondary"
                            aria-label="Back to Templates" title="Back to Templates">
                            <i class="fas fa-arrow-left"></i> Back to Templates
                        </a>
                    </div>
                </div>

                <!-- Form -->
                <!-- Feedback Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.templates.update', $template) }}" id="templateForm"
                    autocomplete="on">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Left Column - Template Info -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Template Information</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Template Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $template->name) }}"
                                            required maxlength="100" placeholder="e.g. Full Body Beginner"
                                            aria-label="Template Name" aria-required="true">
                                        <div class="form-text">Enter a unique name for this template (max 100 characters).
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            rows="3" maxlength="500" placeholder="Describe the template purpose, target, etc." aria-label="Description">{{ old('description', $template->description) }}</textarea>
                                        <div class="form-text">Optional. Max 500 characters.</div>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Difficulty -->
                                    <div class="mb-3">
                                        <label for="difficulty" class="form-label">Difficulty</label>
                                        <select class="form-select @error('difficulty') is-invalid @enderror"
                                            id="difficulty" name="difficulty" aria-label="Difficulty">
                                            <option value="easy"
                                                {{ old('difficulty', $template->difficulty) === 'easy' ? 'selected' : '' }}>
                                                Easy</option>
                                            <option value="normal"
                                                {{ old('difficulty', $template->difficulty) === 'normal' ? 'selected' : '' }}>
                                                Normal</option>
                                            <option value="hard"
                                                {{ old('difficulty', $template->difficulty) === 'hard' ? 'selected' : '' }}>
                                                Hard</option>
                                        </select>
                                        <div class="form-text">Select the overall difficulty level.</div>
                                        @error('difficulty')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Thumbnail URL -->
                                    <div class="mb-3">
                                        <label for="thumbnail_url" class="form-label">Thumbnail URL</label>
                                        <input type="url"
                                            class="form-control @error('thumbnail_url') is-invalid @enderror"
                                            id="thumbnail_url" name="thumbnail_url"
                                            value="{{ old('thumbnail_url', $template->thumbnail_url) }}"
                                            placeholder="https://example.com/image.jpg" aria-label="Thumbnail URL">
                                        <div class="form-text">Optional. Enter a valid image URL (jpg, png, etc.).</div>
                                        @error('thumbnail_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Is Active -->
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                                value="1"
                                                {{ old('is_active', $template->is_active) ? 'checked' : '' }}
                                                aria-label="Active Template">
                                            <label class="form-check-label" for="is_active">
                                                Active Template
                                            </label>
                                        </div>
                                        <div class="form-text">If checked, this template will be available for users.</div>
                                    </div>

                                    <!-- Template Stats -->
                                    <div class="alert alert-info">
                                        <h6>Template Stats</h6>
                                        <div class="row">
                                            <div class="col-6">
                                                <small><strong>Created:</strong><br>{{ $template->created_at->format('M d, Y') }}</small>
                                            </div>
                                            <div class="col-6">
                                                <small><strong>Last
                                                        Updated:</strong><br>{{ $template->updated_at->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Exercise Management -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Exercises ({{ $template->templateExercises->count() }})</h5>
                                    <button type="button" class="btn btn-sm btn-primary" id="addExerciseBtn"
                                        aria-label="Add Exercise" title="Add Exercise (JavaScript coming soon)" disabled>
                                        <i class="fas fa-plus"></i> Add Exercise (Coming soon)
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info small mb-3">
                                        You can edit exercises below. Adding new exercises is coming soon.
                                    </div>
                                    <div id="exercisesList">
                                        @foreach ($template->templateExercises->sortBy('order_index') as $index => $templateExercise)
                                            <div class="exercise-item border rounded p-3 mb-3"
                                                data-index="{{ $index }}" tabindex="0"
                                                aria-label="Exercise {{ $templateExercise->exercise->name }}">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div>
                                                        <h6 class="mb-1">{{ $templateExercise->exercise->name }}</h6>
                                                        <small class="text-muted">
                                                            @if ($templateExercise->exercise->muscle_groups)
                                                                {{ implode(', ', $templateExercise->exercise->muscle_groups) }}
                                                            @endif
                                                        </small>
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-secondary me-2"
                                                            title="Order">{{ $templateExercise->order_index }}</span>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger remove-exercise"
                                                            aria-label="Remove exercise" title="Remove exercise">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="exercises[{{ $index }}][exercise_id]"
                                                    value="{{ $templateExercise->exercise_id }}">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Sets</label>
                                                        <input type="number" class="form-control"
                                                            name="exercises[{{ $index }}][sets]"
                                                            value="{{ old('exercises.' . $index . '.sets', $templateExercise->sets) }}"
                                                            min="1" max="10" aria-label="Sets">
                                                        <div class="form-text">1-10</div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Reps</label>
                                                        <input type="number" class="form-control"
                                                            name="exercises[{{ $index }}][reps]"
                                                            value="{{ old('exercises.' . $index . '.reps', $templateExercise->reps) }}"
                                                            min="1" max="100" aria-label="Reps">
                                                        <div class="form-text">1-100</div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Rest (sec)</label>
                                                        <input type="number" class="form-control"
                                                            name="exercises[{{ $index }}][rest_seconds]"
                                                            value="{{ old('exercises.' . $index . '.rest_seconds', $templateExercise->rest_seconds) }}"
                                                            min="0" max="600" aria-label="Rest seconds">
                                                        <div class="form-text">0-600 sec</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('exercises')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.templates.show', $template) }}" class="btn btn-secondary me-2"
                                    aria-label="Cancel and go back" title="Cancel">Cancel</a>
                                <button type="submit" class="btn btn-primary" aria-label="Update Template"
                                    title="Update Template" id="submitBtn">
                                    <span id="submitBtnText"><i class="fas fa-save"></i> Update Template</span>
                                    <span id="submitBtnLoading" class="d-none"><span
                                            class="spinner-border spinner-border-sm me-1"></span>Saving...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Delete Form -->
                <div class="row mt-3">
                    <div class="col-12">
                        <form method="POST" action="{{ route('admin.templates.destroy', $template) }}"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" aria-label="Delete Template"
                                title="Delete Template" id="deleteBtn"
                                onclick="return confirm('Are you sure you want to delete this template? This action cannot be undone.')">
                                <span id="deleteBtnText"><i class="fas fa-trash"></i> Delete Template</span>
                                <span id="deleteBtnLoading" class="d-none"><span
                                        class="spinner-border spinner-border-sm me-1"></span>Deleting...</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Responsive form section spacing */
        @media (max-width: 767px) {
            .card {
                margin-bottom: 1.5rem;
            }
        }

        /* Button hover/focus */
        .btn:focus,
        .btn:hover {
            opacity: 0.92;
        }

        .exercise-item {
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .exercise-item:hover,
        .exercise-item:focus-within {
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.12);
            transform: translateY(-2px) scale(1.01);
            z-index: 2;
        }
    </style>
    <script>
        // Prevent double submit and show loading
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('templateForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitBtnText = document.getElementById('submitBtnText');
            const submitBtnLoading = document.getElementById('submitBtnLoading');
            const deleteBtn = document.getElementById('deleteBtn');
            const deleteBtnText = document.getElementById('deleteBtnText');
            const deleteBtnLoading = document.getElementById('deleteBtnLoading');
            if (form && submitBtn) {
                form.addEventListener('submit', function() {
                    submitBtn.disabled = true;
                    if (submitBtnText && submitBtnLoading) {
                        submitBtnText.classList.add('d-none');
                        submitBtnLoading.classList.remove('d-none');
                    }
                });
            }
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function() {
                    deleteBtn.disabled = true;
                    if (deleteBtnText && deleteBtnLoading) {
                        deleteBtnText.classList.add('d-none');
                        deleteBtnLoading.classList.remove('d-none');
                    }
                });
            }
        });
    </script>
@endsection
