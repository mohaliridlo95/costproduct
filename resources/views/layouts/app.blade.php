<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Food Cost Calculator')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     @yield('styles')
    <style>
        body {
    background-color: #f8f9fa;
            padding-bottom: 70px; /* Tambahkan ruang agar tidak menutupi navigasi */
        }
        

.bg-light {
    background-color: #ffffff !important;
    border: 1px solid #e3e3e3;
}

.shadow-sm {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.display-4 {
    font-size: 2.5rem;
    font-weight: 700;
}

.text-primary {
    color: #007bff !important;
}

textarea.form-control {
    resize: none;
}
        .sticky-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
            padding: 10px 0;
        }
        .sticky-nav .nav-item {
            flex: 1;
            text-align: center;
        }
        .sticky-nav .nav-link {
            color: #333;
            font-size: 1.2rem;
        }
        .sticky-nav .nav-link.active {
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        @yield('content')
    </div>

    <!-- Sticky Navigation -->
    <nav class="sticky-nav d-flex justify-content-between">
        <div class="nav-item">
            <a href="/home" class="nav-link {{ request()->is('/home') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Home
            </a>
        </div>
        <div class="nav-item">
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-calculator-fill"></i> Calculate
            </a>
        </div>
        <div class="nav-item">
            <a href="/history" class="nav-link {{ request()->is('history') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> History
            </a>
        </div>
        <div class="nav-item">
            <a href="/saran" class="nav-link {{ request()->is('saran') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> saran
            </a>
        </div>
    </nav>

@yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

