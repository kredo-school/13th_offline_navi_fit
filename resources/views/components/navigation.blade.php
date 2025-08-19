<header class="navigation-header" 
        x-data="navigationState()" 
        x-init="init()"
        :class="{ 'scrolled': isScrolled }"
        style="position: sticky; top: 0; z-index: 1030; transition: all 0.3s ease;">
    
    <div class="glassmorphism-bg"></div>
    
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg py-3" :class="{ 'py-2': isScrolled }">
        <div class="container-fluid px-4 px-lg-5">
            
            <!-- Mobile toggler -->
            <button class="navbar-toggler border-0 p-2" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" 
                    aria-expanded="false" 
                    aria-label="メニューを開く">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Left side: Logo and Navigation links -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="d-flex align-items-center gap-1 gap-lg-3">
                    <!-- Logo -->
                    <a class="navbar-brand me-3 me-lg-4" 
                       href="{{ route('dashboard') }}"
                       aria-label="NaviFitホームに戻る">
                        <img src="{{ asset('images/navifit_icon.jpg') }}" 
                             alt="NaviFit Logo" 
                             id="logo-image"
                             :style="{ width: isScrolled ? '35px' : '40px', height: isScrolled ? '35px' : '40px' }"
                             style="transition: all 0.3s ease; border-radius: 8px;">
                    </a>
                    
                    <!-- Navigation Links -->
                    <div class="d-flex align-items-center gap-1">
                        <a href="#" 
                           class="nav-link-custom"
                           data-nav-item="training"
                           aria-current="{{ request()->routeIs('training.*') ? 'page' : 'false' }}">
                            <span class="link-text">Training</span>
                            <div class="link-underline"></div>
                        </a>
                        
                        <a href="{{ route('menus.index') }}" 
                           class="nav-link-custom"
                           data-nav-item="menu"
                           aria-current="{{ request()->routeIs('menus.*') ? 'page' : 'false' }}">
                            <span class="link-text">Menu</span>
                            <div class="link-underline"></div>
                        </a>
                        
                        <a href="#" 
                           class="nav-link-custom"
                           data-nav-item="stats"
                           aria-current="{{ request()->routeIs('stats.*') ? 'page' : 'false' }}">
                            <span class="link-text">Stats</span>
                            <div class="link-underline"></div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right side: User info and actions -->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                
                <!-- User info (Hidden on mobile) -->
                <div class="d-none d-lg-flex align-items-center gap-3">
                    <!-- User avatar and greeting -->
                    <div class="d-flex align-items-center gap-2">
                        @php
                            $avatar = Auth::user()->profile->avatar ?? null;
                            $userName = Auth::user()->name ?? 'User';
                        @endphp
                        
                        @if ($avatar)
                            <img src="{{ asset('storage/' . $avatar) }}" 
                                 alt="{{ $userName }}のプロフィール画像"
                                 class="user-avatar">
                        @else
                            <div class="user-avatar-placeholder">
                                <span>{{ strtoupper(substr($userName, 0, 1)) }}</span>
                            </div>
                        @endif
                        
                        <span class="user-greeting">
                            Hello, {{ $userName }}!
                        </span>
                    </div>
                    
                    <!-- Divider -->
                    <div class="vr opacity-50"></div>
                    
                    <!-- Goal info -->
                    <div class="goal-info">
                        @php
                            $activeGoal = Auth::user()->activeGoal();
                        @endphp
                        <span class="goal-label">Goal:</span>
                        <span class="goal-weight">{{ $activeGoal ? $activeGoal->formatted_weight : '-' }}kg</span>
                        <span class="goal-separator">/</span>
                        <span class="goal-days">{{ $activeGoal ? $activeGoal->days_remaining : '-' }} days</span>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="d-flex align-items-center gap-2">
                    <!-- Notification button -->
                    <button class="action-btn" 
                            type="button"
                            aria-label="通知を確認">
                        <i class="fa-solid fa-bell"></i>
                        <span class="notification-badge d-none"></span>
                    </button>
                    
                    <!-- Settings dropdown -->
                    <div class="dropdown">
                        <button class="action-btn"
                                type="button"
                                data-bs-toggle="dropdown" 
                                aria-expanded="false"
                                aria-label="設定メニューを開く">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        
                        <ul class="dropdown-menu dropdown-menu-end glass border-0 shadow-lg mt-2">
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('profile.index') }}">
                                    <i class="fa-solid fa-user me-2"></i> 
                                    プロフィール設定
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('goal.index') }}">
                                    <i class="fa-solid fa-bullseye me-2"></i> 
                                    目標設定
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <i class="fa-solid fa-bell me-2"></i> 
                                    通知設定
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('account.index') }}">
                                    <i class="fa-solid fa-gear me-2"></i> 
                                    アカウント設定
                                </a>
                            </li>
                            
                            @if (auth()->check() && auth()->user()->is_admin)
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                        <i class="fa-solid fa-user-shield me-2"></i> 
                                        管理者ダッシュボード
                                    </a>
                                </li>
                            @endif
                            
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="fa-solid fa-sign-out-alt me-2"></i>
                                        ログアウト
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
    .navigation-header {
        --nav-blur: 10px;
        position: relative;
    }
    
    .glassmorphism-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--glass-bg);
        backdrop-filter: blur(var(--nav-blur));
        -webkit-backdrop-filter: blur(var(--nav-blur));
        border-bottom: 1px solid var(--border-light);
        z-index: -1;
    }
    
    .nav-link-custom {
        position: relative;
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1rem;
        text-decoration: none;
        color: #333;
        font-size: 1rem;
        font-weight: 500;
        border-radius: 0.5rem;
        transition: all 0.25s ease;
        min-height: 44px;
        overflow: hidden;
    }
    
    [data-bs-theme="dark"] .nav-link-custom {
        color: #e9ecef;
    }
    
    .nav-link-custom[aria-current="page"] {
        background: var(--hover-bg-light);
        font-weight: 600;
        color: var(--brand);
    }
    
    [data-bs-theme="dark"] .nav-link-custom[aria-current="page"] {
        background: var(--hover-bg-dark);
        color: var(--brand);
    }
    
    .nav-link-custom:hover:not([aria-current="page"]) {
        background: rgba(28, 137, 205, 0.05);
        color: var(--brand);
    }
    
    .nav-link-custom:hover .link-underline {
        transform: scaleX(1);
    }
    
    .nav-link-custom:focus {
        outline: 2px solid var(--brand);
        outline-offset: 2px;
        color: var(--brand);
    }
    
    .link-underline {
        position: absolute;
        bottom: 8px;
        left: 1rem;
        right: 1rem;
        height: 2px;
        background: var(--brand);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.25s ease;
        border-radius: 1px;
    }
    
    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 2px solid rgba(28, 137, 205, 0.3);
        object-fit: cover;
        transition: all 0.25s ease;
    }
    
    .user-avatar-placeholder {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--slate), var(--brand-strong));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
        border: 2px solid rgba(28, 137, 205, 0.3);
        transition: all 0.25s ease;
    }
    
    .user-greeting {
        font-weight: 500;
        font-size: 1rem;
        color: #333;
    }
    
    .goal-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }
    
    .goal-label {
        color: var(--text-secondary);
    }
    
    .goal-weight {
        font-weight: 600;
        color: var(--brand);
    }
    
    .goal-separator {
        color: var(--text-muted);
    }
    
    .goal-days {
        font-weight: 600;
        color: var(--accent2);
    }

    
    .notification-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 8px;
        height: 8px;
        background: #dc3545;
        border-radius: 50%;
        border: 2px solid white;
    }

    
    .navigation-header.scrolled .navbar {
        transition: all 0.3s ease;
    }
    
    .navigation-header.scrolled .user-avatar,
    .navigation-header.scrolled .user-avatar-placeholder {
        width: 32px;
        height: 32px;
    }
    
    .navigation-header.scrolled .user-greeting {
        font-size: 0.9rem;
    }
    
    .navigation-header.scrolled .goal-info {
        font-size: 0.85rem;
    }
    
    .navigation-header.scrolled .action-btn {
        width: 36px;
        height: 36px;
    }
    
    @media (max-width: 991.98px) {
        .nav-link-custom {
            padding: 0.5rem 0.75rem;
            margin: 0.25rem 0;
        }
        
        .navbar-collapse {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-light);
        }
    }
    
    @media (prefers-reduced-motion: reduce) {
        .navigation-header *,
        .navigation-header *::before,
        .navigation-header *::after {
            transition: none !important;
            animation: none !important;
        }
    }
    
    @media (prefers-contrast: high) {
        .nav-link-custom {
            border: 1px solid transparent;
        }
        
        .nav-link-custom:focus {
            border-color: var(--brand);
        }
    }
