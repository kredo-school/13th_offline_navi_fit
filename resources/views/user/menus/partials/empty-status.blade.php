<div class="col-12">
    <div class="card border-0 bg-transparent">
        <div class="card-body text-center py-5">
            <div class="mb-4">
                <i class="fa-solid fa-dumbbell text-muted" style="font-size: 4rem;"></i>
            </div>
            <h3 class="h4 text-muted mb-3">メニューが見つかりません</h3>
            <p class="text-muted mb-4">
                条件に一致するメニューがありません。<br>
                検索条件やフィルターを変更してみてください。
            </p>
            <a href="{{ route('menus.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>
                新しいメニューを作成
            </a>
        </div>
    </div>
</div>
