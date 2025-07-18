<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HugoFPW')</title>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome untuk icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --secondary-color: #64748b;
            --success-color: #059669;
            --warning-color: #d97706;
            --danger-color: #dc2626;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --border-color: #e2e8f0;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
        }
        
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        body {
            background-color: var(--light-color);
            color: var(--text-primary);
            line-height: 1.6;
            padding-top: 0;
        }
        
        /* Navbar Styling */
        .navbar-professional {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            padding: 12px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }
        
        .navbar-brand:hover {
            color: var(--primary-dark) !important;
            transform: translateY(-1px);
        }
        
        .navbar-brand .brand-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 12px;
            font-size: 16px;
        }
        
        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px !important;
            border-radius: 6px;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
            background-color: rgba(37, 99, 235, 0.05);
        }
        
        .nav-link.active {
            color: var(--primary-color) !important;
            background-color: rgba(37, 99, 235, 0.1);
        }
        
        /* Button Styling */
        .btn-professional {
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .btn-primary-professional {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary-professional:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        
        .btn-outline-professional {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
        }
        
        .btn-outline-professional:hover {
            background-color: var(--light-color);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-danger-professional {
            background-color: var(--danger-color);
            color: white;
        }
        
        .btn-danger-professional:hover {
            background-color: #b91c1c;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }
        
        /* User Profile Dropdown */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            background-color: var(--light-color);
            border-radius: 8px;
            color: var(--text-primary);
            font-weight: 500;
            font-size: 14px;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }
        
        /* Main Content */
        .main-content {
            background-color: white;
            min-height: calc(100vh - 140px);
            margin-top: 80px;
            margin-bottom: 60px;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            padding: 32px;
        }
        
        /* Footer */
        .footer-professional {
            background-color: white;
            border-top: 1px solid var(--border-color);
            padding: 24px 0;
            margin-top: auto;
        }
        
        .footer-professional .footer-content {
            display: flex;
            justify-content: between;
            align-items: center;
            color: var(--text-muted);
            font-size: 14px;
        }
        
        .footer-links {
            display: flex;
            gap: 24px;
        }
        
        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
        }
        
        /* Navbar Toggle */
        .navbar-toggler {
            border: none;
            padding: 6px;
            border-radius: 6px;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2864, 116, 139, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin: 80px 16px 60px 16px;
                padding: 20px;
                border-radius: 8px;
            }
            
            .navbar-brand {
                font-size: 1.25rem;
            }
            
            .navbar-brand .brand-icon {
                width: 28px;
                height: 28px;
                margin-right: 8px;
            }
            
            .user-profile {
                padding: 4px 8px;
                font-size: 13px;
            }
            
            .user-avatar {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }
        }
        
        /* Utility Classes */
        .text-primary-custom { color: var(--primary-color) !important; }
        .text-secondary-custom { color: var(--text-secondary) !important; }
        .text-muted-custom { color: var(--text-muted) !important; }
        .bg-light-custom { background-color: var(--light-color) !important; }
        
        /* Loading Animation */
        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid currentColor;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Smooth Transitions */
        * {
            transition: color 0.2s ease, background-color 0.2s ease, border-color 0.2s ease;
        }
        
        /* Focus States */
        .btn-professional:focus,
        .nav-link:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-professional">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="brand-icon">
                    <i class="fas fa-cube"></i>
                </div>
                HugoFPW
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                {{-- Menu Kiri --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link">
                            <i class="fas fa-box me-1"></i>Produk
                        </a>
                    </li>
                    
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('wishlist.index') }}" class="nav-link">
                                <i class="fas fa-heart me-1"></i>Wishlist
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}" class="nav-link">
                                <i class="fas fa-shopping-bag me-1"></i>Pesanan
                            </a>
                        </li>
                        @if(Auth::user()->is_admin)
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                    <i class="fas fa-chart-line me-1"></i>Dashboard
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
                
                {{-- Menu Kanan --}}
                <div class="d-flex align-items-center gap-3">
                    @auth
                        <div class="user-profile">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-professional btn-outline-professional">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="d-none d-md-inline">Logout</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-professional btn-outline-professional">
                            <i class="fas fa-sign-in-alt"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-professional btn-primary-professional">
                            <i class="fas fa-user-plus"></i>Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Konten Halaman --}}
    <div class="container-fluid px-4">
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    <footer class="footer-professional">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="footer-content">
                        <span>&copy; {{ date('Y') }} HugoFPW. All rights reserved.</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-links justify-content-md-end d-flex">
                        <a href="#" class="text-decoration-none">Privacy Policy</a>
                        <a href="#" class="text-decoration-none">Terms of Service</a>
                        <a href="#" class="text-decoration-none">Support</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Professional JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Active navigation highlighting
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
            
            // Loading states for buttons
            const buttons = document.querySelectorAll('button[type="submit"]');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    if (!this.disabled && !this.classList.contains('loading')) {
                        this.classList.add('loading');
                        const originalContent = this.innerHTML;
                        
                        // Add loading spinner
                        this.innerHTML = '<span class="loading-spinner me-2"></span>' + 
                                        (this.textContent.trim() || 'Loading...');
                        
                        // Reset after 3 seconds (fallback)
                        setTimeout(() => {
                            this.classList.remove('loading');
                            this.innerHTML = originalContent;
                        }, 3000);
                    }
                });
            });
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Auto-collapse navbar on mobile after click
            const navbarCollapse = document.querySelector('.navbar-collapse');
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }
                });
            });
            
            // Keyboard navigation support
            document.addEventListener('keydown', function(e) {
                if (e.altKey && e.key === 'h') {
                    e.preventDefault();
                    window.location.href = '/';
                }
            });
        });
        
        // Utility function for showing notifications
        function showNotification(message, type = 'info') {
            const alertClass = type === 'success' ? 'alert-success' : 
                              type === 'error' ? 'alert-danger' : 
                              type === 'warning' ? 'alert-warning' : 'alert-info';
            
            const notification = document.createElement('div');
            notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 100px; right: 20px; z-index: 1050; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }
    </script>
</body>
</html>