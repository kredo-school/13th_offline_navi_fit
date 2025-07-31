{{-- resources/views/user/menus/partials/create/exercise-editor.blade.php --}}
<div class="card border-0 shadow-sm flex-fill">
    <div class="card-body d-flex flex-column">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title mb-0">エクササイズ</h5>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#aiProposalModal">
                <i class="fa-solid fa-star me-1"></i>
                AI提案
            </button>
        </div>

        {{-- Error Alert --}}
        <div class="alert alert-danger d-none" id="exerciseError">
            <small>少なくとも1つの種目を追加してください</small>
        </div>

        {{-- Exercise Table --}}
        <div class="flex-fill overflow-auto">
            <table class="table table-sm">
                <thead class="table-light sticky-top">
                    <tr>
                        <th width="30"></th>
                        <th>種目名</th>
                        <th width="80">セット</th>
                        <th width="80">回数</th>
                        <th width="80">重量</th>
                        <th width="50"></th>
                    </tr>
                </thead>
                <tbody id="exerciseTableBody">
                    {{-- Exercise rows will be added dynamically --}}
                </tbody>
            </table>

            {{-- Empty State --}}
            <div class="text-center py-5 text-muted" id="emptyState">
                <p class="small">左右のパネルから種目をドラッグ&ドロップで追加してください</p>
            </div>
        </div>
    </div>
</div>
