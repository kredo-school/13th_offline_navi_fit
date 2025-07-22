<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-3 mb-lg-0">
                <h1 class="h2 fw-bold mb-2">Menu List</h1>
                <p class="text-muted mb-0">Manage the workout plan you created</p>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-lg-end gap-2">
                    {{-- <x-bulk-delete-button /> --}}
                    <a href="{{ route('menus.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i> Create a new menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
