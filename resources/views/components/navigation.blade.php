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
                        <i class="fa-solid fa-circle-user text-primary fs-5"></i>
                        <span class="fw-medium fs-5">
                            Hello, {{ Auth::user()->name ?? 'User' }}!
                        </span>
                    </div>
                    <div class="vr"></div>
                    <div class="d-flex align-items-center gap-2 text-muted fs-5">
                        <span>Goal:</span>
                        <span class="fw-semibold text-primary">5.5kg</span>
                        <span>/</span>
                        <span class="fw-semibold text-success">30 days</span>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-light rounded-circle p-2">
                        <i class="fa-solid fa-bell fa-lg"></i>
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light d-flex align-items-center gap-1 p-2"
                            data-bs-toggle="dropdown">
                            <i class="fa-solid fa-gear fa-lg"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profile Settings</a></li>
                            <li><a class="dropdown-item" href="#">Notification Settings</a></li>
                            <li><a class="dropdown-item" href="#">Account Settings</a></li>
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
