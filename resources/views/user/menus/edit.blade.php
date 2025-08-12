@extends('layouts.app')

@section('title', 'Menu-Edit')

@section('content')
    @php $hideNavigation = true; @endphp {{-- ここに一行追加 --}}

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

        {{-- Template Details Modal --}}
        @include('user.menus.partials.modals.template-details-modal')

        {{-- Notification Toast --}}
        {{-- @include('menu.partials.notification-toast') --}}
    </div>


@endsection

@section('footer')

@endsection
