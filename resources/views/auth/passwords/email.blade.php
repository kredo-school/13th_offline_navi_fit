@extends('layouts.auth')

@section('title', 'forgot-password')

@section('content')
    <!-- Success Message -->
    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert"
            style="background-color: #d1fae5; border: 1px solid #34d399; color: #065f46; padding: 1rem; border-radius: 8px; text-align: left;">
            <div style="display: flex; align-items: center;">
                <svg style="width: 20px; height: 20px; margin-right: 8px; color: #059669;" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                {{ session('status') }}
            </div>
        </div>
    @endif

    <!-- Information Text -->
    <div style="margin-bottom: 2rem; text-align: left;">
        <p style="color: #6b7280; font-size: 0.9rem; line-height: 1.6; margin: 0;">
            Forgot your password? Enter your email address and we'll send you a password reset link.
        </p>
    </div>

    <!-- Password Reset Form -->
    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
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

        <button type="submit" class="btn-primary">
            Send Password Reset Link
        </button>
    </form>

    <!-- Back to Login Link -->
    <div class="auth-links">
        <a href="{{ route('login') }}">← Back to Login</a>
    </div>
@endsection
 