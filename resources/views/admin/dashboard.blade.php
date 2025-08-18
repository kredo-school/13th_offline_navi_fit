@extends('admin.layout')

@section('content')
    <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
        <div>
            <h2 class="h4 fw-bold mb-1">Admin Dashboard</h2>
            <p class="text-muted">Overview of your NaviFit system</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.templates.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i>New Template
            </a>
            <a href="{{ route('admin.exercises.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i>New Exercise
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0"><i class="fas fa-layer-group me-2"></i>Templates</h5>
                            <p class="display-6 fw-bold mb-0">{{ $templateCount }}</p>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.templates.index') }}" class="btn btn-light btn-sm w-100">
                            <i class="fas fa-arrow-right me-1"></i>Manage Templates
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card text-white bg-success h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0"><i class="fas fa-dumbbell me-2"></i>Exercises</h5>
                            <p class="display-6 fw-bold mb-0">{{ $exerciseCount }}</p>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="fas fa-dumbbell"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.exercises.index') }}" class="btn btn-light btn-sm w-100">
                            <i class="fas fa-arrow-right me-1"></i>Manage Exercises
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card text-white bg-info h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0"><i class="fas fa-users me-2"></i>Users</h5>
                            <p class="display-6 fw-bold mb-0">{{ $recentUsers->count() }}</p>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm w-100">
                            <i class="fas fa-arrow-right me-1"></i>Manage Users
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Recent Templates --}}
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-layer-group text-primary me-2"></i>Recent Templates</h5>
                    <a href="{{ route('admin.templates.index') }}" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse ($recentTemplates as $template)
                        <a href="{{ route('admin.templates.edit', $template) }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-file-alt text-primary me-2"></i>{{ $template->name }}
                            </span>
                            <span class="badge bg-light text-dark">{{ $template->created_at->format('Y-m-d') }}</span>
                        </a>
                    @empty
                        <div class="list-group-item text-center py-4">
                            <i class="fas fa-info-circle text-muted mb-2 fs-4"></i>
                            <p class="mb-0 text-muted">No templates available yet.</p>
                            <a href="{{ route('admin.templates.create') }}" class="btn btn-sm btn-primary mt-2">
                                Create Your First Template
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Recent Users --}}
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-users text-success me-2"></i>Recent Users</h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-success">
                        View All
                    </a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse ($recentUsers as $user)
                        <a href="{{ route('admin.users.show', $user) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-2">
                                        <i class="fas fa-user text-secondary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                </div>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-calendar-alt me-1"></i>{{ $user->created_at->format('Y-m-d') }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="list-group-item text-center py-4">
                            <i class="fas fa-info-circle text-muted mb-2 fs-4"></i>
                            <p class="mb-0 text-muted">No users registered yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        /* General styles for hover effects */
        .list-group-item-action {
            transition: all 0.2s;
        }

        .list-group-item-action:hover {
            transform: translateX(3px);
        }

        .card {
            transition: all 0.2s;
            border: none;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .display-6 {
            font-size: 2rem;
        }

        /* Add focus styles for accessibility */
        a:focus,
        button:focus {
            outline: 2px solid #0d6efd;
            outline-offset: 2px;
        }
    </style>
@endsection