</style>

<script>
    function navigationState() {
        return {
            isScrolled: false,
            scrollThreshold: 10,
            
            init() {
                this.handleScroll = this.debounce(this.handleScroll.bind(this), 10);
                window.addEventListener('scroll', this.handleScroll);
                
                this.setActiveNavItem();
                
                this.$cleanup(() => {
                    window.removeEventListener('scroll', this.handleScroll);
                });
            },
            
            handleScroll() {
                const scrollY = window.scrollY;
                this.isScrolled = scrollY > this.scrollThreshold;
            },
            
            setActiveNavItem() {
                const currentPath = window.location.pathname;
                const navItems = document.querySelectorAll('[data-nav-item]');
                
                navItems.forEach(item => {
                    const navType = item.getAttribute('data-nav-item');
                    let isActive = false;
                    
                    switch(navType) {
                        case 'training':
                            isActive = currentPath.includes('/training');
                            break;
                        case 'menu':
                            isActive = currentPath.includes('/menu');
                            break;
                        case 'stats':
                            isActive = currentPath.includes('/stats');
                            break;
                    }
                    
                    if (isActive) {
                        item.setAttribute('aria-current', 'page');
                    } else {
                        item.setAttribute('aria-current', 'false');
                    }
                });
            },
            
            debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
        }
    }
</script>