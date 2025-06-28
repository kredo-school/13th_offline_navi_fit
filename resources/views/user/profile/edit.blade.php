@extends('layouts.app')

@section('content')
    @php($hideNavigation = true)

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <!-- Header -->
                <div class="text-center mb-5">
                    <div class="d-flex justify-content-center mb-4">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 56px; height: 56px;">
                            <i class="fas fa-user-edit text-white fs-2"></i>
                        </div>
                    </div>
                    <h1 class="h2 fw-bold text-dark mb-3">{{ __('Edit Profile') }}</h1>
                    <p class="text-muted mb-2">
                        Update your information to keep your training plan optimized
                    </p>
                    <p class="small text-muted">
                        Fields marked with <span class="text-danger">*</span> are required
                    </p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Form Card -->
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4 p-sm-5">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <!-- Full Name -->
                            <div class="mb-4">
                                <label for="full_name" class="form-label fw-medium">
                                    Full Name <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control rounded-2 @error('full_name') is-invalid @enderror" id="full_name"
                                    name="full_name" value="{{ old('full_name', Auth::user()->name) }}"
                                    placeholder="John Smith" maxlength="50" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Age and Gender Row -->
                            <div class="row mb-4">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="age" class="form-label fw-medium">
                                        Age <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <input type="number"
                                            class="form-control rounded-2 @error('age') is-invalid @enderror" id="age"
                                            name="age" value="{{ old('age', $profile->age) }}" placeholder="25"
                                            min="13" max="120" required>
                                        <span
                                            class="position-absolute top-50 end-0 translate-middle-y pe-3 text-muted small">years</span>
                                        @error('age')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="gender" class="form-label fw-medium">
                                        Gender <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select rounded-2 @error('gender') is-invalid @enderror"
                                        id="gender" name="gender" required>
                                        <option value="">Select gender</option>
                                        <option value="male"
                                            {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female"
                                            {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="other"
                                            {{ old('gender', $profile->gender) == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Height and Weight Row -->
                            <div class="row mb-4">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="height" class="form-label fw-medium">
                                        Height <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <input type="number"
                                            class="form-control rounded-2 @error('height') is-invalid @enderror"
                                            id="height" name="height" value="{{ old('height', $profile->height) }}"
                                            placeholder="170" min="50" max="300" step="0.1" required>
                                        <span
                                            class="position-absolute top-50 end-0 translate-middle-y pe-3 text-muted small">cm</span>
                                        @error('height')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="weight" class="form-label fw-medium">
                                        Current Weight <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <input type="number"
                                            class="form-control rounded-2 @error('weight') is-invalid @enderror"
                                            id="weight" name="weight" value="{{ old('weight', $profile->weight) }}"
                                            placeholder="65.0" min="20" max="500" step="0.1" required>
                                        <span
                                            class="position-absolute top-50 end-0 translate-middle-y pe-3 text-muted small">kg</span>
                                        @error('weight')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Fitness Level -->
                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    Fitness Level <span class="text-danger">*</span>
                                </label>
                                <div class="mt-3">
                                    <div class="border rounded-2 p-3 mb-3" id="fitness-beginner">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fitness_level"
                                                value="beginner" id="beginner"
                                                {{ old('fitness_level', $profile->fitness_level) == 'beginner' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="beginner">
                                                <div class="fw-medium text-dark">Beginner</div>
                                                <div class="small text-muted">No/minimal exercise experience</div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="border rounded-2 p-3 mb-3" id="fitness-intermediate">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fitness_level"
                                                value="intermediate" id="intermediate"
                                                {{ old('fitness_level', $profile->fitness_level) == 'intermediate' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="intermediate">
                                                <div class="fw-medium text-dark">Intermediate</div>
                                                <div class="small text-muted">Regular exercise routine</div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="border rounded-2 p-3 mb-3" id="fitness-advanced">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fitness_level"
                                                value="advanced" id="advanced"
                                                {{ old('fitness_level', $profile->fitness_level) == 'advanced' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="advanced">
                                                <div class="fw-medium text-dark">Advanced</div>
                                                <div class="small text-muted">Extensive exercise experience</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('fitness_level')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Additional Information -->
                            <div class="mb-5">
                                <label class="form-label fw-medium">
                                    Additional Information
                                </label>
                                <div class="mt-3">
                                    <!-- Medical Conditions -->
                                    <div class="mb-4">
                                        <label for="medical_conditions" class="form-label">Medical Conditions or
                                            Notes</label>
                                        <textarea class="form-control rounded-2 @error('medical_conditions') is-invalid @enderror" id="medical_conditions"
                                            name="medical_conditions" rows="3"
                                            placeholder="Please describe any medical conditions, injuries, or physical limitations that might affect your exercise routine...">{{ old('medical_conditions', $profile->medical_conditions) }}</textarea>
                                        <div class="form-text">This information helps us create a safer workout plan for
                                            you</div>
                                        @error('medical_conditions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row pt-4">
                                <div class="col-sm-8 mb-3 mb-sm-0">
                                    <button type="submit" class="btn btn-primary w-100 rounded-2 fw-medium">
                                        <i class="fas fa-save me-2"></i>
                                        Update Profile
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                    <a href="{{ route('dashboard') }}"
                                        class="btn btn-outline-secondary w-100 rounded-2 fw-medium">
                                        <i class="fas fa-times me-2"></i>
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add visual feedback for fitness level selection
        document.addEventListener('DOMContentLoaded', function() {
            const fitnessRadios = document.querySelectorAll('input[name="fitness_level"]');

            function updateFitnessSelection() {
                document.querySelectorAll('[id^="fitness-"]').forEach(option => {
                    option.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10');
                    option.classList.add('border');
                });

                const checked = document.querySelector('input[name="fitness_level"]:checked');
                if (checked) {
                    const container = checked.closest('[id^="fitness-"]');
                    container.classList.remove('border');
                    container.classList.add('border-primary', 'bg-primary', 'bg-opacity-10');
                }
            }

            fitnessRadios.forEach(radio => {
                radio.addEventListener('change', updateFitnessSelection);
            });

            // Initial check
            updateFitnessSelection();
        });
    </script>
@endsection
