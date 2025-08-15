@extends('admin.layout')

@section('content')
    {{-- Bootstrap Icons CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Create New Exercise</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.exercises.store') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Exercise Name --}}
                            <div class="form-group mb-3">
                                <label for="name">Exercise Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Target Muscle Groups --}}
                            <div class="form-group mb-3">
                                <label>Target Muscle Groups *</label>
                                <div class="muscle-groups-container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @foreach (['chest', 'back', 'shoulders', 'arms'] as $muscle)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="muscle_groups[]"
                                                        id="muscle_{{ $muscle }}" value="{{ $muscle }}"
                                                        {{ in_array($muscle, old('muscle_groups', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="muscle_{{ $muscle }}">{{ ucfirst($muscle) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-md-6">
                                            @foreach (['legs', 'core', 'full_body'] as $muscle)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="muscle_groups[]"
                                                        id="muscle_{{ $muscle }}" value="{{ $muscle }}"
                                                        {{ in_array($muscle, old('muscle_groups', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="muscle_{{ $muscle }}">{{ ucfirst(str_replace('_', ' ', $muscle)) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @error('muscle_groups')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Please select at least one muscle group.</small>
                            </div>

                            {{-- Equipment Category --}}
                            <div class="form-group mb-3">
                                <label for="equipment_category">Equipment Category *</label>
                                <select class="form-control @error('equipment_category') is-invalid @enderror"
                                    id="equipment_category" name="equipment_category" required>
                                    <option value="">Select Equipment</option>
                                    @foreach (['barbell', 'dumbbell', 'machine', 'bodyweight', 'timer'] as $equip)
                                        <option value="{{ $equip }}"
                                            {{ old('equipment_category') == $equip ? 'selected' : '' }}>
                                            {{ ucfirst($equip) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('equipment_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Equipment Details --}}
                            <div class="form-group mb-3">
                                <label for="equipment_needed">Equipment Details</label>
                                <input type="text" class="form-control @error('equipment_needed') is-invalid @enderror"
                                    id="equipment_needed" name="equipment_needed" value="{{ old('equipment_needed') }}"
                                    placeholder="E.g. Barbell, Bench, Squat Rack">
                                @error('equipment_needed')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Difficulty --}}
                            <div class="form-group mb-3">
                                <label for="difficulty">Difficulty Level *</label>
                                <select class="form-control @error('difficulty') is-invalid @enderror" id="difficulty"
                                    name="difficulty" required>
                                    <option value="">Select Difficulty</option>
                                    @foreach (['beginner', 'intermediate', 'advanced'] as $level)
                                        <option value="{{ $level }}"
                                            {{ old('difficulty') == $level ? 'selected' : '' }}>
                                            {{ ucfirst($level) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('difficulty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Instructions --}}
                            <div class="form-group mb-3">
                                <label>Instructions (Steps)</label>
                                <div class="instruction-steps">

                                    {{-- Step 1 --}}
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <strong>Step 1</strong> - Preparation
                                        </div>
                                        <div class="card-body">
                                            <textarea class="form-control" id="instructions_1" name="instructions[]" rows="2"
                                                placeholder="Explain the first step...">{{ old('instructions.0') }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Step 2 --}}
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <strong>Step 2</strong> - Execution
                                        </div>
                                        <div class="card-body">
                                            <textarea class="form-control" id="instructions_2" name="instructions[]" rows="2"
                                                placeholder="Explain the second step...">{{ old('instructions.1') }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Step 3 --}}
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <strong>Step 3</strong> - Finish
                                        </div>
                                        <div class="card-body">
                                            <textarea class="form-control" id="instructions_3" name="instructions[]" rows="2"
                                                placeholder="Explain the third step...">{{ old('instructions.2') }}</textarea>
                                        </div>
                                    </div>

                                </div>
                                @error('instructions')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Image Upload --}}
                            <div class="form-group mb-3">
                                <label for="image">Image Upload</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Buttons --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create Exercise</button>
                                <a href="{{ route('admin.exercises.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
