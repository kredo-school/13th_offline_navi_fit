@extends('layouts.auth')

@section('title', 'register')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        {{-- 2列グリッド: username + e-mail --}}
        <div class="form-row">
            <div class="form-group">
                <input id="name" 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    name="name"
                    value="{{ old('name') }}" 
                    placeholder="username" 
                    required 
                    autofocus 
                    autocomplete="name">

                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input id="email" 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="e-mail" 
                    required 
                    autocomplete="email">

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- パスワード入力フィールド（表示/非表示トグル付き） --}}
        <div class="form-group" x-data="{ showPassword: false }">
            <div style="position: relative;">
                <input id="password" 
                    x-bind:type="showPassword ? 'text' : 'password'"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" 
                    placeholder="password" 
                    required 
                    autocomplete="new-password"
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
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- パスワード確認入力フィールド（表示/非表示トグル付き） --}}
        <div class="form-group" x-data="{ showConfirmPassword: false }">
            <div style="position: relative;">
                <input id="password-confirm" 
                    x-bind:type="showConfirmPassword ? 'text' : 'password'"
                    class="form-control" 
                    name="password_confirmation"
                    placeholder="confirm password" 
                    required 
                    autocomplete="new-password"
                    style="padding-right: 45px;">

                {{-- パスワード確認表示/非表示トグルボタン --}}
                <button type="button"
                    x-on:click="showConfirmPassword = !showConfirmPassword"
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
                    title="パスワード確認を表示/非表示"
                    onmouseover="this.style.color='#374151'"
                    onmouseout="this.style.color='#6b7280'">
                    
                    {{-- 目のアイコン（パスワード確認表示時） --}}
                    <i x-show="showConfirmPassword" 
                        class="fas fa-eye"
                        style="font-size: 16px;"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"></i>
                    
                    {{-- 目に斜線のアイコン（パスワード確認非表示時） --}}
                    <i x-show="!showConfirmPassword" 
                        class="fas fa-eye-slash"
                        style="font-size: 16px;"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"></i>
                </button>
            </div>
        </div>

        {{-- 登録ボタン --}}
        <button type="submit" class="btn-primary">Register</button>
    </form>

    {{-- 認証関連のリンク --}}
    <div class="auth-links">
        <a href="{{ route('login') }}">→ I have an account</a>
    </div>
@endsection