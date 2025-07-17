@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2>{{ $template->name }}</h2>
                        <span
                            class="badge bg-{{ $template->difficulty === 'easy' ? 'success' : ($template->difficulty === 'normal' ? 'warning' : 'danger') }} me-2">
                            {{ ucfirst($template->difficulty) }}
                        </span>
                        @if ($template->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('templates.index') }}" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-arrow-left"></i> Back to Templates
                        </a>
                        @if ($template->created_by === Auth::id())
                            <a href="{{ route('templates.edit', $template) }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('templates.destroy', $template) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this template?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Template Overview -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Template Overview</h5>
                            </div>
                            <div class="card-body">
                                @if ($template->description)
                                    <p class="mb-3">{{ $template->description }}</p>
                                @endif

                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="fas fa-dumbbell fa-2x text-primary mb-2"></i>
                                            <div class="h4 mb-0">{{ $template->templateExercises->count() }}</div>
                                            <small class="text-muted">Exercises</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="fas fa-clock fa-2x text-info mb-2"></i>
                                            <div class="h4 mb-0">{{ $estimatedDuration }}</div>
                                            <small class="text-muted">Minutes</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="fas fa-fire fa-2x text-danger mb-2"></i>
                                            <div class="h4 mb-0">{{ $estimatedCalories }}</div>
                                            <small class="text-muted">Calories</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="fas fa-calendar fa-2x text-success mb-2"></i>
                                            <div class="h4 mb-0">{{ $template->created_at->format('M d') }}</div>
                                            <small class="text-muted">Created</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Template Thumbnail -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Thumbnail</h5>
                            </div>
                            <div class="card-body text-center">
                                @if ($template->thumbnail_url)
                                    <img src="{{ $template->thumbnail_url }}" alt="{{ $template->name }}"
                                        class="img-fluid rounded" style="max-height: 200px;">
                                @else
                                    <div class="bg-light rounded p-4">
                                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                        <div class="text-muted">No thumbnail</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exercises List -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Exercises ({{ $template->templateExercises->count() }})</h5>
                    </div>
                    <div class="card-body">
                        @if ($template->templateExercises->count() > 0)
                            <div class="row">
                                @foreach ($template->templateExercises->sortBy('order_index') as $templateExercise)
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-left-primary">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div class="exercise-info">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <span
                                                                class="badge bg-secondary me-2">{{ $templateExercise->order_index }}</span>
                                                            <h6 class="mb-0">{{ $templateExercise->exercise->name }}</h6>
                                                        </div>

                                                        @if ($templateExercise->exercise->muscle_groups)
                                                            <div class="mb-2">
                                                                @foreach ($templateExercise->exercise->muscle_groups as $muscleGroup)
                                                                    <span
                                                                        class="badge bg-light text-dark me-1">{{ $muscleGroup }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endif

                                                        <div class="exercise-params">
                                                            <div class="row text-center">
                                                                <div class="col-4">
                                                                    <div class="text-primary fw-bold">
                                                                        {{ $templateExercise->sets }}</div>
                                                                    <small class="text-muted">Sets</small>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="text-info fw-bold">
                                                                        {{ $templateExercise->reps }}</div>
                                                                    <small class="text-muted">Reps</small>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="text-warning fw-bold">
                                                                        {{ $templateExercise->rest_seconds }}s</div>
                                                                    <small class="text-muted">Rest</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if ($templateExercise->exercise->image_path || $templateExercise->exercise->image_url)
                                                        <div class="exercise-image">
                                                            @if ($templateExercise->exercise->image_path)
                                                                <img src="{{ asset('storage/exercises/' . $templateExercise->exercise->image_path) }}"
                                                                    alt="{{ $templateExercise->exercise->name }}"
                                                                    class="img-thumbnail"
                                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                                            @elseif($templateExercise->exercise->image_url)
                                                                <img src="{{ $templateExercise->exercise->image_url }}"
                                                                    alt="{{ $templateExercise->exercise->name }}"
                                                                    class="img-thumbnail"
                                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-dumbbell fa-3x text-muted mb-3"></i>
                                <h5>No Exercises Added</h5>
                                <p class="text-muted">This template doesn't have any exercises yet.</p>
                                @if ($template->created_by === Auth::id())
                                    <a href="{{ route('templates.edit', $template) }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Exercises
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                @if ($template->templateExercises->count() > 0)
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#" class="btn btn-success btn-lg w-100">
                                        <i class="fas fa-play"></i> Start Workout
                                    </a>
                                    <small class="text-muted d-block mt-1">Begin this workout now</small>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" class="btn btn-info btn-lg w-100">
                                        <i class="fas fa-copy"></i> Duplicate Template
                                    </a>
                                    <small class="text-muted d-block mt-1">Create a copy of this template</small>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" class="btn btn-warning btn-lg w-100">
                                        <i class="fas fa-share"></i> Share Template
                                    </a>
                                    <small class="text-muted d-block mt-1">Share with other users</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Template Details -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Template Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Created By:</strong></td>
                                        <td>{{ $template->creator->name ?? 'Unknown' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Created:</strong></td>
                                        <td>{{ $template->created_at->format('F j, Y \a\t g:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Last Updated:</strong></td>
                                        <td>{{ $template->updated_at->format('F j, Y \a\t g:i A') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Difficulty:</strong></td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $template->difficulty === 'easy' ? 'success' : ($template->difficulty === 'normal' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($template->difficulty) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            @if ($template->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Template ID:</strong></td>
                                        <td><code>{{ $template->id }}</code></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .border-left-primary {
            border-left: 4px solid #007bff !important;
        }

        .exercise-params {
            font-size: 0.9rem;
        }

        .exercise-image img {
            transition: transform 0.2s;
        }

        .exercise-image img:hover {
            transform: scale(1.1);
        }

        .card-body .row.text-center>div {
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .exercise-image {
                display: none;
            }
        }
    </style>
@endpush
