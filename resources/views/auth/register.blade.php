@extends('layouts.auth')

@section('title', 'register')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <!-- 2列グリッド: username + e-mail -->
        <div class="form-row">
            <div class="form-group">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" placeholder="username" required autofocus autocomplete="name">

                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" placeholder="e-mail" required autocomplete="email">

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- password + confirm password -->
        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" placeholder="password" required autocomplete="new-password">

            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                placeholder="confirm password" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn-primary">Registar</button>
    </form>

    <div class="auth-links">
        <a href="{{ route('login') }}">→ I have an account</a>
    </div>
@endsection
