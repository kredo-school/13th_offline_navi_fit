@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>My Workout Templates</h2>
                    <a href="{{ route('templates.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create New Template
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" action="{{ route('templates.index') }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Search templates..." value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('templates.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i> Clear
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Success/Error Messages -->
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

                <!-- Templates List -->
                @if ($templates->count() > 0)
                    <div class="row">
                        @foreach ($templates as $template)
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">{{ $template->name }}</h5>
                                        <span
                                            class="badge bg-{{ $template->difficulty === 'easy' ? 'success' : ($template->difficulty === 'normal' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($template->difficulty) }}
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        @if ($template->description)
                                            <p class="card-text">{{ Str::limit($template->description, 100) }}</p>
                                        @endif

                                        <div class="row text-center mb-3">
                                            <div class="col-4">
                                                <small class="text-muted">Exercises</small>
                                                <div class="fw-bold">{{ $template->template_exercises_count }}</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Duration</small>
                                                <div class="fw-bold">~{{ $template->estimated_duration ?? 45 }} min</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Calories</small>
                                                <div class="fw-bold">~{{ $template->estimated_calories ?? 360 }} kcal</div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                Created: {{ $template->created_at->format('M d, Y') }}
                                            </small>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('templates.show', $template) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i> Details
                                                </a>
                                                <a href="{{ route('templates.edit', $template) }}"
                                                    class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form method="POST" action="{{ route('templates.destroy', $template) }}"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this template?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $templates->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-dumbbell fa-3x text-muted mb-3"></i>
                            <h4>No Workout Templates Yet</h4>
                            <p class="text-muted">Create your first workout template to get started</p>
                            <a href="{{ route('templates.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create Your First Template
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
