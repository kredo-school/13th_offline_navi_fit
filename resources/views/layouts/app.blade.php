<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NaviFit') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles

    <style>
        /* Alpine.js初期化中のちらつきを防ぐ */
        [x-cloak] { 
            display: none !important; 
        }
        
        /* ロゴのデフォルトサイズを設定してちらつきを防ぐ */
        #logo-image {
            width: 40px;
            height: 40px;
            transition: all 0.3s ease;
            border-radius: 8px;
        }
        
        /* スクロール時のサイズ（Alpine.js初期化後に適用） */
        .navigation-header.scrolled #logo-image {
            width: 35px !important;
            height: 35px !important;
        }
        
        /* ナビゲーション全体の初期状態を安定化 */
        .navigation-header {
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        
        .navigation-header:not([x-cloak]) {
            opacity: 1;
        }
    </style>

</head>

<body class="{{ isset($hideNavigation) && $hideNavigation ? '' : 'with-navbar' }}">
    <div id="app">
        {{-- 超シンプル：$hideNavigationが設定されていない限りNavigationを表示 --}}
        @unless (isset($hideNavigation) && $hideNavigation)
            <x-navigation />
        @endunless

        <main class="py-4" style="background-color: #f8f9fa;">
            @yield('content')
        </main>
    </div>

    @livewireScripts
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>
        
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/ja.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Push用スクリプト -->
    @stack('scripts')
</body>

</html>
