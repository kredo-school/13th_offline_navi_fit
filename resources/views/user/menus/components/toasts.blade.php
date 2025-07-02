{{-- トースト通知 --}}
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
    {{-- 成功トースト --}}
    <div class="toast align-items-center text-bg-success border-0" 
         role="alert" 
         aria-live="assertive" 
         aria-atomic="true"
         id="successToast"
         data-bs-delay="3000">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle me-2"></i>
                <span class="toast-message">操作が正常に完了しました</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    {{-- エラートースト --}}
    <div class="toast align-items-center text-bg-danger border-0" 
         role="alert" 
         aria-live="assertive" 
         aria-atomic="true"
         id="errorToast"
         data-bs-delay="5000">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-exclamation-circle me-2"></i>
                <span class="toast-message">エラーが発生しました</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    {{-- 警告トースト --}}
    <div class="toast align-items-center text-bg-warning border-0" 
         role="alert" 
         aria-live="assertive" 
         aria-atomic="true"
         id="warningToast"
         data-bs-delay="4000">
        <div class="d-flex">
            <div class="toast-body text-dark">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <span class="toast-message">注意が必要です</span>
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    {{-- 情報トースト --}}
    <div class="toast align-items-center text-bg-info border-0" 
         role="alert" 
         aria-live="assertive" 
         aria-atomic="true"
         id="infoToast"
         data-bs-delay="3000">
        <div class="d-flex">
            <div class="toast-body text-dark">
                <i class="bi bi-info-circle me-2"></i>
                <span class="toast-message">お知らせ</span>
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

{{-- セッションメッセージからのトースト表示 --}}
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showToast('success', '{{ session('success') }}');
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showToast('error', '{{ session('error') }}');
        });
    </script>
@endif

@if(session('warning'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showToast('warning', '{{ session('warning') }}');
        });
    </script>
@endif

@if(session('info'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showToast('info', '{{ session('info') }}');
        });
    </script>
@endif