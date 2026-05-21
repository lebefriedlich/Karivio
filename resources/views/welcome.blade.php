<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('Buat CV profesional, buat surat lamaran kerja terpersonalisasi, serta pantau dan kirim lamaran kerja Anda secara langsung dari akun Gmail Anda—semua dalam satu platform elegan.') }}">
    <meta name="keywords" content="Karivio, CV Builder, Lamaran Kerja, Job Application, Cover Letter Generator, Gmail Integration, Auto Apply">
    <meta name="author" content="Karivio">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url('/') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Karivio - {{ __('Hub Lamaran Kerja Terbaik') }}">
    <meta property="og:description" content="{{ __('Buat CV profesional, buat surat lamaran kerja terpersonalisasi, serta pantau dan kirim lamaran kerja Anda secara langsung dari akun Gmail Anda—semua dalam satu platform elegan.') }}">
    <meta property="og:image" content="{{ asset('logo.svg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Karivio - {{ __('Hub Lamaran Kerja Terbaik') }}">
    <meta property="twitter:description" content="{{ __('Buat CV profesional, buat surat lamaran kerja terpersonalisasi, serta pantau dan kirim lamaran kerja Anda secara langsung dari akun Gmail Anda—semua dalam satu platform elegan.') }}">
    <meta property="twitter:image" content="{{ asset('logo.svg') }}">

    <title>Karivio - {{ __('Hub Lamaran Kerja Terbaik') }}</title>

    <link rel="shortcut icon" href="{{ asset('logo.svg') }}">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --krv-primary: #3b82f6;
            --krv-primary-dark: #1d4ed8;
            --krv-secondary: #06b6d4;
            --krv-success: #10b981;
            --krv-bg-dark: #090d16;
            --krv-card-dark: rgba(18, 24, 38, 0.6);
            --krv-border-dark: rgba(255, 255, 255, 0.08);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            background-color: var(--krv-bg-dark);
            color: #f3f4f6;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            position: relative;
        }

        #features, #transparency {
            scroll-margin-top: 7rem !important; /* Perfect visual spacing below sticky header */
        }

        /* Prevent absolute background decorative items from extending document height */
        .krv-bg-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            pointer-events: none;
        }

        /* Container Custom */
        .krv-container {
            width: 100%;
            max-width: 80rem; /* 1280px */
            margin-left: auto;
            margin-right: auto;
            padding-left: 2rem !important;
            padding-right: 2rem !important;
            box-sizing: border-box;
        }

        @media (min-width: 768px) {
            .krv-container {
                padding-left: 4rem !important;
                padding-right: 4rem !important;
            }
        }

        /* Animated Grid Background */
        .grid-bg {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            background-position: center;
            mask-image: radial-gradient(circle at center, black 40%, transparent 80%);
            z-index: 1;
            pointer-events: none;
        }

        /* Glowing Orbs */
        .glow-orb-1 {
            position: absolute;
            top: -10%;
            left: 20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
            z-index: 2;
            pointer-events: none;
            filter: blur(40px);
        }

        .glow-orb-2 {
            position: absolute;
            top: 40%;
            right: 10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.12) 0%, transparent 70%);
            z-index: 2;
            pointer-events: none;
            filter: blur(50px);
        }

        .glow-orb-3 {
            position: absolute;
            bottom: -5%;
            left: 15%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
            z-index: 2;
            pointer-events: none;
            filter: blur(45px);
        }

        /* Header Navigation - Specific krv classes to prevent tailwind collisions */
        header.krv-header {
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 50;
            background: rgba(9, 13, 22, 0.85) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border-bottom: 1px solid var(--krv-border-dark) !important;
            box-sizing: border-box;
        }

        .krv-nav-wrapper {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        .krv-nav-menu {
            display: none !important;
        }

        @media (min-width: 1024px) {
            .krv-nav-menu {
                display: flex !important;
                align-items: center !important;
                gap: 3rem !important; /* 48px gap to breathe room between links */
            }
        }

        .krv-nav-menu a {
            color: #9ca3af !important;
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
        }

        .krv-nav-menu a:hover {
            color: #ffffff !important;
        }

        .krv-nav-actions {
            display: none !important;
        }

        @media (min-width: 1024px) {
            .krv-nav-actions {
                display: flex !important;
                align-items: center !important;
                gap: 1.25rem !important;
            }
        }

        /* Gradient Text */
        .text-gradient {
            background: linear-gradient(135deg, #ffffff 30%, #a5f3fc 70%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Glowing Button Effect */
        .btn-glow {
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-glow:hover {
            box-shadow: 0 4px 30px rgba(59, 130, 246, 0.5);
            transform: translateY(-2px);
            color: #ffffff !important;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #d1d5db !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            transform: translateY(-1px) !important;
        }

        /* Main Content Spacing */
        .krv-main {
            display: flex !important;
            flex-direction: column !important;
            gap: 7rem !important; /* Extremely generous gap between sections */
            padding-top: 2rem !important;
            padding-bottom: 4rem !important;
            position: relative;
            z-index: 10;
            box-sizing: border-box;
        }

        @media (min-width: 1024px) {
            .krv-main {
                gap: 9rem !important; /* Breathing room at widescreen */
                padding-top: 2rem !important;
                padding-bottom: 4rem !important;
            }
        }

        /* Hero Layout */
        .krv-hero-grid {
            display: grid !important;
            grid-template-columns: 1fr !important;
            gap: 4rem !important;
            align-items: center !important;
        }

        @media (min-width: 1024px) {
            .krv-hero-grid {
                grid-template-columns: 1.15fr 0.85fr !important;
                gap: 6rem !important; /* Huge gap between hero left and right mockup */
            }
        }

        .krv-hero-info {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 1.75rem !important;
            text-align: left !important;
        }

        .krv-hero-pill {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            padding: 0.625rem 1.25rem !important;
            border-radius: 9999px !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            background: rgba(59, 130, 246, 0.1) !important;
            color: #60a5fa !important;
            border: 1px solid rgba(59, 130, 246, 0.2) !important;
            letter-spacing: 0.05em;
        }

        .krv-hero-title {
            font-size: 2.25rem !important;
            font-weight: 800 !important;
            line-height: 1.25 !important;
            color: #ffffff !important;
            margin: 0 !important;
            letter-spacing: -0.03em !important;
        }

        @media (min-width: 640px) {
            .krv-hero-title {
                font-size: 3rem !important;
            }
        }

        @media (min-width: 1024px) {
            .krv-hero-title {
                font-size: 4rem !important;
            }
        }

        .krv-hero-desc {
            font-size: 1.05rem !important;
            line-height: 1.75 !important;
            color: #9ca3af !important;
            margin: 0 !important;
            max-width: 34rem !important;
        }

        .krv-hero-ctas {
            display: flex !important;
            flex-direction: column !important;
            gap: 1.25rem !important;
            width: 100% !important;
            margin-top: 0.5rem !important;
        }

        @media (min-width: 520px) {
            .krv-hero-ctas {
                flex-direction: row !important;
                align-items: center !important;
                width: auto !important;
            }
        }

        /* Core Features Cards Grid */
        .krv-features {
            display: flex !important;
            flex-direction: column !important;
            gap: 4.5rem !important;
        }

        .krv-section-header {
            text-align: center !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            gap: 1rem !important;
        }

        .krv-section-header h2 {
            font-size: 2.25rem !important;
            font-weight: 800 !important;
            color: #ffffff !important;
            margin: 0 !important;
            letter-spacing: -0.025em !important;
        }

        @media (min-width: 768px) {
            .krv-section-header h2 {
                font-size: 2.75rem !important;
            }
        }

        .krv-section-header p {
            font-size: 1.05rem !important;
            color: #9ca3af !important;
            max-width: 38rem !important;
            margin: 0 !important;
            line-height: 1.75 !important;
        }

        .krv-features-grid {
            display: grid !important;
            grid-template-columns: 1fr !important;
            gap: 2.5rem !important; /* Generous gap between feature cards */
        }

        @media (min-width: 640px) {
            .krv-features-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        @media (min-width: 1024px) {
            .krv-features-grid {
                grid-template-columns: repeat(4, 1fr) !important;
                gap: 2rem !important;
            }
        }

        .krv-card {
            background: var(--krv-card-dark) !important;
            backdrop-filter: blur(16px) !important;
            -webkit-backdrop-filter: blur(16px) !important;
            border: 1px solid var(--krv-border-dark) !important;
            border-radius: 2.25rem !important;
            padding: 3rem 2.25rem !important; /* 48px vertical, 36px horizontal padding */
            display: flex !important;
            flex-direction: column !important;
            gap: 1.5rem !important;
            text-align: left !important;
            box-sizing: border-box !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .krv-card:hover {
            transform: translateY(-8px) !important;
            border-color: rgba(59, 130, 246, 0.35) !important;
            box-shadow: 0 16px 45px -10px rgba(59, 130, 246, 0.2) !important;
            background: rgba(18, 24, 38, 0.75) !important;
        }

        .krv-card-icon {
            width: 3.5rem !important;
            height: 3.5rem !important;
            border-radius: 1.125rem !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 1.75rem !important;
        }

        .krv-card h3 {
            font-size: 1.35rem !important;
            font-weight: 700 !important;
            color: #ffffff !important;
            margin: 0 !important;
            letter-spacing: -0.01em;
        }

        .krv-card p {
            font-size: 0.9rem !important;
            color: #9ca3af !important;
            line-height: 1.75 !important;
            margin: 0 !important;
        }

        /* Transparency Panel Section - Solves extreme border-touch issues */
        .krv-transparency-panel {
            background: rgba(18, 24, 38, 0.6) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border: 1px solid var(--krv-border-dark) !important;
            border-radius: 3rem !important;
            padding: 3rem 2.25rem !important; /* Enormous internal padding spacing */
            display: flex !important;
            flex-direction: column !important;
            gap: 4rem !important;
            box-sizing: border-box !important;
            position: relative;
        }

        @media (min-width: 768px) {
            .krv-transparency-panel {
                padding: 5rem 4.5rem !important; /* Luxurious breathing room */
                gap: 5rem !important;
            }
        }

        .krv-transparency-header {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 1rem !important;
            text-align: left !important;
        }

        .krv-transparency-header h2 {
            font-size: 2rem !important;
            font-weight: 800 !important;
            color: #ffffff !important;
            margin: 0 !important;
            letter-spacing: -0.025em !important;
        }

        @media (min-width: 768px) {
            .krv-transparency-header h2 {
                font-size: 2.75rem !important;
            }
        }

        .krv-transparency-header p {
            font-size: 1.05rem !important;
            color: #9ca3af !important;
            max-width: 46rem !important;
            margin: 0 !important;
            line-height: 1.75 !important;
        }

        .krv-transparency-grid {
            display: grid !important;
            grid-template-columns: 1fr !important;
            gap: 3.5rem !important; /* Huge gap between policy items */
        }

        @media (min-width: 768px) {
            .krv-transparency-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 4rem 3.5rem !important;
            }
        }

        .krv-transparency-item {
            display: flex !important;
            gap: 1.5rem !important;
            align-items: flex-start !important;
            text-align: left !important;
        }

        .krv-transparency-icon {
            width: 3rem !important;
            height: 3rem !important;
            border-radius: 1rem !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 1.5rem !important;
            flex-shrink: 0 !important;
        }

        .krv-transparency-info {
            display: flex !important;
            flex-direction: column !important;
            gap: 0.75rem !important;
        }

        .krv-transparency-info h4 {
            font-size: 1.2rem !important;
            font-weight: 700 !important;
            color: #ffffff !important;
            margin: 0 !important;
            letter-spacing: -0.01em;
        }

        .krv-transparency-info p {
            font-size: 0.9rem !important;
            color: #9ca3af !important;
            line-height: 1.7 !important;
            margin: 0 !important;
        }

        .krv-transparency-info code {
            background: rgba(255, 255, 255, 0.08) !important;
            padding: 0.2rem 0.5rem !important;
            border-radius: 0.375rem !important;
            font-family: monospace !important;
            color: #60a5fa !important;
            font-size: 0.875em !important;
        }

        /* Final CTA Callout */
        .krv-cta-callout {
            text-align: center !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            gap: 2rem !important;
            padding: 4rem 0 !important;
        }

        @media (min-width: 768px) {
            .krv-cta-callout {
                padding: 6rem 0 !important;
            }
        }

        .krv-cta-callout h2 {
            font-size: 2.25rem !important;
            font-weight: 800 !important;
            color: #ffffff !important;
            margin: 0 !important;
            letter-spacing: -0.025em !important;
            line-height: 1.2;
        }

        @media (min-width: 768px) {
            .krv-cta-callout h2 {
                font-size: 3.5rem !important;
            }
        }

        .krv-cta-callout p {
            font-size: 1.15rem !important;
            color: #9ca3af !important;
            max-width: 38rem !important;
            margin: 0 !important;
            line-height: 1.75 !important;
        }

        /* Footer */
        footer.krv-footer {
            border-top: 1px solid var(--krv-border-dark) !important;
            background: #060910 !important;
        }

        .krv-footer-wrapper {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 1.5rem !important;
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }

        @media (min-width: 768px) {
            .krv-footer-wrapper {
                flex-direction: row !important;
                gap: 0 !important;
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
        }

        .krv-footer-links {
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
            gap: 1.5rem !important;
        }

        @media (min-width: 768px) {
            .krv-footer-links {
                gap: 2rem !important;
            }
        }

        .krv-footer-links a {
            color: #9ca3af !important;
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
        }

        .krv-footer-links a:hover {
            color: #ffffff !important;
        }

        /* Custom Bilingual Switcher */
        .krv-locale-toggle {
            display: flex !important;
            align-items: center !important;
            gap: 0.25rem !important;
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 0.25rem !important;
            border-radius: 9999px !important;
            box-sizing: border-box !important;
        }
        .krv-locale-btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0.375rem 0.875rem !important;
            border-radius: 9999px !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
            color: #9ca3af !important;
        }
        .krv-locale-btn.active {
            background: #3b82f6 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.4) !important;
        }
        .krv-locale-btn:not(.active):hover {
            background: rgba(255, 255, 255, 0.08) !important;
            color: #ffffff !important;
        }

        /* Custom Spacious Responsive CTAs */
        .krv-hero-btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 1rem 2rem !important;
            border-radius: 1.25rem !important;
            font-size: 1rem !important;
            font-weight: 800 !important;
            text-decoration: none !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-sizing: border-box !important;
            text-align: center !important;
            width: 100% !important;
        }
        @media (min-width: 520px) {
            .krv-hero-btn {
                width: auto !important;
            }
        }

        .krv-btn-cta {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 1.125rem 2.5rem !important;
            border-radius: 1.25rem !important;
            font-size: 1.125rem !important;
            font-weight: 800 !important;
            text-decoration: none !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-sizing: border-box !important;
            text-align: center !important;
            width: 100% !important;
            max-width: 20rem !important;
        }
        @media (min-width: 480px) {
            .krv-btn-cta {
                width: auto !important;
                max-width: none !important;
            }
        }

        /* Interactive mockup elements */
        .mockup-header-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #090d16;
        }
        ::-webkit-scrollbar-thumb {
            background: #1f293d;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #374151;
        }
    </style>
</head>

<body class="relative min-h-screen flex flex-col justify-between overflow-x-hidden">
    <!-- Grid & Glow Context -->
    <div class="krv-bg-wrapper">
        <div class="grid-bg"></div>
        <div class="glow-orb-1"></div>
        <div class="glow-orb-2"></div>
        <div class="glow-orb-3"></div>
    </div>

    <!-- Navigation Header -->
    <header class="krv-header">
        <div class="krv-container">
            <div class="krv-nav-wrapper">
                <a href="/" class="flex items-center gap-3 no-underline">
                    <img src="{{ asset('logo.svg') }}" alt="Karivio Logo" class="h-9 w-9 logo-hover transition-all">
                    <span class="text-xl md:text-2xl font-extrabold tracking-tight text-white font-sans">Karivio</span>
                </a>

                <!-- Navigation Links - collision proof -->
                <nav class="krv-nav-menu">
                    <a href="#philosophy">{{ __('Filosofi Karivio') }}</a>
                    <a href="#features">{{ __('Core Features') }}</a>
                    <a href="#transparency">{{ __('Google OAuth & Permissions') }}</a>
                    <a href="{{ route('privacy') }}">{{ __('Privacy Policy') }}</a>
                </nav>

                <!-- Actions -->
                <div class="krv-nav-actions">
                    <!-- Language Selector - krv stylized slider -->
                    <div class="krv-locale-toggle">
                        <a href="{{ route('locale.switch', 'id') }}" class="krv-locale-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}">
                            ID
                        </a>
                        <a href="{{ route('locale.switch', 'en') }}" class="krv-locale-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                            EN
                        </a>
                    </div>

                    <!-- Dynamic Button -->
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-glow bg-blue-600 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2">
                            <i class="ri-dashboard-line"></i>
                            <span>{{ __('Ke Dashboard') }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-glow bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold px-5 py-2.5 rounded-xl text-sm flex items-center gap-2">
                            <i class="ri-google-fill"></i>
                            <span>{{ __('Masuk') }}</span>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden text-gray-300 hover:text-white text-3xl p-1 transition-transform active:scale-90 flex items-center justify-center">
                    <i class="ri-menu-3-line" id="mobile-menu-icon"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 z-40 hidden opacity-0 transition-opacity duration-300 lg:hidden pointer-events-auto" style="background-color: rgba(0,0,0,0.7); backdrop-filter: blur(4px);"></div>

    <!-- Mobile Menu Drawer -->
    <div id="mobile-drawer" class="fixed top-0 right-0 h-full z-40 hidden flex-col pt-24 px-6 pb-6 lg:hidden transform translate-x-full transition-transform duration-300 ease-in-out shadow-2xl" style="background-color: #090d16; width: 85%; border-left: 1px solid rgba(255,255,255,0.05);">
        <div class="flex-1 flex flex-col justify-between h-full relative z-10 w-full overflow-y-auto hide-scrollbar">
            <!-- Navigation Links -->
            <nav class="flex flex-col gap-3 mt-2">
                <a href="#philosophy" class="flex items-center gap-4 p-4 rounded-2xl transition-all font-semibold text-gray-200 hover:text-white" style="background-color: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xl shrink-0 text-indigo-400" style="background-color: rgba(99,102,241,0.15);">
                        <i class="ri-lightbulb-flash-line"></i>
                    </div>
                    <span>{{ __('Filosofi Karivio') }}</span>
                </a>
                
                <a href="#features" class="flex items-center gap-4 p-4 rounded-2xl transition-all font-semibold text-gray-200 hover:text-white" style="background-color: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xl shrink-0 text-cyan-400" style="background-color: rgba(6,182,212,0.15);">
                        <i class="ri-file-list-3-line"></i>
                    </div>
                    <span>{{ __('Core Features') }}</span>
                </a>
                
                <a href="#transparency" class="flex items-center gap-4 p-4 rounded-2xl transition-all font-semibold text-gray-200 hover:text-white" style="background-color: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xl shrink-0 text-emerald-400" style="background-color: rgba(16,185,129,0.15);">
                        <i class="ri-shield-user-line"></i>
                    </div>
                    <span>{{ __('Google OAuth') }}</span>
                </a>
                
                <a href="{{ route('privacy') }}" class="flex items-center gap-4 p-4 rounded-2xl transition-all font-semibold text-gray-200 hover:text-white" style="background-color: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-xl shrink-0 text-purple-400" style="background-color: rgba(168,85,247,0.15);">
                        <i class="ri-lock-line"></i>
                    </div>
                    <span>{{ __('Privacy Policy') }}</span>
                </a>
            </nav>

            <!-- Bottom Actions -->
            <div class="flex flex-col gap-4 mt-8 pb-4">
                <div class="flex items-center justify-between p-4 rounded-2xl bg-white/5 border border-white/10">
                    <span class="text-sm font-semibold text-gray-400">{{ __('Bahasa') }}</span>
                    <div class="krv-locale-toggle scale-90 origin-right m-0">
                        <a href="{{ route('locale.switch', 'id') }}" class="krv-locale-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}">ID</a>
                        <a href="{{ route('locale.switch', 'en') }}" class="krv-locale-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
                    </div>
                </div>

                @auth
                    <a href="{{ route('dashboard') }}" class="btn-glow bg-blue-600 text-white font-bold px-5 py-4 rounded-2xl text-center flex justify-center items-center gap-2">
                        <i class="ri-dashboard-line text-lg"></i>
                        <span>{{ __('Ke Dashboard') }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-glow bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-bold px-5 py-4 rounded-2xl text-center flex justify-center items-center gap-2">
                        <i class="ri-google-fill text-lg"></i>
                        <span>{{ __('Masuk dengan Google') }}</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Content Wrapper -->
    <div class="krv-container">
        <main class="krv-main">
            
            <!-- Hero Block -->
            <section class="krv-hero-section">
                <div class="krv-hero-grid">
                    <div class="krv-hero-info">
                        <!-- Pill -->
                        <span class="krv-hero-pill">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                            {{ __('Hub Lamaran Kerja Terbaik') }}
                        </span>

                        <h1 class="krv-hero-title">
                            {{ __('Welcome to Karivio') }}
                            <span class="block text-gradient mt-1">{{ __('The Ultimate Job Application Workspace') }}</span>
                        </h1>

                        <p class="krv-hero-desc">
                            {{ __('Buat CV profesional, buat surat lamaran kerja terpersonalisasi, serta pantau dan kirim lamaran kerja Anda secara langsung dari akun Gmail Anda—semua dalam satu platform elegan.') }}
                        </p>

                        <div class="krv-hero-ctas">
                            @auth
                                <a href="{{ route('dashboard') }}" class="btn-glow krv-hero-btn bg-blue-600 text-white">
                                    <span>{{ __('Ke Dashboard') }}</span>
                                    <i class="ri-arrow-right-line" style="margin-left: 0.5rem;"></i>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-glow krv-hero-btn bg-gradient-to-r from-blue-600 to-cyan-500 text-white">
                                    <i class="ri-google-fill" style="margin-right: 0.5rem;"></i>
                                    <span>{{ __('Masuk dengan Google') }}</span>
                                    <i class="ri-arrow-right-line" style="margin-left: 0.5rem;"></i>
                                </a>
                            @endauth
                            
                            <a href="#features" class="btn-outline krv-hero-btn">
                                {{ __('Mengapa Memilih Karivio?') }}
                            </a>
                        </div>
                    </div>

                    <!-- Sleek CSS Mockup Display -->
                    <div class="relative w-full flex justify-center">
                        <div class="glass-panel w-full max-w-[420px] rounded-3xl overflow-hidden shadow-2xl border border-white/10" style="background: rgba(18, 24, 38, 0.7); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">
                            <!-- Browser Header -->
                            <div class="bg-[#0f1422] px-4 py-3 border-b border-white/5 flex items-center gap-2 justify-between">
                                <div class="flex items-center gap-1.5">
                                    <span class="mockup-header-dot bg-[#ef4444]"></span>
                                    <span class="mockup-header-dot bg-[#f59e0b]"></span>
                                    <span class="mockup-header-dot bg-[#10b981]"></span>
                                </div>
                                <span class="text-[10px] text-gray-500 tracking-wider font-mono">karivio.mhna.my.id/dashboard</span>
                                <div class="w-10"></div>
                            </div>

                            <!-- Mockup Body Content -->
                            <div class="p-6 bg-gradient-to-b from-[#121826] to-[#0c0f17] flex flex-col gap-5 text-xs text-left">
                                <!-- CV Entry -->
                                <div class="p-3.5 rounded-2xl bg-white/5 border border-white/5 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                                            <i class="ri-file-user-line text-blue-400 text-base"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white text-xs">Curriculum Vitae (CV)</h4>
                                            <p class="text-[10px] text-gray-500">{{ __('Terakhir diubah') }} - {{ date('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-0.5 rounded-full bg-blue-400/15 text-blue-400 text-[9px] font-bold uppercase">PDF</span>
                                </div>

                                <!-- Cover Letter Entry -->
                                <div class="p-3.5 rounded-2xl bg-white/5 border border-white/5 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center">
                                            <i class="ri-mail-line text-cyan-400 text-base"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white text-xs">Cover Letter</h4>
                                            <p class="text-[10px] text-gray-500">{{ __('Terakhir diubah') }} - {{ date('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-0.5 rounded-full bg-cyan-400/15 text-cyan-400 text-[9px] font-bold uppercase">Active</span>
                                </div>

                                <!-- Integrated Email Box -->
                                <div class="p-4 rounded-2xl bg-[#090d16]/80 border border-blue-500/20 flex flex-col gap-3 relative overflow-hidden">
                                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-full blur-xl pointer-events-none"></div>
                                    
                                    <div class="flex items-center justify-between border-b border-white/5 pb-2">
                                        <span class="font-bold text-white flex items-center gap-1.5 text-[10px]">
                                            <i class="ri-mail-send-fill text-blue-400"></i>
                                            {{ __('Riwayat Pengiriman Email') }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded-full bg-[#10b981]/15 text-[#10b981] text-[8px] font-extrabold flex items-center gap-1">
                                            <span class="w-1 h-1 rounded-full bg-[#10b981]"></span>
                                            {{ __('Terkirim') }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col gap-1.5 text-[10px] text-gray-400">
                                        <p><strong>{{ __('To:') }}</strong> hr@awesomecompany.com</p>
                                        <p><strong>{{ __('Subject:') }}</strong> Application for Backend Developer - John Doe</p>
                                        <p><strong>{{ __('Attachment:') }}</strong> <span class="text-blue-400 underline">CV_JohnDoe.pdf</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Philosophy Section -->
            <section id="philosophy" style="scroll-margin-top: 120px;">
                <div class="krv-transparency-panel">
                    <div class="absolute top-0 right-0 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyan-500/5 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="krv-section-header w-full">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-cyan-400">{{ __('Filosofi Karivio') }}</span>
                        <h2>{{ __('A Vision for Your Career') }}</h2>
                        <div class="flex items-center justify-center gap-4 my-2">
                            <div class="px-6 py-3 rounded-2xl bg-blue-500/10 border border-blue-500/20">
                                <span class="text-xl font-bold text-blue-400">Career</span>
                            </div>
                            <span class="text-2xl font-bold text-gray-500">+</span>
                            <div class="px-6 py-3 rounded-2xl bg-cyan-500/10 border border-cyan-500/20">
                                <span class="text-xl font-bold text-cyan-400">Vision</span>
                            </div>
                        </div>
                        <p>{{ __('Karivio berasal dari gabungan dua kata: Career (Karier) dan Vision (Visi). Kami hadir sebagai platform yang membantu Anda merancang, membangun, dan mengambil langkah terbaik untuk masa depan karier Anda.') }}</p>
                    </div>

                    <div class="krv-features-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)) !important;">
                        <!-- Meaning 1 -->
                        <div class="krv-card">
                            <div class="krv-card-icon bg-blue-500/10 border border-blue-500/20 text-blue-400">
                                <i class="ri-user-star-line"></i>
                            </div>
                            <h3>{{ __('Membangun Identitas') }}</h3>
                            <p>{{ __('Membangun identitas profesional yang kuat melalui CV dan surat lamaran yang berstandar tinggi.') }}</p>
                        </div>
                        <!-- Meaning 2 -->
                        <div class="krv-card">
                            <div class="krv-card-icon bg-cyan-500/10 border border-cyan-500/20 text-cyan-400">
                                <i class="ri-compass-3-line"></i>
                            </div>
                            <h3>{{ __('Menentukan Arah') }}</h3>
                            <p>{{ __('Menentukan arah karier sesuai visi dan tujuan masa depan Anda dengan lebih terarah.') }}</p>
                        </div>
                        <!-- Meaning 3 -->
                        <div class="krv-card">
                            <div class="krv-card-icon bg-blue-500/10 border border-blue-500/20 text-blue-400">
                                <i class="ri-rocket-2-line"></i>
                            </div>
                            <h3>{{ __('Mengambil Peluang') }}</h3>
                            <p>{{ __('Mengirim lamaran ke berbagai peluang secara cepat, efisien, dan tepat sasaran.') }}</p>
                        </div>
                        <!-- Meaning 4 -->
                        <div class="krv-card">
                            <div class="krv-card-icon bg-cyan-500/10 border border-cyan-500/20 text-cyan-400">
                                <i class="ri-door-open-line"></i>
                            </div>
                            <h3>{{ __('Membuka Jalan') }}</h3>
                            <p>{{ __('Membuka jalan menuju kesuksesan, profesionalitas, dan persiapan masa depan yang matang.') }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Core Features List -->
            <section id="features" class="krv-features" style="scroll-margin-top: 120px;">
                <div class="krv-section-header">
                    <h2>{{ __('Core Features') }}</h2>
                    <p>{{ __('Dirancang khusus untuk mempermudah perjalanan karier Anda dari hulu ke hilir.') }}</p>
                </div>

                <div class="krv-features-grid">
                    <!-- Card 1 -->
                    <div class="krv-card">
                        <div class="krv-card-icon bg-blue-500/10 border border-blue-500/20 text-blue-400">
                            <i class="ri-file-list-3-line"></i>
                        </div>
                        <h3>{{ __('Pembuat CV Profesional') }}</h3>
                        <p>{{ __('Hasilkan resume memukau yang disesuaikan dengan industri Anda. Tambahkan pengalaman, pendidikan, keahlian, dan bahasa, lalu ekspor ke PDF berkualitas tinggi.') }}</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="krv-card">
                        <div class="krv-card-icon bg-cyan-500/10 border border-cyan-500/20 text-cyan-400">
                            <i class="ri-mail-line"></i>
                        </div>
                        <h3>{{ __('Surat Lamaran Kerja Dinamis') }}</h3>
                        <p>{{ __('Buat surat lamaran kerja kustom dengan placeholder dinamis untuk mengisi nama perusahaan, posisi, dan tanggal secara otomatis.') }}</p>
                    </div>

                    <!-- Card 3 (Gmail Icon fix: use 100% verified ri-mail-send-line) -->
                    <div class="krv-card">
                        <div class="krv-card-icon bg-[#ea4335]/10 border border-[#ea4335]/20 text-[#ea4335]">
                            <i class="ri-mail-send-line"></i>
                        </div>
                        <h3>{{ __('Pengiriman Gmail Langsung') }}</h3>
                        <p>{{ __('Kirim lamaran Anda secara aman melalui akun Gmail pribadi Anda menggunakan integrasi Google OAuth resmi.') }}</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="krv-card">
                        <div class="krv-card-icon bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                            <i class="ri-timer-2-line"></i>
                        </div>
                        <h3>{{ __('Sistem Antrean & Jadwal') }}</h3>
                        <p>{{ __('Sistem antrean pintar memastikan pengiriman email berjalan lancar dan cepat. Jadwalkan pengiriman pada jam kerja terbaik.') }}</p>
                    </div>
                </div>
            </section>

            <!-- Google OAuth Data Transparency -->
            <section id="transparency" style="scroll-margin-top: 120px;">
                <div class="krv-transparency-panel">
                    <div class="absolute top-0 right-0 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyan-500/5 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="krv-transparency-header">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-cyan-400">{{ __('Izin & OAuth Google') }}</span>
                        <h2>{{ __('Bagaimana Karivio Mengelola Data Anda') }}</h2>
                        <p>{{ __('Kami berkomitmen penuh terhadap transparansi dan keamanan data pribadi serta data pengguna Google Anda.') }}</p>
                    </div>

                    <div class="krv-transparency-grid">
                        <!-- Transparency Item 1 -->
                        <div class="krv-transparency-item">
                            <div class="krv-transparency-icon bg-blue-500/10 border border-blue-500/20 text-blue-400">
                                <i class="ri-shield-user-line"></i>
                            </div>
                            <div class="krv-transparency-info">
                                <h4>{{ __('Izin & OAuth Google') }}</h4>
                                <p>{!! __('Kami hanya meminta izin <code>gmail.send</code> untuk mengirim lamaran yang Anda picu. Kami TIDAK PERNAH membaca kotak masuk atau mengakses email Anda yang lain.') !!}</p>
                            </div>
                        </div>

                        <!-- Transparency Item 2 -->
                        <div class="krv-transparency-item">
                            <div class="krv-transparency-icon bg-cyan-500/10 border border-cyan-500/20 text-cyan-400">
                                <i class="ri-key-2-line"></i>
                            </div>
                            <div class="krv-transparency-info">
                                <h4>{{ __('Penyimpanan Token Aman') }}</h4>
                                <p>{{ __('Semua token autentikasi dan penyegaran disimpan dalam database kami menggunakan enkripsi standar industri (AES-256).') }}</p>
                            </div>
                        </div>

                        <!-- Transparency Item 3 -->
                        <div class="krv-transparency-item">
                            <div class="krv-transparency-icon bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                                <i class="ri-close-circle-line"></i>
                            </div>
                            <div class="krv-transparency-info">
                                <h4>{{ __('Tanpa Jual atau Berbagi') }}</h4>
                                <p>{{ __('Data Anda tidak pernah dijual, disewakan, atau dibagikan ke pihak ketiga mana pun untuk tujuan periklanan atau pemasaran.') }}</p>
                            </div>
                        </div>

                        <!-- Transparency Item 4 -->
                        <div class="krv-transparency-item">
                            <div class="krv-transparency-icon bg-purple-500/10 border border-purple-500/20 text-purple-400">
                                <i class="ri-delete-bin-6-line"></i>
                            </div>
                            <div class="krv-transparency-info">
                                <h4>{{ __('Minimisasi & Penghapusan') }}</h4>
                                <p>{{ __('Hapus akun Anda kapan saja untuk membersihkan data Anda secara permanen. Token akun tidak aktif otomatis dihapus setelah 12 bulan.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Final CTA Callout -->
            <section class="krv-cta-callout">
                <h2>{{ __('Siap Mendapatkan Pekerjaan Impian Anda?') }}</h2>
                <p>{{ __('Bergabunglah dengan Karivio hari ini dan rasakan kemudahan mengelola seluruh proses lamaran kerja Anda.') }}</p>

                <div class="krv-cta-actions-wrapper" style="margin-top: 1.5rem; width: 100%; display: flex; justify-content: center; padding-left: 1.5rem; padding-right: 1.5rem; box-sizing: border-box;">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-glow krv-btn-cta bg-blue-600 text-white">
                            <span>{{ __('Ke Dashboard') }}</span>
                            <i class="ri-arrow-right-line" style="margin-left: 0.5rem;"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-glow krv-btn-cta bg-gradient-to-r from-blue-600 to-cyan-500 text-white">
                            <i class="ri-google-fill" style="margin-right: 0.5rem;"></i>
                            <span>{{ __('Mulai Gratis') }}</span>
                            <i class="ri-arrow-right-line" style="margin-left: 0.5rem;"></i>
                        </a>
                    @endauth
                </div>
            </section>

        </main>
    </div>

    <!-- Footer -->
    <footer class="krv-footer">
        <div class="krv-container">
            <div class="krv-footer-wrapper">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('logo.svg') }}" alt="Karivio Logo" class="h-6 w-6">
                    <span class="text-sm font-bold text-gray-400">© <script>document.write(new Date().getFullYear())</script> Karivio. All Rights Reserved.</span>
                </div>

                <div class="krv-footer-links">
                    <a href="#features">{{ __('Core Features') }}</a>
                    <a href="#transparency">{{ __('Google OAuth & Permissions') }}</a>
                    <a href="{{ route('privacy') }}" style="color: #3b82f6; text-decoration: underline;">{{ __('Privacy Policy') }}</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const overlay = document.getElementById('mobile-overlay');
            const drawer = document.getElementById('mobile-drawer');
            const icon = document.getElementById('mobile-menu-icon');
            const menuLinks = drawer.querySelectorAll('a');

            function toggleMenu() {
                const isHidden = drawer.classList.contains('hidden');
                
                if (isHidden) {
                    overlay.classList.remove('hidden');
                    drawer.classList.remove('hidden');
                    drawer.classList.add('flex');
                    // Slight delay to allow display block to apply before opacity transition
                    setTimeout(() => {
                        overlay.classList.remove('opacity-0');
                        drawer.classList.remove('translate-x-full');
                        drawer.classList.add('translate-x-0');
                    }, 10);
                    icon.classList.remove('ri-menu-3-line');
                    icon.classList.add('ri-close-line');
                    document.body.style.overflow = 'hidden'; // Prevent scrolling
                } else {
                    overlay.classList.add('opacity-0');
                    drawer.classList.remove('translate-x-0');
                    drawer.classList.add('translate-x-full');
                    setTimeout(() => {
                        overlay.classList.add('hidden');
                        drawer.classList.remove('flex');
                        drawer.classList.add('hidden');
                    }, 300); // Wait for transition
                    icon.classList.remove('ri-close-line');
                    icon.classList.add('ri-menu-3-line');
                    document.body.style.overflow = ''; // Restore scrolling
                }
            }

            btn.addEventListener('click', toggleMenu);
            overlay.addEventListener('click', toggleMenu); // Click overlay to close

            // Close menu when clicking a link
            menuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (!drawer.classList.contains('hidden')) {
                        toggleMenu();
                    }
                });
            });
        });
    </script>
</body>

</html>
