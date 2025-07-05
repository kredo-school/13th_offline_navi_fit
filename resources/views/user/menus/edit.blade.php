@extends('layouts.app')
 
@section('title', 'Menu-Edit')
 
@section('content')
@php $hideNavigation = true; @endphp {{--ここに一行追加--}}

    <div class="min-vh-100" style="background-color: #f8f9fa;">
    {{-- Header --}}
    @include('user.menus.partials.edit.header')

    {{-- Main Content - 3 Column Layout --}}
    <div class="container-fluid px-5 py-3">
        <div class="row g-3" style="height: calc(100vh - 200px);">
            {{-- Left Column - Template Library (3/12) --}}
            <div class="col-3">
                @include('user.menus.partials.edit.template-library')
            </div>

            {{-- Center Column - Menu Editor (6/12) --}}
            <div class="col-6 d-flex flex-column">
                {{-- Basic Information Card --}}
                @include('user.menus.partials.edit.basic-info')
                
                {{-- Exercise Editor Card --}}
                @include('user.menus.partials.edit.exercise-editor')
            </div>

            {{-- Right Column - Exercise Catalog (3/12) --}}
            <div class="col-3">
                @include('user.menus.partials.edit.exercise-catalog')
            </div>
        </div>
    </div>

    {{-- AI Proposal Modal --}}
    {{-- @include('menu.partials.ai-proposal-modal') --}}

    {{-- Notification Toast --}}
    {{-- @include('menu.partials.notification-toast') --}}
</div>

@push('styles')
<style>
/* スクロールバーを常に表示し、幅の変化を防止 */
.card-body.overflow-auto {
    overflow-y: scroll !important; /* 常にスクロールバーを表示 */
    scrollbar-width: thin; /* Firefox用 */
    -ms-overflow-style: scrollbar; /* IE/Edge用 */
}

/* ホバー効果 */
.drag-handle {
    cursor: move;
}
.drag-over {
    background-color: #e3f2fd !important;
    border-color: #2196f3 !important;
}
.dragging {
    opacity: 0.5;
}

/* collapseアニメーションの無効化 */
.collapse {
    transition: none !important;
}

/* 列の高さを固定 */
.col-3, .col-6 {
    height: calc(100vh - 200px);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // トグルボタンのクリックイベントを処理
    const toggleButtons = document.querySelectorAll('.toggle-details');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // クリックイベントの伝播を停止
            e.stopPropagation();
            
            // 現在のスクロール位置を記憶
            const scrollContainer = document.querySelector('.template-library-container').parentElement;
            const scrollPos = scrollContainer.scrollTop;
            
            // collapseの表示/非表示が完了した後にスクロール位置を復元
            setTimeout(() => {
                scrollContainer.scrollTop = scrollPos;
            }, 10);
        });
    });
});
</script>
@endpush
@endsection
 
@section('footer')
    
@endsection