@extends('admin.layout')

@section('content')
    <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
        <div>
            <h2 class="h4 fw-bold">Admin Dashboard</h2>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body d-flex flex-column align-items-start">
                    <h5 class="card-title mb-2 fs-5 fs-md-4"><i class="fas fa-layer-group me-2"></i>Total Templates</h5>
                    <p class="card-text fs-4 fs-md-3 mb-3">{{ $templateCount }} entries</p>
                    <div class="d-flex flex-column flex-sm-row gap-2 w-100">
                        <a href="{{ route('admin.templates.create') }}" class="btn btn-light btn-sm fw-semibold flex-fill"
                            aria-label="Create Template" title="Create a new template"><i
                                class="fas fa-plus me-1"></i>Create Template</a>
                        <a href="{{ route('admin.templates.index') }}"
                            class="btn btn-outline-light btn-sm fw-semibold flex-fill" aria-label="View Templates"
                            title="View all templates"><i class="fas fa-layer-group me-1"></i>View</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card text-white bg-success h-100 shadow-sm">
                <div class="card-body d-flex flex-column align-items-start">
                    <h5 class="card-title mb-2 fs-5 fs-md-4"><i class="fas fa-dumbbell me-2"></i>Total Exercises</h5>
                    <p class="card-text fs-4 fs-md-3 mb-3">{{ $exerciseCount }} entries</p>
                    <div class="d-flex flex-column flex-sm-row gap-2 w-100">
                        <a href="{{ route('admin.exercises.create') }}" class="btn btn-light btn-sm fw-semibold flex-fill"
                            aria-label="Create Exercise" title="Create a new exercise"><i
                                class="fas fa-plus me-1"></i>Create Exercise</a>
                        <a href="{{ route('admin.exercises.index') }}"
                            class="btn btn-outline-light btn-sm fw-semibold flex-fill" aria-label="View Exercises"
                            title="View all exercises"><i class="fas fa-dumbbell me-1"></i>View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Templates --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-semibold"><i class="fas fa-clock me-2"></i>Recently Created Templates</div>
        <ul class="list-group list-group-flush">
            @forelse ($recentTemplates as $template)
                <li class="list-group-item d-flex justify-content-between align-items-center list-hover-effect"
                    tabindex="0">
                    <span>
                        <i class="fas fa-file-alt text-primary me-2"></i>{{ $template->name }}
                    </span>
                    <span class="text-muted small">{{ $template->created_at->format('Y-m-d') }}</span>
                </li>
            @empty
                <li class="list-group-item text-muted">No templates available.</li>
            @endforelse
        </ul>
    </div>

    {{-- Recent Users --}}
    <div class="card shadow-sm">
        <div class="card-header fw-semibold"><i class="fas fa-users me-2"></i>Recently Registered Users</div>
        <ul class="list-group list-group-flush">
            @forelse ($recentUsers as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center flex-column flex-md-row list-hover-effect"
                    tabindex="0">
                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">
                        <i class="fas fa-user-circle text-secondary me-2"></i>
                        <span class="fw-semibold">{{ $user->name }}</span>
                        <span class="text-muted small">{{ $user->email }}</span>
                    </div>
                    <span class="text-muted small mt-1 mt-md-0"><i
                            class="fas fa-calendar-alt me-1"></i>{{ $user->created_at->format('Y-m-d') }}</span>
                </li>
            @empty
                <li class="list-group-item text-muted">No users found.</li>
            @endforelse
        </ul>
        <div class="card-footer text-end">
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary" aria-label="Manage Users"
                title="Go to user management">
                <i class="fas fa-users-cog me-1"></i>Manage Users
            </a>
        </div>
    </div>
    <style>
        /* General styles for hover effects */
        .list-hover-effect:hover,
        .list-hover-effect:focus {
            background: #f1f3f5;
            transition: background 0.2s;
            cursor: pointer;
        }

        .card {
            transition: box-shadow 0.2s;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.12);
        }
    </style>
@endsection
