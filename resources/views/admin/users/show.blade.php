@extends('admin.layout')

@section('title', 'User Details')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">User Details</h3>
                    <div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back to List
                        </a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Basic Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 40%">ID</th>
                                            <td>{{ $user->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Role</th>
                                            <td>
                                                <span class="badge {{ $user->is_admin ? 'bg-primary' : 'bg-secondary' }}">
                                                    {{ $user->is_admin ? 'Administrator' : 'Regular User' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Registered</th>
                                            <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $user->updated_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Profile Information</h5>
                                </div>
                                <div class="card-body">
                                    @if ($user->profile)
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 40%">Gender</th>
                                                <td>{{ $user->profile->gender ?? 'Not specified' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Age</th>
                                                <td>{{ $user->profile->age ?? 'Not specified' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Height</th>
                                                <td>{{ $user->profile->height ? $user->profile->height . ' cm' : 'Not specified' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Weight</th>
                                                <td>{{ $user->profile->weight ? $user->profile->weight . ' kg' : 'Not specified' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Experience Level</th>
                                                <td>{{ $user->profile->experience_level ?? 'Not specified' }}</td>
                                            </tr>
                                        </table>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            This user has not set up their profile yet.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">User Statistics</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-4">
                                        <div class="col-md-3">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h3 class="mb-0">{{ $user->menus()->count() }}</h3>
                                                    <p class="text-muted mb-0">Menus Created</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h3 class="mb-0">{{ $user->trainingRecords()->count() }}</h3>
                                                    <p class="text-muted mb-0">Training Records</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h3 class="mb-0">{{ $user->goals()->count() }}</h3>
                                                    <p class="text-muted mb-0">Goals Set</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card bg-light">
                                                <div class="card-body text-center">
                                                    <h3 class="mb-0">{{ $user->bodyRecords()->count() }}</h3>
                                                    <p class="text-muted mb-0">Body Records</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($user->id !== auth()->id())
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="card-title mb-0">Administration Actions</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn {{ $user->is_active ? 'btn-danger' : 'btn-success' }}">
                                                    <i
                                                        class="fas {{ $user->is_active ? 'fa-user-slash' : 'fa-user-check' }} me-1"></i>
                                                    {{ $user->is_active ? 'Deactivate Account' : 'Activate Account' }}
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn {{ $user->is_admin ? 'btn-secondary' : 'btn-primary' }}">
                                                    <i
                                                        class="fas {{ $user->is_admin ? 'fa-user-minus' : 'fa-user-shield' }} me-1"></i>
                                                    {{ $user->is_admin ? 'Remove Admin Rights' : 'Grant Admin Rights' }}
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                class="ms-auto">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                                    <i class="fas fa-trash me-1"></i>Delete User
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
