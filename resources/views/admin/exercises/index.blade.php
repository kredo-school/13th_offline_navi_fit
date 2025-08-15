@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Exercise Management</h4>
                        <a href="{{ route('admin.exercises.create') }}" class="btn btn-primary">Add New Exercise</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Search and Filter Form -->
                        <form method="GET" action="{{ route('admin.exercises.index') }}" class="mb-4">
                            <div class="row overflow-x-auto">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search exercises..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="muscle_group" class="form-control">
                                        <option value="">All Muscle Groups</option>
                                        <option value="chest" {{ request('muscle_group') == 'chest' ? 'selected' : '' }}>
                                            Chest</option>
                                        <option value="back" {{ request('muscle_group') == 'back' ? 'selected' : '' }}>
                                            Back</option>
                                        <option value="shoulders"
                                            {{ request('muscle_group') == 'shoulders' ? 'selected' : '' }}>Shoulders
                                        </option>
                                        <option value="arms" {{ request('muscle_group') == 'arms' ? 'selected' : '' }}>
                                            Arms</option>
                                        <option value="legs" {{ request('muscle_group') == 'legs' ? 'selected' : '' }}>
                                            Legs</option>
                                        <option value="core" {{ request('muscle_group') == 'core' ? 'selected' : '' }}>
                                            Core</option>
                                        <option value="full_body"
                                            {{ request('muscle_group') == 'full_body' ? 'selected' : '' }}>Full Body
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="equipment_category" class="form-control">
                                        <option value="">All Equipment</option>
                                        <option value="barbell"
                                            {{ request('equipment_category') == 'barbell' ? 'selected' : '' }}>Barbell
                                        </option>
                                        <option value="dumbbell"
                                            {{ request('equipment_category') == 'dumbbell' ? 'selected' : '' }}>Dumbbell
                                        </option>
                                        <option value="machine"
                                            {{ request('equipment_category') == 'machine' ? 'selected' : '' }}>Machine
                                        </option>
                                        <option value="bodyweight"
                                            {{ request('equipment_category') == 'bodyweight' ? 'selected' : '' }}>
                                            Bodyweight</option>
                                        <option value="timer"
                                            {{ request('equipment_category') == 'timer' ? 'selected' : '' }}>Timer</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="difficulty" class="form-control">
                                        <option value="">All Difficulties</option>
                                        <option value="beginner"
                                            {{ request('difficulty') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate"
                                            {{ request('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediate
                                        </option>
                                        <option value="advanced"
                                            {{ request('difficulty') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-secondary">Filter</button>
                                    <a href="{{ route('admin.exercises.index') }}" class="btn btn-outline-secondary">Clear</a>
                                </div>
                            </div>
                        </form>

                        <!-- Exercise List -->
                        <div class="row overflow-x-auto">
                            @forelse($exercises as $exercise)
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <div class="card h-100">
                                        @if ($exercise->image_path)
                                            <img src="{{ asset('storage/' . $exercise->image_path) }}" class="card-img-top"
                                                alt="{{ $exercise->name }}" style="height: 200px; width: 100%; object-fit: contain;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                                style="height: 200px;">
                                                <i class="fas fa-dumbbell fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $exercise->name }}</h5>
                                            <p class="card-text">{{ Str::limit($exercise->description, 100) }}</p>

                                            <div class="mb-2">
                                                <strong>Muscle Groups:</strong>
                                                @foreach ($exercise->muscle_groups as $muscle)
                                                    <span class="badge bg-primary text-white">{{ ucfirst($muscle) }}</span>
                                                @endforeach
                                            </div>

                                            <div class="mb-2">
                                                <strong>Equipment:</strong>
                                                <span
                                                    class="badge bg-secondary text-white">{{ ucfirst($exercise->equipment_category) }}</span>
                                            </div>

                                            <div class="mb-2">
                                                <strong>Difficulty:</strong>
                                                <span
                                                    class="badge bg-{{ $exercise->difficulty == 'beginner' ? 'success' : ($exercise->difficulty == 'intermediate' ? 'warning' : 'danger') }} text-white">
                                                    {{ ucfirst($exercise->difficulty) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.exercises.show', $exercise) }}"
                                                class="btn btn-info btn-sm flex-grow-0">View</a>
                                            <a href="{{ route('admin.exercises.edit', $exercise) }}"
                                                class="btn btn-warning btn-sm flex-grow-0 mx-1">Edit</a>
                                            <form action="{{ route('admin.exercises.destroy', $exercise) }}" method="POST"
                                                class="d-inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm flex-grow-0"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center">
                                        <p>No exercises found.</p>
                                        <a href="{{ route('admin.exercises.create') }}" class="btn btn-primary">Add First
                                            Exercise</a>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $exercises->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
