<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shree Hotel - Luxury Hotel & Suites</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;800;900&family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Rozha+One&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        html, body {
            max-width: 100vw;
            width: 100%;
            overflow-x: hidden !important;
            position: relative;
        }

        body {
            background-color: #0f172a;
            color: #f8fafc;
        }

        /* Navigation Bar */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 60px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
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

        .brand-logo-icon {
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

        .brand-logo-text {
            font-family: 'Outfit', sans-serif;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #ffffff;
        }

        .text-shree {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 26px;
            letter-spacing: 0.5px;
            text-transform: none;
            background: linear-gradient(135deg, #ffffff 0%, #fef08a 35%, #f59e0b 70%, #d97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 2px 10px rgba(245, 158, 11, 0.5));
        }

        .text-hotel {
            color: #ffffff;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.25s ease;
        }

        .nav-links a:hover {
            color: #f59e0b;
        }

        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-nav-outline {
            padding: 9px 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .btn-nav-outline:hover {
            border-color: #f59e0b;
            color: #f59e0b;
            background: rgba(245, 158, 11, 0.08);
        }

        .btn-nav-gold {
            padding: 9px 22px;
            background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
            border-radius: 30px;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(217, 119, 6, 0.35);
            transition: all 0.25s ease;
        }

        .btn-nav-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(217, 119, 6, 0.5);
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.35) 0%, rgba(15, 23, 42, 0.6) 60%, rgba(15, 23, 42, 0.92) 100%), 
                        url('{{ asset("assets/images/hero_bg.jpg") }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            padding: 140px 60px 60px 60px;
            position: relative;
        }

        .hero-content {
            max-width: 750px;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: rgba(217, 119, 6, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 30px;
            color: #f59e0b;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 24px;
        }

        .hero-title {
            font-family: 'Outfit', sans-serif;
            font-size: 60px;
            font-weight: 800;
            line-height: 1.15;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .hero-description {
            font-size: 18px;
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 36px;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn-hero-primary {
            padding: 16px 36px;
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%);
            color: #ffffff;
            border-radius: 30px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(15, 118, 110, 0.4);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(15, 118, 110, 0.6);
        }

        .btn-hero-secondary {
            padding: 16px 32px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-radius: 30px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* Section Layouts */
        .section-padding {
            padding: 90px 60px;
        }

        .section-header {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 60px auto;
        }

        .section-subtitle {
            color: #f59e0b;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .section-title {
            font-family: 'Outfit', sans-serif;
            font-size: 38px;
            font-weight: 700;
            color: #ffffff;
        }

        /* About Section */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .about-image-stack {
            position: relative;
        }

        .about-img-main {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border: 1px solid #334155;
        }

        .about-badge-card {
            position: absolute;
            bottom: -20px;
            right: 0;
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%);
            padding: 20px 24px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 118, 110, 0.4);
            color: white;
            text-align: center;
        }

        .about-badge-card .num {
            font-family: 'Outfit', sans-serif;
            font-size: 36px;
            font-weight: 800;
            line-height: 1;
        }

        .about-badge-card .txt {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 4px;
        }

        .about-text h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 32px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .about-text p {
            color: #94a3b8;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .about-list {
            list-style: none;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .about-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #e2e8f0;
            font-size: 14px;
            font-weight: 500;
        }

        .about-list li i {
            color: #f59e0b;
        }

        /* Rooms Showcase */
        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .room-card {
            background: #1e293b;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #334155;
            transition: all 0.3s ease;
        }

        .room-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border-color: #0f766e;
        }

        .room-card-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .room-card-body {
            padding: 24px;
        }

        .room-card-title {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 8px;
        }

        .room-card-price {
            font-size: 22px;
            font-weight: 800;
            color: #f59e0b;
            margin-bottom: 14px;
        }

        .room-card-price span {
            font-size: 13px;
            color: #94a3b8;
            font-weight: 400;
        }

        .room-card-desc {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Features Section */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 20px;
            padding: 32px 24px;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            border-color: #0f766e;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .feature-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(15, 118, 110, 0.2) 0%, rgba(20, 184, 166, 0.1) 100%);
            border: 1px solid rgba(20, 184, 166, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #14b8a6;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .feature-card p {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.6;
        }

        /* Photo Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            height: 250px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: filter 0.3s ease;
        }

        .gallery-item:hover img {
            filter: brightness(1.1);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(0deg, rgba(15, 23, 42, 0.9) 0%, rgba(0,0,0,0) 70%);
            display: flex;
            align-items: flex-end;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-title {
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
        }

        /* Contact Section */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .contact-info-box {
            background: #1e293b;
            border-radius: 24px;
            padding: 40px;
            border: 1px solid #334155;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(217, 119, 6, 0.15);
            color: #f59e0b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .info-text h4 {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .info-text p {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.6;
        }

        .contact-form-box {
            background: #1e293b;
            border-radius: 24px;
            padding: 40px;
            border: 1px solid #334155;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group-contact {
            margin-bottom: 20px;
        }

        .form-group-contact label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 8px;
        }

        .form-input-contact, textarea.form-input-contact {
            width: 100%;
            padding: 12px 16px;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 12px;
            color: #ffffff;
            font-size: 14px;
            outline: none;
            transition: all 0.25s ease;
        }

        .form-input-contact:focus, textarea.form-input-contact:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.15);
        }

        .btn-submit-contact {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(15, 118, 110, 0.3);
        }

        .btn-submit-contact:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(15, 118, 110, 0.5);
        }

        /* Multi-column Footer */
        .footer {
            background-color: #070c18;
            padding: 80px 60px 30px 60px;
            border-top: 1px solid #1e293b;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .footer-brand p {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.7;
            margin-top: 16px;
            max-width: 320px;
        }

        .footer-col-title {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.25s ease;
        }

        .footer-links a:hover {
            color: #f59e0b;
        }

        .footer-bottom {
            padding-top: 30px;
            border-top: 1px solid #1e293b;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #64748b;
            font-size: 14px;
        }

        .social-icons {
            display: flex;
            gap: 14px;
        }

        .social-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #1e293b;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .social-btn:hover {
            background: #d97706;
            color: #ffffff;
            transform: translateY(-3px);
        }

        .mobile-nav-toggle {
            display: none;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .mobile-nav-drawer {
            display: none;
            position: fixed;
            top: 75px;
            left: 0;
            width: 100%;
            background: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(16px);
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            z-index: 999;
            flex-direction: column;
            gap: 12px;
            transform: translateY(-10px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .mobile-nav-drawer.active {
            display: flex;
            transform: translateY(0);
            opacity: 1;
        }

        .mobile-nav-drawer a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            padding: 10px 14px;
            border-radius: 10px;
            transition: background 0.2s ease;
        }

        .mobile-nav-drawer a:hover {
            background: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
        }

        @media (max-width: 992px) {
            .navbar { padding: 14px 20px; }
            .nav-links, .nav-buttons { display: none; }
            .mobile-nav-toggle { display: flex; }
            .hero-section { padding: 120px 20px 60px 20px; }
            .hero-title { font-size: 40px; }
            .hero-actions { flex-direction: column; width: 100%; gap: 14px; }
            .btn-hero-primary, .btn-hero-secondary { width: 100%; justify-content: center; }
            .section-padding { padding: 60px 20px; }
            .about-grid, .contact-grid { grid-template-columns: 1fr; gap: 35px; }
            .about-badge-card { right: 0; bottom: -20px; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .footer-bottom { flex-direction: column; gap: 20px; text-align: center; }
        }

        @media (max-width: 576px) {
            .hero-section { padding: 110px 16px 50px 16px; min-height: auto; }
            .hero-title { font-size: 30px; }
            .hero-description { font-size: 14px; line-height: 1.6; }
            .hero-tag { font-size: 11px; padding: 6px 14px; margin-bottom: 16px; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
            .contact-info-box, .contact-form-box { padding: 24px 18px; border-radius: 18px; }
            .about-list { grid-template-columns: 1fr; gap: 12px; }
            .about-badge-card { position: relative; bottom: auto; right: auto; margin-top: 20px; width: 100%; text-align: center; border-radius: 14px; }
            .footer { padding: 50px 20px 30px 20px; }
            .footer-grid { grid-template-columns: 1fr; gap: 30px; }
            .brand-logo-text { font-size: 20px; }
            .text-shree { font-size: 22px; }
            .brand-logo-icon { width: 44px; height: 44px; }
            .rooms-grid { grid-template-columns: 1fr; }
            .features-grid { grid-template-columns: 1fr; }
            .gallery-grid { grid-template-columns: 1fr; }
            .section-title { font-size: 28px; }
            .about-text h3 { font-size: 24px; }
        }
    </style>
</head>
<body>

    <!-- Header Navigation Bar -->
    <nav class="navbar">
        <a href="{{ url('/') }}" class="brand-logo">
            <div class="brand-logo-icon">
                <img src="{{ asset('assets/images/shree_logo.png') }}" alt="Shree Hotel Logo" class="brand-logo-img">
            </div>
            <div class="brand-logo-text"><span class="text-shree">Shree</span> <span class="text-hotel">Hotel</span></div>
        </a>

        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#rooms">Suites & Rooms</a></li>
            <li><a href="#amenities">Amenities</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>

        <div class="nav-buttons">
            @if (session()->has('user_id'))
                @if (session('user_role') === 'admin')
                    <a href="{{ url('dashboard') }}" class="btn-nav-outline">
                        <i class="fa-solid fa-chart-pie me-1"></i> Admin Dashboard
                    </a>
                @endif
                <a href="{{ url('logout') }}" class="btn-nav-outline" style="border-color: rgba(239, 68, 68, 0.4); color: #f87171;">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                </a>
            @endif
        </div>

        <button class="mobile-nav-toggle" id="mobileNavToggle" onclick="toggleMobileNav()" aria-label="Toggle Navigation">
            <i class="fa-solid fa-bars"></i>
        </button>
    </nav>

    <!-- Mobile Drawer Navigation -->
    <div class="mobile-nav-drawer" id="mobileNavDrawer">
        <a href="{{ url('/') }}" onclick="toggleMobileNav()"><i class="fa-solid fa-house me-2"></i> Home</a>
        <a href="#about" onclick="toggleMobileNav()"><i class="fa-solid fa-hotel me-2"></i> About Us</a>
        <a href="#rooms" onclick="toggleMobileNav()"><i class="fa-solid fa-bed me-2"></i> Suites & Rooms</a>
        <a href="#amenities" onclick="toggleMobileNav()"><i class="fa-solid fa-concierge-bell me-2"></i> Amenities</a>
        <a href="#gallery" onclick="toggleMobileNav()"><i class="fa-solid fa-images me-2"></i> Gallery</a>
        <a href="#contact" onclick="toggleMobileNav()"><i class="fa-solid fa-envelope me-2"></i> Contact</a>
        <hr style="border-color: rgba(255,255,255,0.1); margin: 6px 0;">
        @if (session()->has('user_id'))
            <a href="{{ url('booking') }}"><i class="fa-solid fa-calendar-plus me-2 text-warning"></i> Book Room</a>
            <a href="{{ url('mybooking') }}"><i class="fa-solid fa-bookmark me-2 text-warning"></i> My Bookings</a>
            @if (session('user_role') === 'admin')
                <a href="{{ url('dashboard') }}"><i class="fa-solid fa-chart-pie me-2 text-warning"></i> Admin Dashboard</a>
            @endif
            <a href="{{ url('logout') }}" style="color: #f87171;"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a>
        @else
            <a href="{{ url('login') }}"><i class="fa-solid fa-right-to-bracket me-2 text-warning"></i> Log In</a>
            <a href="{{ url('register') }}"><i class="fa-solid fa-user-plus me-2 text-warning"></i> Register Account</a>
        @endif
    </div>

    @if(session('success'))
        <div style="position: fixed; top: 90px; left: 50%; transform: translateX(-50%); z-index: 9999; background: #065f46; color: #ffffff; padding: 14px 28px; border-radius: 50px; font-weight: 600; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: 1px solid #34d399; display: flex; align-items: center; gap: 10px; animation: fadeIn 0.4s ease;">
            <i class="fa-solid fa-circle-check" style="color: #34d399; font-size: 18px;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="hero-content">
            <div class="hero-tag">
                <i class="fa-solid fa-star"></i> 5-Star Luxury Resort & Hotel
            </div>
            <h1 class="hero-title">Refined Elegance & Unmatched Comfort</h1>
            <p class="hero-description">Experience extraordinary hospitality at Shree Hotel with executive suite accommodations, fine dining, world-class wellness spa, and 24/7 personal butler service.</p>
            
            <div class="hero-actions">
                @if(session()->has('user_id'))
                    <a href="{{ url('booking') }}" class="btn-hero-primary">
                        <i class="fa-solid fa-calendar-plus"></i> Reserve Your Stay
                    </a>
                @else
                    <a href="{{ url('login') }}" class="btn-hero-primary">
                        <i class="fa-solid fa-calendar-plus"></i> Book Room
                    </a>
                    <a href="{{ url('register') }}" class="btn-hero-secondary">
                        Create Account
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="section-padding" id="about" style="background: #0b1120;">
        <div class="about-grid">
            <div class="about-image-stack">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80" alt="Luxury Hotel Suite" class="about-img-main">
                <div class="about-badge-card">
                    <div class="num">25+</div>
                    <div class="txt">Years of Excellence</div>
                </div>
            </div>

            <div class="about-text">
                <div class="section-subtitle">About Shree Hotel</div>
                <h3>A Sanctuary of Sophistication & Timeless Grandeur</h3>
                <p>Nestled in the heart of the city's prime destination, Shree Hotel offers a sanctuary where modern architectural elegance seamlessly blends with warm, personalized luxury service.</p>

                <ul class="about-list">
                    <li><i class="fa-solid fa-circle-check"></i> Prime Luxury Location</li>
                    <li><i class="fa-solid fa-circle-check"></i> 24/7 Butler Service</li>
                    <li><i class="fa-solid fa-circle-check"></i> Michelin Star Dining</li>
                    <li><i class="fa-solid fa-circle-check"></i> Private Infinity Pool</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Suites & Rooms Showcase -->
    <section class="section-padding" id="rooms" style="background: #0f172a;">
        <div class="section-header">
            <div class="section-subtitle">Luxury Accommodations</div>
            <h2 class="section-title">Rooms & Executive Suites</h2>
        </div>

        <div class="rooms-grid">
            <div class="room-card">
                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=600&q=80" class="room-card-img" alt="Single Deluxe">
                <div class="room-card-body">
                    <div class="room-card-title">Single Executive Room</div>
                    <div class="room-card-price">₹2,499 <span>/ night</span></div>
                    <div class="room-card-desc">Perfect for solo travelers with queen size bed, workspace, Smart TV, and city view.</div>
                    <a href="{{ session()->has('user_id') ? url('booking') : url('login') }}" class="btn-nav-gold" style="display: block; text-align: center;">Book Suite</a>
                </div>
            </div>

            <div class="room-card">
                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80" class="room-card-img" alt="Double Room">
                <div class="room-card-body">
                    <div class="room-card-title">Double Deluxe Suite</div>
                    <div class="room-card-price">₹4,999 <span>/ night</span></div>
                    <div class="room-card-desc">Spacious suite featuring king bed, private lounge area, mini-bar, and balcony.</div>
                    <a href="{{ session()->has('user_id') ? url('booking') : url('login') }}" class="btn-nav-gold" style="display: block; text-align: center;">Book Suite</a>
                </div>
            </div>

            <div class="room-card">
                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=600&q=80" class="room-card-img" alt="Presidential Suite">
                <div class="room-card-body">
                    <div class="room-card-title">Presidential Horizon Suite</div>
                    <div class="room-card-price">₹9,999 <span>/ night</span></div>
                    <div class="room-card-desc">The pinnacle of luxury with master bedroom, jacuzzi, butler service, and panoramic skyline views.</div>
                    <a href="{{ session()->has('user_id') ? url('booking') : url('login') }}" class="btn-nav-gold" style="display: block; text-align: center;">Book Suite</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Amenities Section -->
    <section class="section-padding" id="amenities" style="background: #0b1120;">
        <div class="section-header">
            <div class="section-subtitle">World-Class Hospitality</div>
            <h2 class="section-title">Curated Hotel Amenities</h2>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon-box">
                    <i class="fa-solid fa-bed"></i>
                </div>
                <h3>Executive Suites</h3>
                <p>Plush king beds, floor-to-ceiling panoramic views, climate control, and high-speed Wi-Fi.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <h3>Gourmet Fine Dining</h3>
                <p>Curated culinary experiences prepared by Michelin-recognized international chefs.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box">
                    <i class="fa-solid fa-spa"></i>
                </div>
                <h3>Wellness & Spa</h3>
                <p>Revitalize your body and mind with signature massage treatments and heated infinity pool views.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box">
                    <i class="fa-solid fa-bell-concierge"></i>
                </div>
                <h3>24/7 Concierge</h3>
                <p>Dedicated personal butler services, luxury airport transfers, and round-the-clock room service.</p>
            </div>
        </div>
    </section>

    <!-- Photo Gallery Section (Dynamic + Fallback Showcase) -->
    <section class="section-padding" id="gallery" style="background: #0f172a;">
        <div class="section-header">
            <div class="section-subtitle">Visual Experience</div>
            <h2 class="section-title">Hotel Photo Gallery</h2>
        </div>

        <div class="gallery-grid">
            @forelse($galleries as $photo)
                <div class="gallery-item">
                    <img src="{{ asset($photo->image) }}" alt="{{ $photo->title }}">
                    <div class="gallery-overlay">
                        <div>
                            <div class="gallery-title">{{ $photo->title }}</div>
                            <small style="color: #f59e0b; font-weight: 600; text-transform: uppercase; font-size: 11px;">{{ $photo->category }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Fallback Default Gallery Images -->
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=600&q=80" alt="Resort Exterior">
                    <div class="gallery-overlay">
                        <div>
                            <div class="gallery-title">Grand Exterior Architecture</div>
                            <small style="color: #f59e0b; font-weight: 600; text-transform: uppercase; font-size: 11px;">Exterior</small>
                        </div>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=600&q=80" alt="Infinity Pool">
                    <div class="gallery-overlay">
                        <div>
                            <div class="gallery-title">Rooftop Infinity Pool</div>
                            <small style="color: #f59e0b; font-weight: 600; text-transform: uppercase; font-size: 11px;">Pool & Spa</small>
                        </div>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=600&q=80" alt="Lobby Lounge">
                    <div class="gallery-overlay">
                        <div>
                            <div class="gallery-title">Grand Marble Lobby</div>
                            <small style="color: #f59e0b; font-weight: 600; text-transform: uppercase; font-size: 11px;">Lobby</small>
                        </div>
                    </div>
                </div>

                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=600&q=80" alt="Fine Dining Restaurant">
                    <div class="gallery-overlay">
                        <div>
                            <div class="gallery-title">Shree Fine Dining</div>
                            <small style="color: #f59e0b; font-weight: 600; text-transform: uppercase; font-size: 11px;">Dining</small>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section-padding" id="contact" style="background: #0b1120;">
        <div class="section-header">
            <div class="section-subtitle">Get In Touch</div>
            <h2 class="section-title">Contact Us & Reservations</h2>
        </div>

        <div class="contact-grid">
            <!-- Contact Info Box -->
            <div class="contact-info-box">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="info-text">
                        <h4>Hotel Address</h4>
                        <p>124 Shree Hotel, Hardoi Road Lucknow, Uttar Pradesh</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="info-text">
                        <h4>Phone & Reservations</h4>
                        <p>+91 7054999660</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="info-text">
                        <h4>Email Inquiries</h4>
                        <p>amitrathour241302@gmail.com</p>
                    </div>
                </div>

                <div class="info-item" style="margin-bottom: 0;">
                    <div class="info-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="info-text">
                        <h4>Front Desk Hours</h4>
                        <p>24 Hours / 7 Days a Week</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form Box -->
            <div class="contact-form-box">
                <form action="#" method="post" onsubmit="event.preventDefault(); alert('Thank you for contacting Shree Hotel. Our concierge will get back to you shortly!');">
                    <div class="form-row">
                        <div class="form-group-contact">
                            <label>Your Name</label>
                            <input type="text" class="form-input-contact" placeholder="John Doe" required>
                        </div>
                        <div class="form-group-contact">
                            <label>Email Address</label>
                            <input type="email" class="form-input-contact" placeholder="john@example.com" required>
                        </div>
                    </div>

                    <div class="form-group-contact">
                        <label>Subject</label>
                        <input type="text" class="form-input-contact" placeholder="Room reservation inquiry" required>
                    </div>

                    <div class="form-group-contact">
                        <label>Message</label>
                        <textarea class="form-input-contact" rows="4" placeholder="How can we assist you with your upcoming stay?" required></textarea>
                    </div>

                    <button type="submit" class="btn-submit-contact">
                        <i class="fa-solid fa-paper-plane me-2"></i> Send Inquiry Message
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Multi-Column Footer -->
    <footer class="footer">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="{{ url('/') }}" class="brand-logo">
                    <div class="brand-logo-icon">
                        <img src="{{ asset('assets/images/shree_logo.png') }}" alt="Shree Hotel Logo" class="brand-logo-img">
                    </div>
                    <div class="brand-logo-text"><span class="text-shree">Shree</span> <span class="text-hotel">Hotel</span></div>
                </a>
                <p>Providing world-class hospitality, luxury suites, fine dining, and unforgettable experiences to travelers worldwide.</p>
            </div>

            <!-- Links Column 1 -->
            <div>
                <div class="footer-col-title">Navigation</div>
                <ul class="footer-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#rooms">Suites & Rooms</a></li>
                    <li><a href="#amenities">Amenities</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                </ul>
            </div>

            <!-- Links Column 2 -->
            <div>
                <div class="footer-col-title">Services</div>
                <ul class="footer-links">
                    <li><a href="{{ url('booking') }}">Book a Room</a></li>
                    <li><a href="{{ url('mybooking') }}">My Bookings</a></li>
                    <li><a href="{{ url('login') }}">Staff Login</a></li>
                    <li><a href="{{ url('register') }}">Register</a></li>
                    <li><a href="#contact">Contact Support</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div>
                <div class="footer-col-title">Contact Concierge</div>
                <p style="color: #94a3b8; font-size: 14px; line-height: 1.6; margin-bottom: 12px;">
                    <i class="fa-solid fa-location-dot me-2 text-warning"></i> 124 Shree Hotel Blvd, Lucknow
                </p>
                <p style="color: #94a3b8; font-size: 14px; line-height: 1.6; margin-bottom: 12px;">
                    <i class="fa-solid fa-phone me-2 text-warning"></i> +91 7054999660
                </p>
                <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">
                    <i class="fa-solid fa-envelope me-2 text-warning"></i> amitrathour241302@gmail.com
                </p>
            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="footer-bottom">
            <div>
                © {{ date('Y') }} <strong>Shree Hotel & Luxury Suites</strong>. All rights reserved.
            </div>
            <div class="social-icons">
                <a href="#" class="social-btn"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="social-btn"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="social-btn"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileNav() {
            const drawer = document.getElementById('mobileNavDrawer');
            const toggleBtn = document.getElementById('mobileNavToggle');
            if (drawer) {
                drawer.classList.toggle('active');
                if (toggleBtn) {
                    const icon = toggleBtn.querySelector('i');
                    if (drawer.classList.contains('active')) {
                        icon.className = 'fa-solid fa-xmark';
                    } else {
                        icon.className = 'fa-solid fa-bars';
                    }
                }
            }
        }
    </script>
</body>
</html>
