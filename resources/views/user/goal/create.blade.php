@extends('layouts.app')

@section('content')
    <div class="container py-5">
        {{-- Header --}}
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle mb-4"
                style="width: 56px; height: 56px;">
                <i class="fas fa-bullseye text-white fs-4"></i>
            </div>
            <h1 class="h2 fw-bold mb-3">Goal Setting</h1>
            <p class="text-muted mx-auto" style="max-width: 42rem;">
                Set your fitness goals to establish your personalized journey. These metrics will guide your progress
                tracking.
            </p>
        </div>

        {{-- Progress Indicator --}}
        <div class="mx-auto mb-5" style="max-width: 42rem;">
            <div class="position-relative">
                {{-- Progress Line Background --}}
                <div class="position-absolute start-0 w-100 bg-secondary bg-opacity-25" style="height: 2px; top: 20px;">
                </div>
                {{-- Progress Line Active (50% for step 2) --}}
                <div class="position-absolute start-0 w-50 bg-primary" style="height: 2px; top: 20px;"></div>

                <div class="d-flex justify-content-between position-relative">
                    {{-- Step 1: Profile (Completed) --}}
                    <div class="text-center">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto border border-2 border-success"
                            style="width: 40px; height: 40px;">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="d-block mt-2 small fw-medium text-dark">Profile</span>
                    </div>

                    {{-- Step 2: Goals (Current) --}}
                    <div class="text-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto border border-2 border-primary"
                            style="width: 40px; height: 40px;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <span class="d-block mt-2 small fw-medium text-primary">Goals</span>
                    </div>

                    {{-- Step 3: Dashboard (Future) --}}
                    <div class="text-center">
                        <div class="bg-white text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto border border-2"
                            style="width: 40px; height: 40px;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <span class="d-block mt-2 small fw-medium text-muted">Dashboard</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Form --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('goal.store') }}">
                            @csrf

                            {{-- Target Weight --}}
                            <div class="mb-4">
                                <label for="target_weight" class="form-label d-flex align-items-center">
                                    <i class="fas fa-weight text-primary me-2"></i>
                                    Target Weight <span class="text-danger ms-1">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" step="0.1"
                                        class="form-control rounded-2 @error('target_weight') is-invalid @enderror"
                                        id="target_weight" name="target_weight" value="{{ old('target_weight') }}"
                                        placeholder="e.g., 65.0" required>
                                    <span class="input-group-text">kg</span>
                                    @error('target_weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Achievement Date --}}
                            <div class="mb-4">
                                <label for="target_date" class="form-label d-flex align-items-center">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    Achievement Date <span class="text-danger ms-1">*</span>
                                </label>
                                <input type="date"
                                    class="form-control rounded-2 @error('target_date') is-invalid @enderror"
                                    id="target_date" name="target_date"
                                    value="{{ old('target_date', date('Y-m-d', strtotime('+3 months'))) }}"
                                    min="{{ date('Y-m-d') }}" required>
                                @error('target_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Weekly Exercise Sessions --}}
                            <div class="mb-4">
                                <label for="weekly_workout_frequency" class="form-label d-flex align-items-center">
                                    <i class="fas fa-dumbbell text-primary me-2"></i>
                                    Weekly Workout Frequency <span class="text-danger ms-1">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number"
                                        class="form-control rounded-2 @error('weekly_workout_frequency') is-invalid @enderror"
                                        id="weekly_workout_frequency" name="weekly_workout_frequency"
                                        value="{{ old('weekly_workout_frequency', 3) }}" placeholder="e.g., 3"
                                        min="1" max="7" required>
                                    <span class="input-group-text">sessions/week</span>
                                    @error('weekly_workout_frequency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Target Body Fat Percentage --}}
                            <div class="mb-5">
                                <label for="target_body_fat_percentage" class="form-label d-flex align-items-center">
                                    <i class="fas fa-chart-line text-primary me-2"></i>
                                    Target Body Fat Percentage
                                </label>
                                <div class="input-group">
                                    <input type="number" step="0.01"
                                        class="form-control rounded-2 @error('target_body_fat_percentage') is-invalid @enderror"
                                        id="target_body_fat_percentage" name="target_body_fat_percentage"
                                        value="{{ old('target_body_fat_percentage') }}" placeholder="e.g., 15.00">
                                    <span class="input-group-text">%</span>
                                    @error('target_body_fat_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="row g-3 pt-4">
                                <div class="col-md-4">
                                    <a href="#" class="btn btn-outline-secondary w-100 py-2">
                                        <i class="fas fa-arrow-left me-2"></i>Back
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary w-100 py-2">
                                        <i class="fas fa-check me-2"></i>Set Goals
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
