@extends('layouts.app')

@section('title', 'Menu List')

@section('content')
<body class="bg-light">
    <div class="container py-4">
        {{-- ヘッダーセクション --}}
        @include('user.menus.partials.header')

        {{-- 検索バー --}}
        @include('user.menus.partials.search-bar')

        {{-- フィルターパネル --}}
        @include('user.menus.partials.filter-panel')

        {{-- メニューグリッド --}}
        <div class="row g-4 pt-5" id="menuGrid">
            {{-- @forelse($menus as $menu) --}}
                @include('user.menus.partials.menu-card')
            {{-- @empty
                @include('user.menus.partials.empty-states')
            @endforelse --}}
        </div>
    </div>

    {{-- モーダル --}}
    @include('user.menus.partials.modals.delete-modal')

    {{-- トースト通知 --}}
    @include('user.menus.components.toasts')
</body>
@endsection

@push('scripts')
    @vite('resources/js/menus/index.js')
@endpush