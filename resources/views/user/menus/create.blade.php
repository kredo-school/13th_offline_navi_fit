{{-- resources/views/user/menus/partials/create/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Menu-Create')

@section('content')
    @php $hideNavigation = true; @endphp {{-- ナビゲーションを非表示 --}}

    <div class="min-vh-100" style="background-color: #f8f9fa;">
        {{-- Header --}}
        @include('user.menus.partials.create.header')

        {{-- Main Content - 3 Column Layout --}}
        <div class="container-fluid px-5 py-3">
            <div class="row g-3" style="height: calc(100vh - 200px);">
                {{-- Left Column - Template Library (3/12) --}}
                <div class="col-3">
                    @include('user.menus.partials.create.template-library')
                </div>

                {{-- Center Column - Menu Editor (6/12) --}}
                <div class="col-6 d-flex flex-column">
                    {{-- Basic Information Card --}}
                    @include('user.menus.partials.create.basic-info')

                    {{-- Exercise Editor Card --}}
                    @include('user.menus.partials.create.exercise-editor')
                </div>

                {{-- Right Column - Exercise Catalog (3/12) --}}
                <div class="col-3">
                    {{-- @include('user.menus.partials.create.exercise-catalog') --}}
                    <livewire:exercise-catalog />
                </div>
            </div>
        </div>
    </div>
    {{-- モーダルを追加 --}}
    {{-- @include('user.menus.partials.modals.exercise-details-modal') --}}
    @include('user.menus.partials.modals.template-details-modal')
@endsection

@section('footer')

@endsection