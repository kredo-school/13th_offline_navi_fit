<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-3">
        <div class="row align-items-center">
            <div class="col-md-8 mb-2 mb-md-0">
                <h1 class="h3 fw-bold mb-1">Menu List</h1>
                <p class="text-muted mb-0 small">Manage the workout plan you created</p>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-md-end">
                    <!-- 動的化時はroute('menus.create')に置換 -->
                    <a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-plus me-1"></i> Create a new menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>