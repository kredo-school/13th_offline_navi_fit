<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2">
    <div class="container-fluid px-5">
        <!-- Left side - Logo -->
        <a class="navbar-brand" href="#">
            <!-- Replace src with your actual image path -->
            <img src="{{ asset('images/navifit_icon.jpg') }}" alt="Logo" id="logo-image" width="50" height="50">
        </a>

        <!-- Navigation Links -->
        <div class="navbar-nav position-absolute start-50 translate-middle-x">
            <a class="nav-link text-dark fs-4 fw-medium" href="#" style="margin-left: -500px;">Menu</a>
            <a class="nav-link text-dark fs-4 fw-medium mx-5" href="#">Training</a>
            <a class="nav-link text-dark fs-4 fw-medium" href="#">Stats</a>
        </div>

        <!-- Right side - User info and settings -->
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-user fs-3 me-2"></i>
            <span class="text-dark fs-4 fw-medium me-4">User</span>
            <div class="dropdown">
                <button class="btn btn-link text-dark p-0 text-decoration-none dropdown-toggle" type="button"
                    id="settingsMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gear fs-3"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsMenuButton">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Goal</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>

        </div>
    </div>
</nav>
