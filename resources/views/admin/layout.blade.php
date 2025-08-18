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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Admin-specific styles (optional) -->
    @vite(['resources/sass/admin.scss', 'resources/js/admin.js'])

    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 100px;
            /* ナビゲーション固定用の余白 */
        }

        .admin-header {
            background-color: #343a40;
            color: white;
            padding: 0.75rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .admin-nav-menu {
            display: flex;
            gap: 0.5rem;
        }

        .admin-nav-toggler {
            display: none;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: white;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
        }

        .admin-title {
            font-size: 1.25rem;
            margin-bottom: 0;
        }

        .nav-link-admin {
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.2s;
        }

        .nav-link-admin:hover,
        .nav-link-admin.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        @media (max-width: 768px) {
            .admin-header .container-fluid {
                padding: 0.5rem;
            }

            .admin-nav-toggler {
                display: block;
            }

            .admin-nav-menu {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                flex-direction: column;
                background-color: #343a40;
                padding: 0.5rem 1rem;
                gap: 0.5rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                display: none;
            }

            .admin-nav-menu.show {
                display: flex;
            }

            .nav-link-admin {
                display: block;
                width: 100%;
                text-align: left;
                padding: 0.75rem 1rem;
            }
        }
    </style>
</head>

<body>
    <div id="admin-app">
        {{-- 共通のヘッダー --}}
        <header class="admin-header" role="banner">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="admin-title" aria-label="Admin Dashboard">NaviFit Admin</h1>

                <button class="admin-nav-toggler" type="button" id="adminNavToggler" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <nav class="admin-nav-menu" id="adminNavMenu" aria-label="Admin navigation">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home me-1"></i>Dashboard
                    </a>
                    <a href="{{ route('dashboard') }}" class="nav-link-admin">
                        <i class="fas fa-user me-1"></i>User Panel
                    </a>
                    <a href="{{ route('admin.templates.index') }}"
                        class="nav-link-admin {{ request()->routeIs('admin.templates.*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group me-1"></i>Templates
                    </a>
                    <a href="{{ route('admin.exercises.index') }}"
                        class="nav-link-admin {{ request()->routeIs('admin.exercises.*') ? 'active' : '' }}">
                        <i class="fas fa-dumbbell me-1"></i>Exercises
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link-admin {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users me-1"></i>Users
                    </a>
                </nav>
            </div>
        </header>

        {{-- コンテンツ領域 --}}
        <main class="container-fluid" role="main">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <!-- ナビゲーションのためのJS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggler = document.getElementById('adminNavToggler');
            const menu = document.getElementById('adminNavMenu');

            if (toggler && menu) {
                toggler.addEventListener('click', function() {
                    menu.classList.toggle('show');
                    toggler.setAttribute('aria-expanded', menu.classList.contains('show'));
                });

                // メニュー外クリックで閉じる
                document.addEventListener('click', function(event) {
                    if (!menu.contains(event.target) && !toggler.contains(event.target) && menu.classList
                        .contains('show')) {
                        menu.classList.remove('show');
                        toggler.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    </script>
</body>

</html>
