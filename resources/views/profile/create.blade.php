@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Create Profile') }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.store') }}">
                            @csrf

                            <h5 class="mb-3">Basic Information</h5>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="full_name" class="form-label">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                        id="full_name" name="full_name" value="{{ old('full_name', Auth::user()->name) }}"
                                        required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('age') is-invalid @enderror"
                                        id="age" name="age" value="{{ old('age') }}" min="13"
                                        max="120" required>
                                    @error('age')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                        name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="height" class="form-label">Height (cm) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('height') is-invalid @enderror"
                                        id="height" name="height" value="{{ old('height') }}" min="50"
                                        max="300" step="0.1" required>
                                    @error('height')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="weight" class="form-label">Current Weight (kg) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                        id="weight" name="weight" value="{{ old('weight') }}" min="20"
                                        max="500" step="0.1" required>
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="fitness_level" class="form-label">Exercise Experience Level <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('fitness_level') is-invalid @enderror"
                                        id="fitness_level" name="fitness_level" required>
                                        <option value="">Select Level</option>
                                        <option value="beginner"
                                            {{ old('fitness_level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate"
                                            {{ old('fitness_level') == 'intermediate' ? 'selected' : '' }}>Intermediate
                                        </option>
                                        <option value="advanced"
                                            {{ old('fitness_level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                    </select>
                                    @error('fitness_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h5 class="mb-3 mt-4">Additional Information</h5>

                            <div class="mb-3">
                                <label for="medical_conditions" class="form-label">Medical Conditions or Notes
                                    (Optional)</label>
                                <textarea class="form-control @error('medical_conditions') is-invalid @enderror" id="medical_conditions"
                                    name="medical_conditions" rows="4" placeholder="Enter any medical conditions, injuries, or other notes...">{{ old('medical_conditions') }}</textarea>
                                @error('medical_conditions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('home') }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
