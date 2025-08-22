{{-- Livewire用検索バー --}}
<div class="mb-4">
    <div class="row">
        <div class="col-md-6">
            <div class="position-relative">
                <i class="fa-solid fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" 
                       class="form-control ps-5" 
                       wire:model.live.debounce.300ms="search"
                       placeholder="Search workout plans..."
                       id="searchInput">
            </div>
        </div>
    </div>
</div>
