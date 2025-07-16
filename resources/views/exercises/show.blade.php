@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>{{ $exercise->name }}</h4>
                        <div>
                            <a href="{{ route('exercises.edit', $exercise) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('exercises.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if ($exercise->image_path)
                                    <img src="{{ asset('storage/' . $exercise->image_path) }}"
                                        class="img-fluid rounded mb-3" alt="{{ $exercise->name }}">
                                @elseif($exercise->image_url)
                                    <img src="{{ $exercise->image_url }}" class="img-fluid rounded mb-3"
                                        alt="{{ $exercise->name }}">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                        style="height: 300px;">
                                        <i class="fas fa-dumbbell fa-4x text-muted"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <h5>Exercise Details</h5>

                                <div class="mb-3">
                                    <strong>Target Muscle Groups:</strong>
                                    <div class="mt-1">
                                        @foreach ($exercise->muscle_groups as $muscle)
                                            <span
                                                class="badge badge-primary me-1">{{ ucfirst(str_replace('_', ' ', $muscle)) }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <strong>Equipment Category:</strong>
                                    <span class="badge badge-secondary">{{ ucfirst($exercise->equipment_category) }}</span>
                                </div>

                                @if ($exercise->equipment_needed)
                                    <div class="mb-3">
                                        <strong>Equipment Needed:</strong>
                                        <p class="mb-0">{{ $exercise->equipment_needed }}</p>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <strong>Difficulty Level:</strong>
                                    <span
                                        class="badge badge-{{ $exercise->difficulty == 'beginner' ? 'success' : ($exercise->difficulty == 'intermediate' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($exercise->difficulty) }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <strong>Status:</strong>
                                    <span class="badge badge-{{ $exercise->is_active ? 'success' : 'secondary' }}">
                                        {{ $exercise->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <strong>Created:</strong>
                                    <p class="mb-0">{{ $exercise->created_at->format('M d, Y') }}</p>
                                </div>

                                <div class="mb-3">
                                    <strong>Last Updated:</strong>
                                    <p class="mb-0">{{ $exercise->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        @if ($exercise->description)
                            <div class="mt-4">
                                <h5>Description</h5>
                                <p>{{ $exercise->description }}</p>
                            </div>
                        @endif

                        @if ($exercise->instructions)
                            <div class="mt-4">
                                <h5>Instructions</h5>
                                <div class="border-left border-primary pl-3">
                                    {!! nl2br(e($exercise->instructions)) !!}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('exercises.edit', $exercise) }}" class="btn btn-warning">Edit
                                    Exercise</a>
                            </div>
                            <div>
                                <form action="{{ route('exercises.destroy', $exercise) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this exercise?')">
                                        Delete Exercise
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
