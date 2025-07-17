@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Create New Template</h2>
                    <a href="{{ route('templates.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Templates
                    </a>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('templates.store') }}" id="templateForm">
                    @csrf

                    <div class="row">
                        <!-- Left Column - Template Info -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Template Information</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Template Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            rows="3">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Difficulty -->
                                    <div class="mb-3">
                                        <label for="difficulty" class="form-label">Difficulty</label>
                                        <select class="form-select @error('difficulty') is-invalid @enderror"
                                            id="difficulty" name="difficulty">
                                            <option value="easy" {{ old('difficulty') === 'easy' ? 'selected' : '' }}>Easy
                                            </option>
                                            <option value="normal"
                                                {{ old('difficulty', 'normal') === 'normal' ? 'selected' : '' }}>Normal
                                            </option>
                                            <option value="hard" {{ old('difficulty') === 'hard' ? 'selected' : '' }}>Hard
                                            </option>
                                        </select>
                                        @error('difficulty')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Thumbnail URL -->
                                    <div class="mb-3">
                                        <label for="thumbnail_url" class="form-label">Thumbnail URL</label>
                                        <input type="url"
                                            class="form-control @error('thumbnail_url') is-invalid @enderror"
                                            id="thumbnail_url" name="thumbnail_url" value="{{ old('thumbnail_url') }}">
                                        @error('thumbnail_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Is Active -->
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                                value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Active Template
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Exercise Selection -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Exercises</h5>
                                    <button type="button" class="btn btn-sm btn-primary" id="addExerciseBtn">
                                        <i class="fas fa-plus"></i> Add Exercise (JavaScript実装予定)
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div id="exercisesList">
                                        <!-- Dynamic exercises will be added here -->
                                    </div>

                                    @error('exercises')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('templates.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Create Template
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
