{{-- 検索バー --}}
<div class="mb-4">
    <!-- 動的化時はactionを実際のルートに置換 -->
    <form action="#" method="GET" id="searchForm">
        <div class="position-relative">
            <i class="fa-solid fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
            <!-- 動的化時はvalueを動的に設定 -->
            <input type="text" class="form-control ps-5" name="search" id="searchInput" placeholder="メニューを検索..." value="">
        </div>
    </form>
</div>