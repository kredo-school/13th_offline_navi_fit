<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

            <div class="d-flex align-items-center gap-2 w-100 w-md-auto">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary"
                      style="width:40px;height:40px;">
                    <i class="fa-solid fa-dumbbell"></i>
                </span>
                <div class="min-w-0">
                    <h1 class="h4 fw-semibold mb-0 text-truncate">Menu List</h1>
                    <small class="text-muted">Manage the workout plan you created</small>
                </div>
            </div>

            <div class="ms-md-auto">
                <a href="{{ route('menus.create') }}" class="btn btn-primary rounded-3 px-4 py-2 shadow-sm create-menu-btn">
                    <i class="fa-solid fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline fw-medium">Create New Menu</span>
                    <span class="d-inline d-sm-none fw-medium">Create</span>
                </a>
            </div>
        </div>
    </div>
</div>
