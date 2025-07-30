
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - {{ config('app.name', 'NaviFit') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Vite (Alpine.js + Tailwind CSS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- NaviFit Auth Styles -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 1rem;">
            <div class="text-center mb-4">
                <span class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 80px; height: 80px;">
                    <i class="fas fa-user-shield text-white fs-2"></i>
                </span>
                <h2 class="fw-bold mb-0">Admin Login</h2>
            </div>
            <form method="POST" action="{{ route('admin.login') }}" class="auth-form">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                    @error('email')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group" x-data="{ showPassword: false }">
                    <div class="relative">
                        <input id="password" x-bind:type="showPassword ? 'text' : 'password'"
                            class="form-control pr-10 @error('password') is-invalid @enderror" name="password"
                            placeholder="Password" required autocomplete="current-password">
                        <button type="button" x-on:click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center justify-center w-10 text-gray-600 hover:text-gray-800 focus:outline-none transition-colors cursor-pointer"
                            tabindex="-1" title="Show/Hide Password">
                            <i x-show="showPassword" class="fas fa-eye text-lg" style="font-size: 16px;"
                                x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"></i>
                            <i x-show="!showPassword" class="fas fa-eye-slash text-lg" style="font-size: 16px;"
                                x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" name="remember" class="mr-2" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="text-sm text-gray-600 cursor-pointer">
                            Remember me
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn-primary">
                    Login
                </button>
                
                <div class="text-center mt-2">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                </div>
                <div class="text-center mt-2">
                    <a href="{{ route('login') }}" class="text-decoration-none">User Login</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
