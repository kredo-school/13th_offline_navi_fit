@extends('layouts.app')

@section('title', 'Training History Details')

@section('content')
@php $hideNavigation = true; @endphp
    <div class="min-vh-100 bg-light">
        {{-- Header --}}
        @include('user.training-history.partials.show.header')

        {{-- Delete Confirmation Banner (static display) --}}
        {{-- @include('partials.training_detail_delete_banner') --}}

        <div class="container-xxl py-4">
            {{-- Hero Section --}}
            @include('user.training-history.partials.show.hero')

            {{-- Metrics Dashboard --}}
            @include('user.training-history.partials.show.metrics')

            <div class="row g-4">
                {{-- Exercise Details --}}
                <div class="col-lg-8">
                    @include('user.training-history.partials.show.exercises')
                </div>

                {{-- Notes and Quick Stats --}}
                <div class="col-lg-4">
                    @include('user.training-history.partials.show.notes')
                    @include('user.training-history.partials.show.quick_stats')
                    @include('user.training-history.partials.show.personal_records')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection
