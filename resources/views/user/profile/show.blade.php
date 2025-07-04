@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <!-- Header -->
                <div class="text-center mb-5">
                    <div class="d-flex justify-content-center mb-4">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 56px; height: 56px;">
                            <i class="fas fa-user text-white fs-2"></i>
                        </div>
                    </div>
                    <h1 class="h2 fw-bold text-dark mb-3">{{ __('Profile Information') }}</h1>
                    <p class="text-muted mb-2">
                        Your current profile information
                    </p>
                </div>

                <!-- Profile Card -->
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4 p-sm-5">
                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Basic Information</h5>

                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label fw-medium text-muted">Full Name</label>
                                    <div class="form-control-plaintext">{{ Auth::user()->name }}</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-medium text-muted">Age</label>
                                    <div class="form-control-plaintext">{{ $profile->age }} years</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label fw-medium text-muted">Gender</label>
                                    <div class="form-control-plaintext">{{ ucfirst($profile->gender) }}</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-medium text-muted">Height</label>
                                    <div class="form-control-plaintext">{{ $profile->height }} cm</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="form-label fw-medium text-muted">Current Weight</label>
                                    <div class="form-control-plaintext">{{ $profile->weight }} kg</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-medium text-muted">Fitness Level</label>
                                    <div class="form-control-plaintext">{{ ucfirst($profile->fitness_level) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        @if ($profile->medical_conditions)
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Additional Information</h5>
                                <div class="mb-3">
                                    <label class="form-label fw-medium text-muted">Medical Conditions or Notes</label>
                                    <div class="form-control-plaintext">{{ $profile->medical_conditions }}</div>
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="row pt-4">
                            <div class="col-sm-8 mb-3 mb-sm-0">
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100 rounded-2 fw-medium">
                                    <i class="fas fa-edit me-2"></i>
                                    Edit Profile
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('dashboard') }}"
                                    class="btn btn-outline-secondary w-100 rounded-2 fw-medium">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
