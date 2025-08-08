<header class="bg-white shadow-sm border-bottom">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container-fluid px-5">
            <!-- Navbar toggler for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Left side: Navigation links -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="d-flex align-items-center gap-4">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/navifit_icon.jpg') }}" alt="NaviFit Logo" id="logo-image"
                            width="40" height="40">
                    </a>
                    <a href="#" class="nav-link text-dark fs-5 fw-medium">Training</a>
                    <a href="{{ route('menus.index') }}" class="nav-link text-dark fs-5 fw-medium">Menu</a>
                    <a href="#" class="nav-link text-dark fs-5 fw-medium">Stats</a>
                </div>
            </div>

            <!-- Right side: User info and actions -->
            <div class="d-flex align-items-center gap-3">
                <!-- User greeting and goal info -->
                <div class="d-none d-lg-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        @php
                            $avatar = Auth::user()->profile->avatar ?? null;
                        @endphp
                        @if ($avatar)
                            <img src="{{ asset('storage/' . $avatar) }}" alt="Profile Avatar"
                                class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <span
                                    style="font-size: 1.2rem;">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</span>
                            </div>
                        @endif
                        <span class="fw-medium fs-5">
                            Hello, {{ Auth::user()->name ?? 'User' }}!
                        </span>
                    </div>
                    <div class="vr"></div>
                    <div class="d-flex align-items-center gap-2 text-muted fs-5">
                        <span>Goal:</span>
                        @php
                            $activeGoal = Auth::user()->activeGoal();
                        @endphp
                        <span
                            class="fw-semibold text-primary">{{ $activeGoal ? $activeGoal->formatted_weight : '-' }}kg</span>
                        <span>/</span>
                        <span class="fw-semibold text-success">{{ $activeGoal ? $activeGoal->days_remaining : '-' }}
                            days</span>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-light rounded-circle p-2">
                        <i class="fa-solid fa-bell fa-lg"></i>
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light d-flex align-items-center gap-1 p-2 dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-gear fa-lg"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i
                                        class="fa-solid fa-user"></i> Profile Settings</a></li>
                            <li><a class="dropdown-item" href="{{ route('goal.index') }}"><i
                                        class="fa-solid fa-bullseye"></i> Goal Settings</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bell"></i> Notification
                                    Settings</a></li>
                            <li><a class="dropdown-item" href="{{ route('account.index') }}"><i
                                        class="fa-solid fa-gear"></i> Account Settings</a></li>
                            @if (auth()->check() && auth()->user()->is_admin)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fa-solid fa-user-shield"></i> Admin Dashboard
                                    </a>
                                </li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
