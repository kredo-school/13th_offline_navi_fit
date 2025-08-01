@extends('layouts.app')

@section('title', 'Training History')

@section('content')
@php $hideNavigation = true; @endphp {{--ここに一行追加--}}
<body class="bg-light">
    <div class="min-vh-100">
        {{-- Header --}}
        @include('user.training-history.partials.header')
        
        <div class="container-xxl py-4">
            {{-- Overview Panel --}}
            {{-- @include('user.training-history.partials.overview') --}}
            
            {{-- Quick Filters --}}
            @include('user.training-history.partials.quick_filters')
            
            {{-- Advanced Filters --}}
            @include('user.training-history.partials.advanced_filters')
            
            {{-- Results Summary --}}
            @include('user.training-history.partials.results_summary')
            
            {{-- Training Records List --}}
            @include('user.training-history.partials.records_list')
            
            {{-- Pagination --}}
            @include('user.training-history.partials.pagination')
        </div>
    </div>
</body>
@endsection

@section('footer')

@endsection