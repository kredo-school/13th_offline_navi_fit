@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Exercise</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.exercises.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name">Exercise Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Target Muscle Groups *</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="muscle_groups[]"
                                                value="chest" id="chest"
                                                {{ in_array('chest', old('muscle_groups', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="chest">Chest</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="muscle_groups[]"
                                                value="back" id="back"
                                                {{ in_array('back', old('muscle_groups', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="back">Back</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="muscle_groups[]"
                                                value="shoulders" id="shoulders"
                                                {{ in_array('shoulders', old('muscle_groups', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="shoulders">Shoulders</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="muscle_groups[]"
                                                value="arms" id="arms"
                                                {{ in_array('arms', old('muscle_groups', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="arms">Arms</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="muscle_groups[]"
                                                value="legs" id="legs"
                                                {{ in_array('legs', old('muscle_groups', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="legs">Legs</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="muscle_groups[]"
                                                value="core" id="core"
                                                {{ in_array('core', old('muscle_groups', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="core">Core</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="muscle_groups[]"
                                                value="full_body" id="full_body"
                                                {{ in_array('full_body', old('muscle_groups', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="full_body">Full Body</label>
                                        </div>
                                    </div>
                                </div>
                                @error('muscle_groups')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="equipment_category">Equipment Category *</label>
                                <select class="form-control @error('equipment_category') is-invalid @enderror"
                                    id="equipment_category" name="equipment_category" required>
                                    <option value="">Select Equipment Category</option>
                                    <option value="barbell" {{ old('equipment_category') == 'barbell' ? 'selected' : '' }}>
                                        Barbell</option>
                                    <option value="dumbbell"
                                        {{ old('equipment_category') == 'dumbbell' ? 'selected' : '' }}>Dumbbell</option>
                                    <option value="machine" {{ old('equipment_category') == 'machine' ? 'selected' : '' }}>
                                        Machine</option>
                                    <option value="bodyweight"
                                        {{ old('equipment_category') == 'bodyweight' ? 'selected' : '' }}>Bodyweight
                                    </option>
                                    <option value="timer" {{ old('equipment_category') == 'timer' ? 'selected' : '' }}>
                                        Timer</option>
                                </select>
                                @error('equipment_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="equipment_needed">Equipment Needed</label>
                                <input type="text" class="form-control @error('equipment_needed') is-invalid @enderror"
                                    id="equipment_needed" name="equipment_needed" value="{{ old('equipment_needed') }}"
                                    placeholder="e.g., Olympic barbell, 45lb plates">
                                @error('equipment_needed')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="difficulty">Difficulty Level *</label>
                                <select class="form-control @error('difficulty') is-invalid @enderror" id="difficulty"
                                    name="difficulty" required>
                                    <option value="">Select Difficulty</option>
                                    <option value="beginner" {{ old('difficulty') == 'beginner' ? 'selected' : '' }}>
                                        Beginner</option>
                                    <option value="intermediate"
                                        {{ old('difficulty') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="advanced" {{ old('difficulty') == 'advanced' ? 'selected' : '' }}>
                                        Advanced</option>
                                </select>
                                @error('difficulty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="instructions">Instructions</label>
                                <textarea class="form-control @error('instructions') is-invalid @enderror" id="instructions" name="instructions"
                                    rows="5" placeholder="Step-by-step instructions for performing this exercise">{{ old('instructions') }}</textarea>
                                @error('instructions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="image">Image Upload</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Max file size: 2MB. Supported formats: JPEG, PNG, JPG,
                                    GIF</small>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="image_url">Image URL</label>
                                <input type="url" class="form-control @error('image_url') is-invalid @enderror"
                                    id="image_url" name="image_url" value="{{ old('image_url') }}"
                                    placeholder="https://example.com/exercise-image.jpg">
                                @error('image_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                        id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active (visible in exercise lists)
                                    </label>
                                </div>
                            </div>

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
