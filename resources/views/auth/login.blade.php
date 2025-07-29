@extends('layouts.auth')

@section('title', 'login')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="email" required autocomplete="email" autofocus>


            @error('email')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group" x-data="{ showPassword: false }">
            <div class="relative">
                <input 
                    id="password" 
                    x-bind:type="showPassword ? 'text' : 'password'"
                    class="form-control pr-10 @error('password') is-invalid @enderror"
                    name="password" 
                    placeholder="password" 
                    required 
                    autocomplete="current-password">

                <button 
                    type="button"
                    x-on:click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 flex items-center justify-center w-10 text-gray-600 hover:text-gray-800 focus:outline-none transition-colors cursor-pointer"
                    tabindex="-1"
                    title="パスワードを表示/非表示">
                    <i x-show="showPassword" 
                       class="fas fa-eye text-lg"
                       style="font-size: 16px;"
                       x-transition:enter="transition ease-out duration-150"
                       x-transition:enter-start="opacity-0 scale-90"
                       x-transition:enter-end="opacity-100 scale-100"></i>
                    <i x-show="!showPassword" 
                       class="fas fa-eye-slash text-lg"
                       style="font-size: 16px;"
                       x-transition:enter="transition ease-out duration-150"
                       x-transition:enter-start="opacity-0 scale-90"
                       x-transition:enter-end="opacity-100 scale-100"></i>
                </button>
            </div>

            @error('password')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn-primary">
            Login
        </button>
    </form>

    <div class="auth-links"> 
        <a href="{{ route('register') }}">→ create new account</a>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">forgot your password?</a>
        @endif
    </div>

@endsection
