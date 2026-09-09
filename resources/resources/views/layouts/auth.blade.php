<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentication') - Shree Hotel</title>
    
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
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f766e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative Background Elements */
        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(217, 119, 6, 0.15) 0%, rgba(0,0,0,0) 70%);
            top: -100px;
            right: -100px;
        }

        body::after {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.15) 0%, rgba(0,0,0,0) 70%);
            bottom: -150px;
            left: -150px;
        }

        .auth-container {
            width: 100%;
            max-width: 960px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            display: flex;
            overflow: hidden;
            position: relative;
            z-index: 10;
            min-height: 560px;
        }

        .auth-banner {
            flex: 1;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(15, 118, 110, 0.85) 100%), 
                        url('https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80') center/cover;
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #ffffff;
            position: relative;
        }

        .banner-logo {
            display: flex;
            align-items: center;
            gap: 14px;
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

        .banner-logo-icon {
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
            transform: scale(1.1);
        }

        .banner-logo-text {
            font-family: 'Outfit', sans-serif;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.5px;
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

        .banner-content h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 12px;
        }

        .banner-content p {
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.6;
        }

        .banner-features {
            display: flex;
            gap: 24px;
            margin-top: 30px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #e2e8f0;
        }

        .feature-item i {
            color: #f59e0b;
        }

        .auth-form-side {
            flex: 1;
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .auth-header {
            margin-bottom: 32px;
        }

        .auth-header h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .auth-header p {
            color: #64748b;
            font-size: 14px;
        }

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

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px 12px 46px;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            outline: none;
            background-color: #f8fafc;
            transition: all 0.25s ease;
        }

        .form-input:focus {
            background-color: #ffffff;
            border-color: #0f766e;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
        }

        .btn-auth {
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
            margin-top: 10px;
        }

        .btn-auth:hover {
            background: linear-gradient(135deg, #0d9488 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(15, 118, 110, 0.4);
        }

        .auth-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 14px;
            color: #64748b;
        }

        .auth-footer a {
            color: #0f766e;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .alert-auth {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .alert-auth-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-auth-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @media (max-width: 768px) {
            .auth-banner { display: none; }
            .auth-container { max-width: 440px; margin: 20px auto; }
            .auth-form-side { padding: 32px 24px; }
        }

        @media (max-width: 480px) {
            .auth-form-side { padding: 24px 18px; }
            .form-header h1 { font-size: 22px; }
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <!-- Banner Side -->
        <div class="auth-banner">
            <div class="banner-logo">
                <div class="banner-logo-icon">
                    <img src="{{ asset('assets/images/shree_logo.png') }}" alt="Shree Hotel Logo" class="brand-logo-img">
                </div>
                <div class="banner-logo-text"><span class="text-shree">Shree</span> <span class="text-hotel">Hotel</span></div>
            </div>

            <div class="banner-content">
                <h2>Experience Unmatched Luxury & Comfort</h2>
                <p>Welcome to Shree Hotel Management Portal. Streamline your room bookings, guests, and payment operations effortlessly.</p>
                <div class="banner-features">
                    <div class="feature-item">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Secure Portal</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa-solid fa-bolt"></i>
                        <span>Instant Booking</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa-solid fa-clock"></i>
                        <span>24/7 Concierge</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="auth-form-side">
            @yield('content')
        </div>
    </div>

</body>
</html>
