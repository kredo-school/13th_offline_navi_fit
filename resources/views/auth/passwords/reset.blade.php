@extends('layouts.auth')

@section('title', 'reset-password')

@section('content')
    <!-- Information Text -->
    <div style="margin-bottom: 2rem; text-align: left;">
        <p style="color: #6b7280; font-size: 0.9rem; line-height: 1.6; margin: 0;">
            Please set a new password for your account. Choose a secure password to protect your data.
        </p>
    </div>

    <!-- Password Reset Form -->
    <form method="POST" action="{{ route('password.update') }}" class="auth-form">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email Field (Read-only style) -->
        <div class="form-group">
            <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}"
                readonly style="background-color: #f3f4f6; color: #6b7280; cursor: not-allowed;" autocomplete="email">

            @error('email')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- New Password Field -->
        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" placeholder="new password" required autocomplete="new-password">

            @error('password')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                placeholder="confirm password" required autocomplete="new-password">
        </div>

        <!-- Password Requirements -->
        <div
            style="margin-bottom: 1.5rem; padding: 1rem; background-color: #f8fafc; border: 1px solid #e5e7eb; border-radius: 8px; text-align: left;">
            <p style="color: #374151; font-size: 0.875rem; font-weight: 600; margin: 0 0 0.5rem 0;">Password Requirements:
            </p>
            <ul style="color: #6b7280; font-size: 0.8rem; margin: 0; padding-left: 1.2rem; line-height: 1.4;">
                <li>At least 8 characters</li>
                <li>Include uppercase letters</li>
                <li>Include numbers</li>
                <li>Include special characters (recommended)</li>
            </ul>
        </div>

        <button type="submit" class="btn-primary">
            Reset Password
        </button>
    </form>

    <!-- Back to Login Link -->
    <div class="auth-links">
        <a href="{{ route('login') }}">← Back to Login</a>
    </div>
@endsection
