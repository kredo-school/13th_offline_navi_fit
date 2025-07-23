<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'NaviFit') }}</title>

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
    </style>
</head>

<body>
    <div id="admin-app">
        {{-- 共通のヘッダー --}}
        <header class="admin-header mb-4">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">Admin Dashboard</h1>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">User Panel</a>
            </div>
        </header>

        {{-- コンテンツ領域 --}}
        <main class="container">
            @yield('content')
        </main>
    </div>
</body>

</html>
