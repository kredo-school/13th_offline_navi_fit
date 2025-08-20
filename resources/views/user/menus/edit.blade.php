{{-- resources/views/user/menus/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Menu-Edit')

@section('content')
    @php $hideNavigation = true; @endphp {{-- ナビゲーションを非表示 --}}

    <div>
        {{-- Header --}}
        @include('user.menus.partials.edit.header')

        {{-- Main Content - 3 Column Layout --}}
        <div class="container-fluid px-5 py-3">
            <div class="row g-3" style="height: calc(100vh - 200px);">
                {{-- Left Column - Template Library (3/12) --}}
                <div class="col-3">
                    <livewire:template-library />
                </div>

                {{-- Center Column - Menu Editor (6/12) --}}
                <div class="col-6 d-flex flex-column">
                    {{-- Exercise Editor Card (Livewire) --}}
                    <livewire:exercise-editor-edit :menu="$menu" />
                </div>

                {{-- Right Column - Exercise Catalog (3/12) --}}
                <div class="col-3">
                    <livewire:exercise-catalog />
                </div>
            </div>
        </div>
    </div>
    {{-- Template Details Modal --}}
    @include('user.menus.partials.modals.template-details-modal')
@endsection

@section('footer')

@endsection