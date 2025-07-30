@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-user-cog me-2"></i>Account Settings</span>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm"
                            aria-label="Edit Profile"><i class="fas fa-edit"></i></a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('info'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <h4 class="mb-3"><i class="fas fa-image me-2"></i>Profile Image</h4>
                        <div class="row mb-4 align-items-center">
                            <div class="col-md-4 text-center">
                                @if ($user->profile && $user->profile->avatar)
                                    <img src="{{ asset('storage/' . $user->profile->avatar) }}" alt="Profile Avatar"
                                        class="img-thumbnail rounded-circle mb-2"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mb-2"
                                        style="width: 150px; height: 150px; margin: 0 auto;">
                                        <span style="font-size: 50px;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <form action="{{ route('account.avatar.update') }}" method="POST"
                                    enctype="multipart/form-data" aria-label="Update Profile Image">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="avatar" class="form-label">Update Profile Image</label>
                                        <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                            id="avatar" name="avatar" aria-describedby="avatarHelp" accept="image/*">
                                        <div id="avatarHelp" class="form-text">Supported formats: JPG, PNG, GIF. Max size:
                                            2MB.</div>
                                        @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-upload me-1"></i>Upload
                                        New Image</button>
                                </form>
                                @if ($user->profile && $user->profile->avatar)
                                    <form action="{{ route('account.avatar.delete') }}" method="POST" class="mt-2"
                                        aria-label="Remove Profile Image">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash-alt me-1"></i>Remove Image</button>
                                    </form>
                                @endif
                            </div>
                        </div>


                        <h4 class="mb-3"><i class="fas fa-id-card me-2"></i>Account Information</h4>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row" style="width: 30%;">Name</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Account Created</th>
                                        <td>{{ $user->created_at->format('F j, Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('account.password') }}" class="btn btn-primary me-md-2 mb-2 mb-md-0"
                                aria-label="Change Password"><i class="fas fa-key me-1"></i>Change Password</a>
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary mb-2 mb-md-0"
                                aria-label="Edit Profile Information"><i class="fas fa-user-edit me-1"></i>Edit Profile
                                Information</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
