<!-- Create Menu Card -->
<div class="card">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-semibold mb-0">Create Workout Plan</h5>
            <i class="bi bi-book text-muted"></i>
        </div>
        
        <div class="text-center py-4">
            <div class="bg-success bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                <i class="bi bi-plus-lg text-success fs-3"></i>
            </div>
            
            <p class="text-muted mb-4 small">
                Create your own original<br>
                workout plan
            </p>
            
            <a href="{{ route('menus.create') }}" class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-plus"></i>
                <span>Create Workout Plan</span>
            </a>
        </div>
    </div>
</div>