{{-- resources/views/menu/partials/basic-info.blade.php --}}
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <h5 class="card-title mb-3">Basic Information</h5>

        <form id="menuEditForm" action="{{ route('menus.update', $menu) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="menuName" class="form-label fw-medium">
                    Menu Name <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control form-control-sm" id="menuName" name="name"
                    value="{{ old('name', $menu->name) }}" placeholder="Enter menu name" maxlength="50" required>
                <div class="invalid-feedback">
                    Menu name is required
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="based_on_template_id" class="form-label fw-medium">
                        Select Template
                    </label>
                    <select class="form-select form-select-sm" id="based_on_template_id" name="based_on_template_id">
                        <option value="">Select a template</option>
                        @foreach ($templates as $template)
                            <option value="{{ $template->id }}"
                                {{ $menu->based_on_template_id == $template->id ? 'selected' : '' }}>
                                {{ $template->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            {{ $menu->is_active ? 'checked' : '' }}>
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
