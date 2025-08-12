{{-- resources/views/user/menus/partials/create/exercise-editor.blade.php --}}
<div class="card border-0 shadow-sm flex-fill">
    <div class="card-body d-flex flex-column">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title mb-0">Exercise</h5>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#aiProposalModal">
                <i class="fa-solid fa-star me-1"></i>
                AI Suggestion
            </button>
        </div>

        {{-- Error Alert --}}
        <div class="alert alert-danger d-none" id="exerciseError">
            <small>Please add at least one exercise</small>
        </div>

        {{-- Exercise Table --}}
        <div class="flex-fill overflow-auto">
            <table class="table table-sm">
                <thead class="table-light sticky-top">
                    <tr>
                        <th width="30"></th>
                        <th>Exercise Name</th>
                        <th width="80">Sets</th>
                        <th width="80">Reps</th>
                        <th width="80">Weight</th>
                        <th width="50"></th>
                    </tr>
                </thead>
                <tbody id="exerciseTableBody">
                    {{-- Exercise rows will be added dynamically --}}
                </tbody>
            </table>

            {{-- Empty State --}}
            <div class="text-center py-5 text-muted" id="emptyState">
                <p class="small">Please drag and drop exercises from the left or right panels to add them</p>
            </div>
        </div>
    </div>
</div>
