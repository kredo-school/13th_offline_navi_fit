@extends('layouts.auth')

@section('title', 'login')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        {{-- メールアドレス入力フィールド --}}
        <div class="form-group">
            <input id="email" 
                type="email" 
                class="form-control @error('email') is-invalid @enderror" 
                name="email"
                value="{{ old('email') }}" 
                placeholder="Email" 
                required 
                autocomplete="email" 
                autofocus>

            @error('email')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- パスワード入力フィールド（表示/非表示トグル付き） --}}
        <div class="form-group" x-data="{ showPassword: false }">
            <div style="position: relative;">
                <input id="password" 
                    x-bind:type="showPassword ? 'text' : 'password'"
                    class="form-control @error('password') is-invalid @enderror" 
                    name="password"
                    placeholder="Password" 
                    required 
                    autocomplete="current-password"
                    style="padding-right: 45px;">

                {{-- パスワード表示/非表示トグルボタン --}}
                <button type="button" 
                    x-on:click="showPassword = !showPassword"
                    style="position: absolute; 
                           top: 0; 
                           right: 0; 
                           bottom: 0; 
                           width: 40px; 
                           border: none; 
                           background: transparent; 
                           display: flex; 
                           align-items: center; 
                           justify-content: center; 
                           cursor: pointer;
                           color: #6b7280;
                           transition: color 0.2s ease;"
                    tabindex="-1" 
                    title="パスワードを表示/非表示"
                    onmouseover="this.style.color='#374151'"
                    onmouseout="this.style.color='#6b7280'">
                    
                    {{-- 目のアイコン（パスワード表示時） --}}
                    <i x-show="showPassword" 
                        class="fas fa-eye" 
                        style="font-size: 16px;"
                        x-transition:enter="transition ease-out duration-150" 
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"></i>
                    
                    {{-- 目に斜線のアイコン（パスワード非表示時） --}}
                    <i x-show="!showPassword" 
                        class="fas fa-eye-slash" 
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

        {{-- ログイン状態を保持するチェックボックス --}}
        <div class="form-group">
            <div style="display: flex; align-items: center;">
                <input id="remember" 
                    type="checkbox" 
                    name="remember" 
                    style="margin-right: 8px;" 
                    {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" 
                    style="font-size: 14px; color: #6b7280; cursor: pointer;">
                    Remember me
                </label>
            </div>
        </div>

        {{-- ログインボタン --}}
        <button type="submit" class="btn-primary">
            Login
        </button>
    </form>

    {{-- 認証関連のリンク --}}
    <div class="auth-links">
        <a href="{{ route('register') }}">→ Create new account</a>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Forgot your password?</a>
        @endif
        <a href="{{ route('admin.login') }}">Admin Login</a>
    </div>

@endsection