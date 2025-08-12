{{-- resources/views/user/menus/partials/edit/header.blade.php --}}
<div class="bg-white shadow-sm border-bottom">
    <div class="container-fluid px-4 py-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <a href="{{ route('menus.show', $menu) }}" class="btn btn-light rounded-circle me-3"
                    aria-label="Return to Menu Details">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h1 class="h4 mb-1">Edit Menu</h1>
                    <nav class="small text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-decoration-none">Dashboard</a>
                        <span class="mx-2">›</span>
                        <a href="{{ route('menus.index') }}" class="text-muted text-decoration-none">Menu List</a>
                        <span class="mx-2">›</span>
                        <a href="{{ route('menus.show', $menu) }}"
                            class="text-muted text-decoration-none">{{ $menu->name ?? 'Menu Name' }}</a>
                        <span class="mx-2">›</span>
                        <span class="text-primary">Edit</span>
                    </nav>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('menus.show', $menu) }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
                <button type="button" class="btn btn-primary" id="saveButton">
                    <i class="bi bi-check-circle me-1"></i>
                    Update
                </button>
            </div>
        </div>
    </div>
</div>
