<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Management System') - Shree Hotel</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;800;900&family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Rozha+One&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #0f766e;
            --primary-dark: #0d9488;
            --primary-light: #14b8a6;
            --accent: #d97706;
            --accent-light: #f59e0b;
            --bg-dark: #0f172a;
            --sidebar-bg: #1e293b;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html, body {
            max-width: 100vw;
            width: 100%;
            overflow-x: hidden !important;
            position: relative;
        }

        body {
            background-color: #f1f5f9;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .brand-header {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        @keyframes logoGlow {
            0%, 100% {
                box-shadow: 0 0 6px rgba(245, 158, 11, 0.25), 0 0 12px rgba(217, 119, 6, 0.15);
                border-color: rgba(245, 158, 11, 0.4);
            }
            50% {
                box-shadow: 0 0 10px rgba(245, 158, 11, 0.35), 0 0 18px rgba(245, 158, 11, 0.2);
                border-color: rgba(254, 240, 138, 0.6);
            }
        }

        .brand-icon {
            width: 54px;
            height: 54px;
            background: linear-gradient(135deg, #10b981 0%, #0f766e 50%, #f59e0b 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid rgba(245, 158, 11, 0.4);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2), 0 0 8px rgba(245, 158, 11, 0.2);
            animation: logoGlow 4s infinite ease-in-out;
            padding: 2px;
            position: relative;
            z-index: 2;
            overflow: hidden;
        }

        .brand-logo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));
            transition: filter 0.3s ease;
        }

        .brand-logo-img:hover {
            filter: brightness(1.15);
        }

        .brand-title {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #ffffff;
            line-height: 1.2;
        }

        .text-shree {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 22px;
            letter-spacing: 0.5px;
            text-transform: none;
            background: linear-gradient(135deg, #ffffff 0%, #fef08a 35%, #f59e0b 70%, #d97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 2px 8px rgba(245, 158, 11, 0.5));
        }

        .text-hotel {
            color: #ffffff;
            font-weight: 700;
        }

        .brand-subtitle {
            font-size: 11px;
            color: var(--accent-light);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .nav-menu {
            padding: 20px 12px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .nav-category {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748b;
            font-weight: 700;
            padding: 12px 14px 6px 14px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
            transition: all 0.25s ease;
        }

        .nav-link i {
            font-size: 17px;
            width: 20px;
            text-align: center;
            transition: transform 0.2s ease;
        }

        .nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(4px);
        }

        .nav-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 15px rgba(15, 118, 110, 0.35);
        }

        .nav-link.active i {
            color: #ffffff;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(0, 0, 0, 0.2);
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 14px;
        }

        .user-info {
            overflow: hidden;
            flex-grow: 1;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #ffffff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: #94a3b8;
        }

        /* Main Content Wrapper */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Top Header Navigation */
        .top-header {
            background: #ffffff;
            height: 70px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title-area {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .page-heading {
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-view-site {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #475569;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-view-site:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #fef2f2;
            border: 1px solid #fee2e2;
            border-radius: 8px;
            color: #ef4444;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: #ef4444;
            color: #ffffff;
        }

        /* Main Content Body */
        .content-body {
            padding: 30px;
            flex-grow: 1;
        }

        /* Admin Footer */
        .admin-footer {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 20px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            color: #64748b;
        }

        .admin-footer a {
            color: #0f766e;
            text-decoration: none;
            font-weight: 600;
        }

        .admin-footer a:hover {
            text-decoration: underline;
        }

        /* Alert Banners */
        .alert-box {
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
            font-weight: 500;
            animation: fadeIn 0.3s ease;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-danger, .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-info {
            background-color: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .alert-close {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 16px;
            opacity: 0.7;
        }

        .alert-close:hover {
            opacity: 1;
        }

        /* Reusable UI Components */
        .card-custom {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            padding: 24px;
            margin-bottom: 24px;
        }

        .card-header-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-title-custom {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.25);
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(15, 118, 110, 0.35);
            color: #ffffff;
        }

        .btn-secondary-custom {
            background: #f1f5f9;
            color: #475569;
            padding: 10px 20px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-secondary-custom:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        /* Styled Form Inputs */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-control, .form-select, textarea.form-control {
            width: 100%;
            padding: 11px 16px;
            font-size: 14px;
            color: #1e293b;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control:focus, .form-select:focus, textarea.form-control:focus {
            background-color: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
        }

        /* Modern Table */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            background: #ffffff;
        }

        .custom-table th {
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 700;
            padding: 16px 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .custom-table td {
            padding: 16px 20px;
            color: #334155;
            font-size: 14px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .custom-table tbody tr:last-child td {
            border-bottom: none;
        }

        .custom-table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Badges */
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: capitalize;
        }

        .badge-available, .badge-confirmed, .badge-paid {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-booked, .badge-cancelled, .badge-failed {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #b45309;
        }

        .badge-completed, .badge-refunded {
            background-color: #e0e7ff;
            color: #4338ca;
        }

        /* Action Buttons */
        .action-link {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .action-edit {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .action-edit:hover {
            background-color: #0284c7;
            color: #ffffff;
        }

        .action-delete {
            background-color: #fef2f2;
            color: #dc2626;
        }

        .action-delete:hover {
            background-color: #dc2626;
            color: #ffffff;
        }

        /* Mobile Overlay Backdrop */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
            z-index: 99;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
        }

        .btn-mobile-sidebar {
            display: none;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #0f172a;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-mobile-sidebar:hover {
            background: #f1f5f9;
            color: #0f766e;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
            .main-wrapper { margin-left: 0; width: 100%; }
            .sidebar.mobile-open { transform: translateX(0); }
            .btn-mobile-sidebar { display: flex; }
            .top-header { padding: 16px 20px; }
            .content-body { padding: 20px 16px; }
        }

        @media (max-width: 768px) {
            .header-actions span { display: none; }
            .header-actions a { padding: 8px 12px; }
            .card-custom { padding: 16px; border-radius: 12px; }
            .card-header-custom { flex-direction: column; align-items: flex-start; gap: 12px; }
            .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
            .table-custom { min-width: 580px; }
            .page-heading { font-size: 18px; }
            .admin-footer { flex-direction: column; gap: 12px; text-align: center; }
            .user-info { display: none; }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="brand-header">
            <div class="brand-icon">
                <img src="{{ asset('assets/images/shree_logo.png') }}" alt="Shree Hotel Logo" class="brand-logo-img">
            </div>
            <div>
                <div class="brand-title">
                    <span class="text-shree">Shree</span> <span class="text-hotel">Hotel</span>
                </div>
                <div class="brand-subtitle">Luxury Hotel & Suites</div>
            </div>
        </div>

        <nav class="nav-menu">
            <div class="nav-category">Main Menu</div>
            <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Home Page</span>
            </a>

            @if(session('user_role') === 'admin')
                <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>

                <div class="nav-category">Management</div>
                <a href="{{ url('roomshow') }}" class="nav-link {{ Request::is('roomshow', 'room', 'roomedit*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bed"></i>
                    <span>Rooms</span>
                </a>

                <a href="{{ url('booking_show') }}" class="nav-link {{ Request::is('booking_show', 'booking_edit*') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>All Bookings</span>
                </a>

                <a href="{{ url('mybooking') }}" class="nav-link {{ Request::is('mybooking') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-clock"></i>
                    <span>My Bookings</span>
                </a>

                <a href="{{ url('payment_show') }}" class="nav-link {{ Request::is('payment_show', 'payment', 'payment_edit*') ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Payments</span>
                </a>

                <a href="{{ url('gallery') }}" class="nav-link {{ Request::is('gallery*') ? 'active' : '' }}">
                    <i class="fa-solid fa-images"></i>
                    <span>Gallery Manager</span>
                </a>

                <div class="nav-category">Quick Actions</div>
                <a href="{{ url('booking') }}" class="nav-link {{ Request::is('booking') ? 'active' : '' }}">
                    <i class="fa-solid fa-plus-circle"></i>
                    <span>New Booking</span>
                </a>
                <a href="{{ url('room') }}" class="nav-link {{ Request::is('room') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-circle-plus"></i>
                    <span>Add Room</span>
                </a>
                <a href="{{ url('payment') }}" class="nav-link {{ Request::is('payment') ? 'active' : '' }}">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Record Payment</span>
                </a>
            @else
                <div class="nav-category">User Portal</div>
                <a href="{{ url('booking') }}" class="nav-link {{ Request::is('booking') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-plus"></i>
                    <span>Reserve a Room</span>
                </a>
                <a href="{{ url('mybooking') }}" class="nav-link {{ Request::is('mybooking') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-clock"></i>
                    <span>My Bookings</span>
                </a>
                <a href="{{ url('logout') }}" class="nav-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <div class="user-pill">
                <div class="user-avatar">
                    {{ strtoupper(substr(session('user_name', 'User'), 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ session('user_name', 'Guest User') }}</div>
                    <div class="user-role">{{ session('user_email', 'User Account') }}</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-wrapper">
        <!-- Top Navigation -->
        <header class="top-header">
            <div class="header-title-area" style="display: flex; align-items: center; gap: 14px;">
                <button class="btn-mobile-sidebar" id="mobileSidebarBtn" onclick="toggleSidebar()" aria-label="Toggle Navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1 class="page-heading">@yield('page_heading', 'Dashboard')</h1>
            </div>

            <div class="header-actions">
                <a href="{{ url('/') }}" target="_blank" class="btn-view-site">
                    <i class="fa-solid fa-globe"></i>
                    <span>Public Site</span>
                </a>
                <a href="{{ url('logout') }}" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-body">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert-box alert-success">
                    <div><i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}</div>
                    <button class="alert-close" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-box alert-danger">
                    <div><i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}</div>
                    <button class="alert-close" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if(session('msg'))
                <div class="alert-box alert-{{ session('type') == 'danger' ? 'danger' : (session('type') == 'success' ? 'success' : 'info') }}">
                    <div><i class="fa-solid fa-info-circle me-2"></i> {{ session('msg') }}</div>
                    <button class="alert-close" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Admin Footer -->
        <footer class="admin-footer">
            <div>
                © {{ date('Y') }} <strong>Shree Hotel Management System</strong>. All rights reserved.
            </div>
            <div style="display: flex; gap: 20px;">
                <a href="{{ url('/') }}" target="_blank"><i class="fa-solid fa-globe me-1"></i> Public Website</a>
                <a href="{{ url('dashboard') }}"><i class="fa-solid fa-chart-pie me-1"></i> Dashboard</a>
            </div>
        </footer>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar && overlay) {
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('active');
            }
        }
    </script>

    @yield('scripts')
</body>
</html>
