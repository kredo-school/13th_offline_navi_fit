{{-- 検索とフィルターバー --}}
<div class="row mt-4">
    <div class="col-sm-8 col-lg-9 mb-3 mb-sm-0">
        <form action="#" method="GET" id="searchForm">
            <div class="position-relative">
                <i class="fa-solid fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" 
                       class="form-control ps-5" 
                       name="search"
                       id="searchInput"
                       placeholder="Search for your workout plan"
                       value="">
            </div>
        </form>
    </div>
    <div class="col-sm-4 col-lg-3">
        <button class="btn btn-outline-secondary w-100" 
                type="button"
                data-bs-toggle="collapse" 
                data-bs-target="#filterPanel"
                aria-expanded="false"
                aria-controls="filterPanel">
            <i class="fa-solid fa-filter me-2"></i>
            Filter
            <span class="badge bg-primary ms-2 d-none" id="activeFilterCount">0</span>
        </button>
    </div>
</div>
