// メニュー管理のJavaScript
class MenuManager {
    constructor() {
        this.selectedMenus = new Set();
        this.init();
    }

    init() {
        this.bindEvents();
        this.initializeToasts();
    }

    bindEvents() {
        // チェックボックスのイベント
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('menu-checkbox')) {
                this.handleCheckboxChange(e.target);
            }
        });

        // 削除ボタンのイベント
        document.addEventListener('click', (e) => {
            if (e.target.closest('.delete-menu-btn')) {
                this.handleDeleteClick(e.target.closest('.delete-menu-btn'));
            }
        });

        // 一括削除ボタン
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        if (bulkDeleteBtn) {
            bulkDeleteBtn.addEventListener('click', () => this.handleBulkDelete());
        }
    }

    handleCheckboxChange(checkbox) {
        if (checkbox.checked) {
            this.selectedMenus.add(checkbox.value);
        } else {
            this.selectedMenus.delete(checkbox.value);
        }
        this.updateBulkDeleteButton();
    }

    updateBulkDeleteButton() {
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        const selectedCount = document.getElementById('selectedCount');
        
        if (this.selectedMenus.size > 0) {
            bulkDeleteBtn.classList.remove('d-none');
            selectedCount.textContent = this.selectedMenus.size;
        } else {
            bulkDeleteBtn.classList.add('d-none');
        }
    }

    async handleDeleteClick(button) {
        const menuId = button.dataset.menuId;
        const menuTitle = button.dataset.menuTitle;
        
        // Bootstrapモーダルを使用
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        
        // モーダルにデータをセット
        document.querySelector('#deleteModal .menu-title').textContent = menuTitle;
        document.querySelector('#deleteModal .confirm-delete-btn').dataset.menuId = menuId;
        
        modal.show();
    }

    async deleteMenu(menuId) {
        try {
            const response = await fetch(`/menus/${menuId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            });

            if (response.ok) {
                this.showToast('success', 'メニューが正常に削除されました');
                // カードを削除またはページをリロード
                location.reload();
            } else {
                throw new Error('削除に失敗しました');
            }
        } catch (error) {
            this.showToast('error', 'エラーが発生しました');
        }
    }

    showToast(type, message) {
        const toastEl = document.getElementById(`${type}Toast`);
        toastEl.querySelector('.toast-body').textContent = message;
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }

    initializeToasts() {
        // Toastの初期化
        const toastElList = document.querySelectorAll('.toast');
        toastElList.forEach(toastEl => new bootstrap.Toast(toastEl));
    }
}

// DOMContentLoadedで初期化
document.addEventListener('DOMContentLoaded', () => {
    new MenuManager();
});