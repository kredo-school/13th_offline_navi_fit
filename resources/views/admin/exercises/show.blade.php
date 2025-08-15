@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    {{-- Header --}}
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                        <h4 class="mb-0">{{ $exercise->name }}</h4>
                        <div>
                            <a href="{{ route('admin.exercises.edit', $exercise) }}" class="btn btn-light btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="{{ route('admin.exercises.index') }}" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-list"></i> Back
                            </a>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="card-body">
                        <div class="row g-4">
                            {{-- Image --}}
                            <div class="col-md-5">
                                @if ($exercise->image_path)
                                    <img src="{{ asset('storage/' . $exercise->image_path) }}"
                                        class="img-fluid rounded shadow-sm" alt="{{ $exercise->name }}">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="height: 300px;">
                                        <i class="fas fa-dumbbell fa-4x text-muted"></i>
                                    </div>
                                @endif
                            </div>

                            {{-- Details --}}
                            <div class="col-md-7">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Muscle Groups:</strong>
                                        @foreach ($exercise->muscle_groups as $muscle)
                                            <span
                                                class="badge bg-primary me-1">{{ ucfirst(str_replace('_', ' ', $muscle)) }}</span>
                                        @endforeach
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Equipment:</strong>
                                        <span class="badge bg-secondary">{{ ucfirst($exercise->equipment_category) }}</span>
                                        @if ($exercise->equipment_needed)
                                            <div class="small text-muted">{{ $exercise->equipment_needed }}</div>
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Difficulty:</strong>
                                        <span
                                            class="badge bg-{{ $exercise->difficulty == 'beginner' ? 'success' : ($exercise->difficulty == 'intermediate' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($exercise->difficulty) }}
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Status:</strong>
                                        <span class="badge bg-{{ $exercise->is_active ? 'success' : 'secondary' }}">
                                            {{ $exercise->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Created:</strong> {{ $exercise->created_at->format('M d, Y') }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Updated:</strong> {{ $exercise->updated_at->format('M d, Y') }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- Description --}}
                        @if ($exercise->description)
                            <div class="mt-4">
                                <h5>Description</h5>
                                <p>{{ $exercise->description }}</p>
                            </div>
                        @endif

                        {{-- Instructions --}}
                        @if ($exercise->instructions)
                            <div class="mt-4">
                                <h5>Instructions</h5>
                                <ol class="ps-3">
                                    @foreach (explode("\n", $exercise->instructions) as $step)
                                        @if (trim($step) !== '')
                                            <li>{{ $step }}</li>
                                        @endif
                                    @endforeach
                                </ol>
                            </div>
                        @endif
                    </div>

                    {{-- Footer --}}
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.exercises.edit', $exercise) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit Exercise
                        </a>
                        <form action="{{ route('admin.exercises.destroy', $exercise) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this exercise?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
