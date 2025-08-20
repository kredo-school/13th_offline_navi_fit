@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<main class="container-fluid py-4">
    <!-- Calendar Section - New -->
    <section class="mb-4">
        <div class="row">
            <div class="col-12">
                @include('user.dashboard.partials.calendar')
            </div>
        </div>
    </section>

    <!-- Training Section -->
    <section class="mb-4">
        <div class="row g-4">
            <div class="col-lg-4">
                @include('user.dashboard.partials.todays-workout')
            </div>
            
            <div class="col-lg-8">
                @include('user.dashboard.partials.recent-workouts')
            </div>
        </div>
    </section>

    <!-- Data Section -->
    <section class="mb-4">
        <div class="row g-4">
            <div class="col-lg-6">
                @include('user.dashboard.partials.weight-body-form')
            </div>
            
            <div class="col-lg-6">
                @include('user.dashboard.partials.create-menu')
            </div>
        </div>
    </section>

    <!-- Analysis Section -->
    <section>
        <div class="row g-4">
            <div class="col-lg-8">
                @include('user.dashboard.partials.progress-chart')
            </div>
            
            <div class="col-lg-4">
                @include('user.dashboard.partials.achievement-summary')
            </div>
        </div>
    </section>
</main>
@endsection
