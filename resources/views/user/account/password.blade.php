@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Change Password</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('account.password.update') }}">
                            @csrf

                            <div class="mb-3" x-data="{ showCurrent: false }">
                                <label for="current_password" class="form-label">Current Password</label>
                                <div class="position-relative">
                                    <input id="current_password" type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        name="current_password" required autocomplete="current-password" aria-label="Current Password" autofocus tabindex="1"
                                        x-bind:type="showCurrent ? 'text' : 'password'">
                                    <button type="button" x-on:click="showCurrent = !showCurrent"
                                        class="btn btn-link position-absolute top-50 end-0 translate-middle-y px-2 py-0 text-secondary"
                                        tabindex="-1" aria-label="Show/Hide Current Password" title="Show/Hide Password" style="font-size: 1.1rem;">
                                        <i x-show="showCurrent" class="fas fa-eye"></i>
                                        <i x-show="!showCurrent" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3" x-data="{ showNew: false }">
                                <label for="password" class="form-label">New Password</label>
                                <div class="position-relative">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" aria-label="New Password" tabindex="2"
                                        x-bind:type="showNew ? 'text' : 'password'">
                                    <button type="button" x-on:click="showNew = !showNew"
                                        class="btn btn-link position-absolute top-50 end-0 translate-middle-y px-2 py-0 text-secondary"
                                        tabindex="-1" aria-label="Show/Hide New Password" title="Show/Hide Password" style="font-size: 1.1rem;">
                                        <i x-show="showNew" class="fas fa-eye"></i>
                                        <i x-show="!showNew" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3" x-data="{ showConfirm: false }">
                                <label for="password-confirm" class="form-label">Confirm New Password</label>
                                <div class="position-relative">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password" aria-label="Confirm New Password" tabindex="3"
                                        x-bind:type="showConfirm ? 'text' : 'password'">
                                    <button type="button" x-on:click="showConfirm = !showConfirm"
                                        class="btn btn-link position-absolute top-50 end-0 translate-middle-y px-2 py-0 text-secondary"
                                        tabindex="-1" aria-label="Show/Hide Confirm Password" title="Show/Hide Password" style="font-size: 1.1rem;">
                                        <i x-show="showConfirm" class="fas fa-eye"></i>
                                        <i x-show="!showConfirm" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <button type="submit" class="btn btn-primary d-flex align-items-center gap-2" aria-label="Update Password" tabindex="4">
                                    <i class="fas fa-key"></i> Update Password
                                </button>
                                <a href="{{ route('account.index') }}" class="btn btn-secondary d-flex align-items-center gap-2" aria-label="Back to Account Settings" tabindex="5">
                                    <i class="fas fa-arrow-left"></i> Back to Account Settings
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
