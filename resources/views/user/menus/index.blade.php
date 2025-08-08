@extends('layouts.app')

@section('title', 'Menu List')

@section('content')

    <body class="bg-light">
        <div class="container-fluid px-4 py-4">
            <div class="row">
                <!-- サイドバー（フィルター） -->
                <div class="col-lg-3 col-xl-2 mb-4">
                    @include('user.menus.partials.filter-panel')
                </div>

                <!-- メインコンテンツ -->
                <div class="col-lg-9 col-xl-10">
                    {{-- ヘッダーセクション --}}
                    @include('user.menus.partials.header')

                    {{-- 検索バー --}}
                    @include('user.menus.partials.search-bar')

                    {{-- メニューグリッド --}}
                    <div class="row g-4 pt-4" id="menuGrid">
                        @forelse($menus as $menu)
                            @include('user.menus.partials.menu-card', ['menu' => $menu])
                        @empty
                            @include('user.menus.partials.empty-status')
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- モーダル --}}
        @include('user.menus.partials.modals.delete-modal')

        {{-- トースト通知 --}}
        @include('user.menus.components.toasts')
    </body>
@endsection
