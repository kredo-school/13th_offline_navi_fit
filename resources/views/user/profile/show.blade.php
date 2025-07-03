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
                            <i class="fas fa-user text-white fs-2"></i>
                        </div>
                    </div>
                    <h1 class="h2 fw-bold text-dark mb-3">{{ __('Profile Information') }}</h1>
                    <p class="text-muted mb-2">
                        Your current profile settings and information
                    </p>
                </div>

                <!-- Profile Card -->
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4 p-sm-5">
                        
                        <!-- Basic Information -->
                        <div class="mb-5">
                            <h3 class="h5 fw-bold text-dark mb-4">Basic Information</h3>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="form-label fw-medium text-muted">Full Name</label>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 fw-medium">{{ auth()->user()->name }}</p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="form-label fw-medium text-muted">Age</label>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0">{{ $profile->age }} years old</p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="form-label fw-medium text-muted">Gender</label>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-capitalize">{{ $profile->gender }}</p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="form-label fw-medium text-muted">Height</label>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0">{{ $profile->height }} cm</p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="form-label fw-medium text-muted">Current Weight</label>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0">{{ $profile->weight }} kg</p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="form-label fw-medium text-muted">Fitness Level</label>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-capitalize">{{ str_replace('_', ' ', $profile->fitness_level) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="mb-5">
                            <h3 class="h5 fw-bold text-dark mb-4">Additional Information</h3>
                            
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="form-label fw-medium text-muted">Medical Conditions</label>
                                </div>
                                <div class="col-sm-8">
                                    @if($profile->medical_conditions)
                                        <p class="mb-0">{{ $profile->medical_conditions }}</p>
                                    @else
                                        <p class="mb-0 text-muted fst-italic">No medical conditions noted</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row pt-4">
                            <div class="col-sm-8 mb-3 mb-sm-0">
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100 rounded-2 fw-medium">
                                    <i class="fas fa-edit me-2"></i>
                                    Edit Profile
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100 rounded-2 fw-medium">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
