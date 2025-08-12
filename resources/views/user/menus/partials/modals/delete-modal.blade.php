{{-- 削除確認モーダル（英語版） --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                        <i class="bi bi-exclamation-triangle text-danger" style="font-size: 1.5rem;"></i>
                    </div>
                    <h5 class="modal-title mb-0 fw-semibold" id="deleteModalLabel">
                        Delete Menu?
                    </h5>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                {{-- 単一削除の場合 --}}
                <div id="singleDeleteInfo">
                    <p class="text-muted mb-4">
                        You are about to delete <span class="fw-medium text-dark menu-title"></span>. This action cannot
                        be undone.
                    </p>
                </div>

                {{-- 一括削除の場合 --}}
                <div class="bg-light rounded p-3 mb-4 d-none" id="bulkDeleteInfo">
                    <p class="small fw-medium mb-2">Deleting: <span class="text-danger bulk-delete-count">0</span> menus
                    </p>
                    <div class="bulk-delete-list small text-muted" style="max-height: 150px; overflow-y: auto;">
                        {{-- JavaScriptで動的に生成 --}}
                    </div>
                </div>

                {{-- 警告メッセージ --}}
                <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <div class="small">
                        Deleted menus cannot be restored. All related data will also be deleted.
                    </div>
                </div>

                {{-- アクションボタン --}}
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary flex-fill" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form id="deleteMenuForm" method="POST" class="flex-fill">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 confirm-delete-btn" data-menu-id="">
                            <i class="bi bi-trash3 me-2"></i>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 一括削除確認モーダル --}}
<div class="modal fade" id="bulkActionModal" tabindex="-1" aria-labelledby="bulkActionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="bulkActionModalLabel">Bulk Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">
                    <span class="fw-bold selected-count">0</span> menus selected
                </p>

                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-danger bulk-delete-trigger">
                        <i class="bi bi-trash3 me-2"></i>
                        Delete Selected Menus
                    </button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                        <i class="bi bi-download me-2"></i>
                        Export Selected Menus
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-tags me-2"></i>
                        Edit Tags
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
