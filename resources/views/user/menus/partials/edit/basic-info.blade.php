{{-- resources/views/menu/partials/basic-info.blade.php --}}
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <h5 class="card-title mb-3">基本情報</h5>

        <form>
            <div class="mb-3">
                <label for="menuName" class="form-label fw-medium">
                    メニュー名 <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control form-control-sm" id="menuName" value="{{ $menu->name ?? '' }}"
                    placeholder="メニュー名を入力" maxlength="50">
                <div class="invalid-feedback">
                    メニュー名は必須です
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="difficulty" class="form-label fw-medium">
                        難易度
                    </label>
                    <select class="form-select form-select-sm" id="difficulty">
                        <option value="beginner" {{ ($menu->difficulty ?? '') == 'beginner' ? 'selected' : '' }}>初級者
                        </option>
                        <option value="intermediate"
                            {{ ($menu->difficulty ?? '') == 'intermediate' ? 'selected' : '' }}>中級者</option>
                        <option value="advanced" {{ ($menu->difficulty ?? '') == 'advanced' ? 'selected' : '' }}>上級者
                        </option>
                    </select>
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="isPublic"
                            {{ $menu->is_public ?? false ? 'checked' : '' }}>
                        <label class="form-check-label" for="isPublic">
                            公開する
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
