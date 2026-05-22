<div>
    <div class="krv-login-bg">
        <div class="krv-orb-1"></div>
        <div class="krv-orb-2"></div>
        <div class="krv-grid-overlay"></div>
    </div>

    <div class="krv-login-container">
        <div class="krv-glass-card">
            <div class="krv-glass-glare"></div>
            
            <div class="krv-glass-header">
                <a href="{{ route('login') }}" style="text-decoration: none; display: flex; flex-direction: column; align-items: center;">
                    <div class="krv-logo-box">
                        <img src="{{ asset('logo.svg') }}" alt="Karivio Logo" style="height: 48px; display: block;">
                    </div>
                    <h1 class="krv-logo-text">Karivio</h1>
                </a>
            </div>

            <div class="krv-glass-body">
                <h4 class="krv-welcome-title">{{ __('Selamat Datang') }}</h4>
                <p class="krv-welcome-desc">{{ __('Silakan masuk menggunakan akun Google Anda untuk melanjutkan ke dashboard.') }}</p>

                <a href="{{ route('auth.google') }}" class="krv-google-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 48 48">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                        <path fill="none" d="M0 0h48v48H0z"/>
                    </svg>
                    <span>{{ __('Masuk dengan Google') }}</span>
                </a>
            </div>
        </div>

        <div class="krv-footer-text">
            Karivio &copy; {{ date('Y') }} | 
            <a href="{{ route('privacy') }}">{{ __('Privacy Policy') }}</a>
        </div>
    </div>

    <div class="krv-lang-toggle">
        <a href="{{ route('locale.switch', 'id') }}" class="krv-lang-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}" title="Indonesia">ID</a>
        <a href="{{ route('locale.switch', 'en') }}" class="krv-lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" title="English">EN</a>
    </div>
</div>