@extends('layouts.app')

@section('title', 'menu')

@section('content')
@php $hideNavigation = true; @endphp {{--ここに一行追加--}}

    <body class="bg-light">
        <!-- Header -->
        <div class="bg-white shadow-sm border-bottom">
            <div class="container-xxl py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <button type="button" class="btn btn-light rounded-circle p-2" 
                            onclick="history.back()" aria-label="Go Back">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <div>
                            <h1 class="h5 mb-0 fw-semibold">{{ $menu->name }}</h1>
                            <p class="small text-muted mb-0">Menu Details</p>
                        </div>
                    </div>

                    <!-- Desktop Action Buttons -->
                    <div class="d-none d-md-flex gap-2">
                        <a href="{{ route('menus.edit', $menu) }}" class="btn btn-primary d-flex align-items-center gap-2"
                            aria-label="Edit Menu">
                            <i class="fa-solid fa-pencil"></i>
                            <span>Edit</span>
                        </a>
                        <button type="button" class="btn btn-danger d-flex align-items-center gap-2" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" aria-label="Delete Menu">
                            <i class="fa-solid fa-trash"></i>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-xxl py-4">
            <!-- Menu Overview -->
            <div class="card shadow-sm border mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-fill">
                            <h2 class="h3 fw-bold mb-2">{{ $menu->name }}</h2>
                            <p class="text-muted mb-3">{{ $menu->description ?? 'No menu description.' }}</p>

                            <div class="d-flex flex-wrap gap-3 small text-muted mb-3">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-calendar"></i>
                                    <span>Created: {{ $menu->created_at->format('Y/m/d') }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-user"></i>
                                    <span>Created by: You</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-globe text-success"></i>
                                    <span class="text-success">Public</span>
                                </div>
                            </div>
                        </div>

                        <!-- Difficulty Badge -->
                        <div class="ms-3">
                            @php
                                $badgeClass = 'bg-success-subtle text-success';
                                $difficultyLabel = 'Beginner';

                                if ($menu->basedOnTemplate && $menu->basedOnTemplate->difficulty) {
                                    if ($menu->basedOnTemplate->difficulty === 'intermediate') {
                                        $badgeClass = 'bg-warning-subtle text-warning';
                                        $difficultyLabel = 'Intermediate';
                                    } elseif ($menu->basedOnTemplate->difficulty === 'advanced') {
                                        $badgeClass = 'bg-danger-subtle text-danger';
                                        $difficultyLabel = 'Advanced';
                                    }
                                }
                            @endphp
                            <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2">{{ $difficultyLabel }}</span>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="row g-3 mb-3">
                        <div class="col-6 col-md-3">
                            <div class="bg-primary-subtle rounded p-3 text-center">
                                <div class="h4 fw-bold text-primary mb-0">{{ $stats['exerciseCount'] }}</div>
                                <div class="small text-muted">Exercises</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-success-subtle rounded p-3 text-center">
                                <div class="h4 fw-bold text-success mb-0">{{ $stats['estimatedTime'] }}</div>
                                <div class="small text-muted">Estimated Time (min)</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-info-subtle rounded p-3 text-center">
                                <div class="h4 fw-bold text-info mb-0">{{ $stats['totalVolume'] }}</div>
                                <div class="small text-muted">Total Volume (kg)</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-warning-subtle rounded p-3 text-center">
                                <div class="h4 fw-bold text-warning mb-0">{{ $stats['totalSets'] }}</div>
                                <div class="small text-muted">Total Sets</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="d-flex flex-wrap gap-2">
                        @php
                            $muscleGroups = [];
                            foreach ($menu->menuExercises as $menuExercise) {
                                if ($menuExercise->exercise && isset($menuExercise->exercise->muscle_groups)) {
                                    $muscleGroups = array_merge(
                                        $muscleGroups,
                                        is_array($menuExercise->exercise->muscle_groups)
                                            ? $menuExercise->exercise->muscle_groups
                                            : [],
                                    );
                                }
                            }
                            $muscleGroups = array_unique($muscleGroups);
                        @endphp

                        @foreach ($muscleGroups as $muscleGroup)
                            <span class="badge bg-secondary rounded-pill">{{ $muscleGroup }}</span>
                        @endforeach

                        @if ($menu->basedOnTemplate)
                            <span class="badge bg-secondary rounded-pill">Template Used</span>
                        @endif
                    </div>
                </div>
            </div>


            <!-- Exercise List -->
            <div class="card shadow-sm border mb-5">
                <div class="card-body p-4">
                    <h3 class="h5 fw-semibold mb-4">Exercise List</h3>

                    <div class="d-flex flex-column gap-3">
                        @forelse($menu->menuExercises as $menuExercise)
                            <a href="#" class="text-decoration-none">
                                <div class="bg-light rounded p-3 border hover-shadow">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-fill">
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <span
                                                    class="badge bg-primary rounded-pill">{{ $menuExercise->order_index }}</span>
                                                <h4 class="h6 fw-medium mb-0 text-dark">{{ $menuExercise->exercise->name }}
                                                </h4>
                                            </div>

                                            <div class="row g-3 small text-muted">
                                                <div class="col-6 col-md-3">
                                                    <div class="d-flex align-items-center gap-1">
                                                        <i class="fa-solid fa-bullseye"></i>
                                                        <span>{{ $menuExercise->sets ?? '-' }} sets</span>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <span>{{ $menuExercise->reps ? $menuExercise->reps . ' reps' : '-' }}</span>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <span>{{ $menuExercise->weight ? $menuExercise->weight . 'kg' : '-' }}</span>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="d-flex align-items-center gap-1">
                                                        <i class="fa-solid fa-clock"></i>
                                                        <span>Rest {{ $menuExercise->rest_seconds ?? '-' }}s</span>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($menuExercise->exercise->description)
                                                <div class="mt-2 small text-muted">
                                                    <span class="fw-medium">Note:</span>
                                                    {{ $menuExercise->exercise->description }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="ms-3">
                                            <i class="fa-solid fa-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="alert alert-info">
                                No exercises have been added to this menu.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Action Buttons -->
        <div class="d-md-none position-fixed bottom-0 start-0 end-0 bg-white border-top p-3">
            <div class="d-flex gap-2">
                <a href="{{ route('menus.edit', $menu) }}"
                    class="btn btn-primary flex-fill d-flex align-items-center justify-content-center gap-2"
                    aria-label="Edit Menu">
                    <i class="fa-solid fa-pencil"></i>
                    <span>Edit</span>
                </a>
                <button type="button"
                    class="btn btn-danger flex-fill d-flex align-items-center justify-content-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#deleteModal" aria-label="Delete Menu">
                    <i class="fa-solid fa-trash"></i>
                    <span>Delete</span>
                </button>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-danger-subtle rounded-circle p-2">
                                    <i class="fa-solid fa-triangle-exclamation text-danger fs-5"></i>
                                </div>
                                <h5 class="modal-title mb-0" id="deleteModalLabel">Delete this menu?</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="mb-4">
                            <p class="text-muted mb-0">
                                <span class="fw-medium text-dark">{{ $menu->name }}</span>
                                will be deleted. This action cannot be undone.
                            </p>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary flex-fill"
                                data-bs-dismiss="modal">Cancel</button>
                            <form method="POST" action="{{ route('menus.destroy', $menu) }}" class="flex-fill">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Toast -->
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fa-solid fa-check-circle me-2"></i>
                        Menu deleted
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>

        <style>
            .hover-shadow {
                transition: all 0.2s ease;
            }

            .hover-shadow:hover {
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                background-color: #f8f9fa !important;
            }
        </style>
    </body>
@endsection

@section('footer')

@endsection
