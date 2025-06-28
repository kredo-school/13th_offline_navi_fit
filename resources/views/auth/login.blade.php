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

        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" placeholder="password" required autocomplete="current-password">

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
