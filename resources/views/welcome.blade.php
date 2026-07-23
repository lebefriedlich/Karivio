<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('Buat CV profesional, buat surat lamaran kerja terpersonalisasi, serta pantau dan kirim lamaran kerja Anda secara langsung dari akun Gmail Anda semua dalam satu platform elegan.') }}">
    <meta name="keywords" content="Karivio, CV Builder, Lamaran Kerja, Job Application, Cover Letter Generator, Gmail Integration, Auto Apply">
    <meta name="author" content="Karivio">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url('/') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Karivio - {{ __('Hub Lamaran Kerja Terbaik') }}">
    <meta property="og:description" content="{{ __('Buat CV profesional, buat surat lamaran kerja terpersonalisasi, serta pantau dan kirim lamaran kerja Anda secara langsung dari akun Gmail Anda semua dalam satu platform elegan.') }}">
    <meta property="og:image" content="{{ asset('logo.svg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Karivio - {{ __('Hub Lamaran Kerja Terbaik') }}">
    <meta property="twitter:description" content="{{ __('Buat CV profesional, buat surat lamaran kerja terpersonalisasi, serta pantau dan kirim lamaran kerja Anda secara langsung dari akun Gmail Anda semua dalam satu platform elegan.') }}">
    <meta property="twitter:image" content="{{ asset('logo.svg') }}">

    <title>Karivio - {{ __('Hub Lamaran Kerja Terbaik') }}</title>

    <link rel="shortcut icon" href="{{ asset('logo.svg') }}">
    <link rel="preload" href="{{ asset('assets/css/app.min.css') }}" as="style">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
    <noscript><link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"></noscript>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="preload" href="{{ asset('assets/css/welcome.css') }}" as="style">
    <link href="{{ asset('assets/css/welcome.css') }}" rel="stylesheet" type="text/css">
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
                        <a href="{{ route('dashboard') }}" class="btn-glow bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all flex items-center gap-2">
                            <i class="ri-dashboard-line"></i>
                            <span>{{ __('Ke Dashboard') }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-glow bg-gradient-to-r from-blue-700 to-cyan-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm flex items-center gap-2">
                            <i class="ri-google-fill"></i>
                            <span>{{ __('Masuk') }}</span>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden text-gray-300 hover:text-white text-3xl p-1 transition-transform active:scale-90 flex items-center justify-center" aria-label="Toggle Menu">
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
                    <a href="{{ route('dashboard') }}" class="btn-glow bg-blue-700 text-white font-bold px-5 py-4 rounded-2xl text-center flex justify-center items-center gap-2">
                        <i class="ri-dashboard-line text-lg"></i>
                        <span>{{ __('Ke Dashboard') }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-glow bg-gradient-to-r from-blue-700 to-cyan-700 text-white font-bold px-5 py-4 rounded-2xl text-center flex justify-center items-center gap-2">
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
                            {{ __('Buat CV profesional, buat surat lamaran kerja terpersonalisasi, serta pantau dan kirim lamaran kerja Anda secara langsung dari akun Gmail Anda semua dalam satu platform elegan.') }}
                        </p>

                        <div class="krv-hero-ctas">
                            @auth
                                <a href="{{ route('dashboard') }}" class="btn-glow krv-hero-btn bg-blue-700 text-white">
                                    <span>{{ __('Ke Dashboard') }}</span>
                                    <i class="ri-arrow-right-line" style="margin-left: 0.5rem;"></i>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-glow krv-hero-btn bg-gradient-to-r from-blue-700 to-cyan-700 text-white">
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
                                <span class="text-[10px] text-gray-400 tracking-wider font-mono">karivio.mhna.my.id/dashboard</span>
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
                                            <span class="font-bold text-white text-xs block">Curriculum Vitae (CV)</span>
                                            <p class="text-[10px] text-gray-400">{{ __('Terakhir diubah') }} - {{ date('d M Y') }}</p>
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
                                            <span class="font-bold text-white text-xs block">Cover Letter</span>
                                            <p class="text-[10px] text-gray-400">{{ __('Terakhir diubah') }} - {{ date('d M Y') }}</p>
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
                            <span class="text-2xl font-bold text-gray-400">+</span>
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
                                <h3>{{ __('Izin & OAuth Google') }}</h3>
                                <p>{!! __('Kami hanya meminta izin <code>gmail.send</code> untuk mengirim lamaran yang Anda picu. Kami TIDAK PERNAH membaca kotak masuk atau mengakses email Anda yang lain.') !!}</p>
                            </div>
                        </div>

                        <!-- Transparency Item 2 -->
                        <div class="krv-transparency-item">
                            <div class="krv-transparency-icon bg-cyan-500/10 border border-cyan-500/20 text-cyan-400">
                                <i class="ri-key-2-line"></i>
                            </div>
                            <div class="krv-transparency-info">
                                <h3>{{ __('Penyimpanan Token Aman') }}</h3>
                                <p>{{ __('Semua token autentikasi dan penyegaran disimpan dalam database kami menggunakan enkripsi standar industri (AES-256).') }}</p>
                            </div>
                        </div>

                        <!-- Transparency Item 3 -->
                        <div class="krv-transparency-item">
                            <div class="krv-transparency-icon bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                                <i class="ri-close-circle-line"></i>
                            </div>
                            <div class="krv-transparency-info">
                                <h3>{{ __('Tanpa Jual atau Berbagi') }}</h3>
                                <p>{{ __('Data Anda tidak pernah dijual, disewakan, atau dibagikan ke pihak ketiga mana pun untuk tujuan periklanan atau pemasaran.') }}</p>
                            </div>
                        </div>

                        <!-- Transparency Item 4 -->
                        <div class="krv-transparency-item">
                            <div class="krv-transparency-icon bg-purple-500/10 border border-purple-500/20 text-purple-400">
                                <i class="ri-delete-bin-6-line"></i>
                            </div>
                            <div class="krv-transparency-info">
                                <h3>{{ __('Minimisasi & Penghapusan') }}</h3>
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
                        <a href="{{ route('dashboard') }}" class="btn-glow krv-btn-cta bg-blue-700 text-white">
                            <span>{{ __('Ke Dashboard') }}</span>
                            <i class="ri-arrow-right-line" style="margin-left: 0.5rem;"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-glow krv-btn-cta bg-gradient-to-r from-blue-700 to-cyan-700 text-white">
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
                    <span class="text-sm font-bold text-gray-400">&copy; <script>document.write(new Date().getFullYear())</script> Karivio. All Rights Reserved.</span>
                </div>

                <div class="krv-footer-links">
                    <a href="#philosophy">{{ __('Filosofi Karivio') }}</a>
                    <a href="#features">{{ __('Core Features') }}</a>
                    <a href="#transparency">{{ __('Google OAuth & Permissions') }}</a>
                    <a href="{{ route('privacy') }}" style="color: #3b82f6; text-decoration: underline;">{{ __('Privacy Policy') }}</a>
                </div>
            </div>
        </div>
    </footer>

    <script defer src="{{ asset('assets/js/welcome.js') }}"></script>
</body>

</html>

