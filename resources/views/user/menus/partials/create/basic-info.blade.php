{{-- resources/views/user/menus/partials/create/basic-info.blade.php --}}
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <h5 class="card-title mb-3">Basic Information</h5>

        <form id="menuCreateForm" action="{{ route('menus.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="menuName" class="form-label fw-medium">
                    Menu Name <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control form-control-sm" id="menuName" name="name"
                    value="{{ old('name') }}" placeholder="Enter menu name" maxlength="50" required>
                <div class="invalid-feedback">
                    Menu name is required
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="difficulty_level" class="form-label fw-medium">
                        Difficulty Level
                    </label>
                    <select class="form-select form-select-sm" id="difficulty_level" name="difficulty_level">
                        <option value="">Select difficulty level</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            checked>
                        <label class="form-check-label" for="is_active">
                            Publish
                        </label>
                    </div>
                </div>
            </div>

            <!-- Hidden fields for storing exercise data -->
            <div id="exerciseDataContainer">
                <!-- Dynamically added by JavaScript -->
            </div>
        </form>
    </div>
</div>