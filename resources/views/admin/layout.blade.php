<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'NaviFit') }}</title>
    <meta name="description" content="NaviFit 管理画面">
    <meta name="theme-color" content="#343a40">
    <link rel="icon" type="image/png" href="{{ asset('images/navifit_icon.jpg') }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Admin-specific styles (optional) -->
    @vite(['resources/sass/admin.scss', 'resources/js/admin.js'])

    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-header {
            background-color: #343a40;
            color: white;
            padding: 1rem;
        }
        @media (max-width: 576px) {
            .admin-header .nav {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <div id="admin-app">
        {{-- 共通のヘッダー --}}
        <header class="admin-header mb-4" role="banner">
            <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center">
                <h1 class="h4 mb-0" aria-label="Admin Dashboard" title="Admin Dashboard"></h1>
                <nav class="nav gap-2" aria-label="Admin navigation">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm" aria-label="Admin Dashboard" title="Dashboard"><i class="fas fa-home me-1"></i>Dashboard</a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm" aria-label="User Panel" title="User Panel">User Panel</a>
                    <a href="{{ route('admin.templates.index') }}" class="btn btn-outline-light btn-sm" aria-label="Templates" title="Templates"><i class="fas fa-layer-group me-1"></i>Templates</a>
                    <a href="{{ route('admin.exercises.index') }}" class="btn btn-outline-light btn-sm" aria-label="Exercises" title="Exercises"><i class="fas fa-dumbbell me-1"></i>Exercises</a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light btn-sm" aria-label="Users" title="Users"><i class="fas fa-users me-1"></i>Users</a>
                </nav>
            </div>
        </header>

        {{-- コンテンツ領域 --}}
        <main class="container-fluid" role="main">
            @yield('content')
        </main>
    </div>
</body>

</html>
