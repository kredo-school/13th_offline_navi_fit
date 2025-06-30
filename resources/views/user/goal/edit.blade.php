@extends('layouts.app')

@section('content')
    <div class="container py-5">
        {{-- Header --}}
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle mb-4"
                style="width: 56px; height: 56px;">
                <i class="fas fa-edit text-white fs-4"></i>
            </div>
            <h1 class="h2 fw-bold mb-3">Edit Goals</h1>
            <p class="text-muted mx-auto" style="max-width: 42rem;">
                Update your fitness goals to adjust your personalized journey.
            </p>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        {{-- Main Form --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('goal.update', $goal->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- Target Weight --}}
                            <div class="mb-4">
                                <label for="target_weight" class="form-label d-flex align-items-center">
                                    <i class="fas fa-weight text-primary me-2"></i>
                                    Target Weight <span class="text-danger ms-1">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" step="0.1"
                                        class="form-control rounded-2 @error('target_weight') is-invalid @enderror"
                                        id="target_weight" name="target_weight"
                                        value="{{ old('target_weight', $goal->target_weight) }}" placeholder="e.g., 65.0"
                                        required>
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
                                    id="target_date" name="target_date" value="{{ old('target_date', $goal->target_date) }}"
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
                                        value="{{ old('weekly_workout_frequency', $goal->weekly_workout_frequency) }}"
                                        placeholder="e.g., 3" min="1" max="7" required>
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
                                        value="{{ old('target_body_fat_percentage', $goal->target_body_fat_percentage) }}"
                                        placeholder="e.g., 15.00">
                                    <span class="input-group-text">%</span>
                                    @error('target_body_fat_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Progress Info --}}
                            <div class="alert alert-info mb-4">
                                <h6 class="alert-heading">
                                    <i class="fas fa-info-circle me-2"></i>Progress Status
                                </h6>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <small class="text-muted">Created:</small>
                                        <p class="mb-0">{{ $goal->created_at->format('F j, Y') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Last Updated:</small>
                                        <p class="mb-0">{{ $goal->updated_at->format('F j, Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="row g-3 pt-4">
                                <div class="col-md-4">
                                    <a href="#" class="btn btn-outline-secondary w-100 py-2">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary w-100 py-2">
                                        <i class="fas fa-save me-2"></i>Update Goals
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
