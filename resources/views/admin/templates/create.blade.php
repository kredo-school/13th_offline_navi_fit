@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Header -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
                    <h2 class="mb-0">Create New Template</h2>
                    <a href="{{ route('admin.templates.index') }}" class="btn btn-outline-secondary"
                        aria-label="Back to Templates" title="Back to Templates">
                        <i class="fas fa-arrow-left"></i> Back to Templates
                    </a>
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

                <form method="POST" action="{{ route('admin.templates.store') }}" id="templateForm" autocomplete="on">
                    @csrf

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
                                            id="name" name="name" value="{{ old('name') }}" required
                                            maxlength="100" placeholder="e.g. Full Body Beginner" aria-label="Template Name"
                                            aria-required="true">
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
                                            rows="3" maxlength="500" placeholder="Describe the template purpose, target, etc." aria-label="Description">{{ old('description') }}</textarea>
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
                                            <option value="easy" {{ old('difficulty') === 'easy' ? 'selected' : '' }}>Easy
                                            </option>
                                            <option value="normal"
                                                {{ old('difficulty', 'normal') === 'normal' ? 'selected' : '' }}>Normal
                                            </option>
                                            <option value="hard" {{ old('difficulty') === 'hard' ? 'selected' : '' }}>
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
                                            id="thumbnail_url" name="thumbnail_url" value="{{ old('thumbnail_url') }}"
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
                                                value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                                aria-label="Active Template">
                                            <label class="form-check-label" for="is_active">
                                                Active Template
                                            </label>
                                        </div>
                                        <div class="form-text">If checked, this template will be available for users.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Exercise Selection -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Exercises</h5>
                                    <button type="button" class="btn btn-sm btn-primary" id="addExerciseBtn"
                                        aria-label="Add Exercise" title="Add Exercise (JavaScript coming soon)" disabled>
                                        <i class="fas fa-plus"></i> Add Exercise (Coming soon)
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info small mb-3">
                                        Exercise selection and editing will be available soon. You can create the template
                                        now and add exercises later.
                                    </div>
                                    <div id="exercisesList">
                                        <!-- Dynamic exercises will be added here -->
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
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.templates.index') }}" class="btn btn-secondary me-2"
                                    aria-label="Cancel and go back" title="Cancel">Cancel</a>
                                <button type="submit" class="btn btn-primary" aria-label="Create Template"
                                    title="Create Template" id="submitBtn">
                                    <span id="submitBtnText"><i class="fas fa-save"></i> Create Template</span>
                                    <span id="submitBtnLoading" class="d-none"><span
                                            class="spinner-border spinner-border-sm me-1"></span>Saving...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
    </style>
    <script>
        // Prevent double submit and show loading
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('templateForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitBtnText = document.getElementById('submitBtnText');
            const submitBtnLoading = document.getElementById('submitBtnLoading');
            if (form && submitBtn) {
                form.addEventListener('submit', function() {
                    submitBtn.disabled = true;
                    if (submitBtnText && submitBtnLoading) {
                        submitBtnText.classList.add('d-none');
                        submitBtnLoading.classList.remove('d-none');
                    }
                });
            }
        });
    </script>
@endsection
