@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4 py-3">


        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <!-- Basic Information Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-4">Basic Information</h5>

                    <div class="row g-4">
                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control bg-light border-0 @error('full_name') is-invalid @enderror"
                                id="full_name" name="full_name" value="{{ old('full_name', Auth::user()->name) }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Age -->
                        <div class="col-md-6">
                            <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                            <input type="number" class="form-control bg-light border-0 @error('age') is-invalid @enderror"
                                id="age" name="age" value="{{ old('age', $profile->age) }}" min="13"
                                max="120" required>
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                            <select class="form-select bg-light border-0 @error('gender') is-invalid @enderror"
                                id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>
                                    Male</option>
                                <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>
                                    Female</option>
                                <option value="other" {{ old('gender', $profile->gender) == 'other' ? 'selected' : '' }}>
                                    Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Height -->
                        <div class="col-md-6">
                            <label for="height" class="form-label">Height ( cm ) <span
                                    class="text-danger">*</span></label>
                            <input type="number"
                                class="form-control bg-light border-0 @error('height') is-invalid @enderror" id="height"
                                name="height" value="{{ old('height', $profile->height) }}" min="50" max="300"
                                step="0.1" required>
                            @error('height')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Weight -->
                        <div class="col-md-6">
                            <label for="weight" class="form-label">Current Weight <span
                                    class="text-danger">*</span></label>
                            <input type="number"
                                class="form-control bg-light border-0 @error('weight') is-invalid @enderror" id="weight"
                                name="weight" value="{{ old('weight', $profile->weight) }}" min="20" max="500"
                                step="0.1" required>
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Exercise Experience Level -->
                        <div class="col-md-6">
                            <label for="fitness_level" class="form-label">Exercise Experience Level <span
                                    class="text-danger">*</span></label>
                            <select class="form-select bg-light border-0 @error('fitness_level') is-invalid @enderror"
                                id="fitness_level" name="fitness_level" required>
                                <option value="">Select Level</option>
                                <option value="beginner"
                                    {{ old('fitness_level', $profile->fitness_level) == 'beginner' ? 'selected' : '' }}>
                                    Beginner</option>
                                <option value="intermediate"
                                    {{ old('fitness_level', $profile->fitness_level) == 'intermediate' ? 'selected' : '' }}>
                                    Intermediate</option>
                                <option value="advanced"
                                    {{ old('fitness_level', $profile->fitness_level) == 'advanced' ? 'selected' : '' }}>
                                    Advanced</option>
                            </select>
                            @error('fitness_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-4">Additional Information</h5>

                    <div>
                        <label for="medical_conditions" class="form-label">Medical Conditions or Notes (Optional)</label>
                        <textarea class="form-control bg-light border-0 @error('medical_conditions') is-invalid @enderror"
                            id="medical_conditions" name="medical_conditions" rows="4"
                            placeholder="Enter any medical conditions, injuries, or other notes...">{{ old('medical_conditions', $profile->medical_conditions) }}</textarea>
                        @error('medical_conditions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('home') }}" class="btn btn-light px-4">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">Save</button>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
@endsection
