<main class="p-6">

    <!-- Page Title Start -->
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ __('Beranda') }}</h4>
    </div>
    <!-- Page Title End -->

    <!-- File Management Section -->
    <div class="mb-8 p-6 rounded-[2rem] border shadow-lg relative overflow-hidden group transition-all" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border-color: rgba(255,255,255,0.1);">
        <div class="flex justify-between items-center relative z-10">
            <div>
                <h2 class="text-2xl font-bold text-white mb-2">📁 {{ __('File Saya') }}</h2>
                <p class="text-slate-300">{{ __('Lihat semua dokumen CV dan Cover Letter Anda di satu tempat') }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('email.list') }}" class="btn bg-white/10 hover:bg-white/20 text-white border border-white/20 shadow-lg backdrop-blur-md transition-all">
                    ✉️ {{ __('Kirim Email') }}
                </a>
                <a href="{{ route('file-management') }}" class="btn bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg border border-indigo-500/50 transition-all">
                    📂 {{ __('Buka File Saya') }}
                </a>
            </div>
        </div>
    </div>

    <!-- CV Management Section -->
    <div class="mb-8 p-6 rounded-[2rem] border shadow-lg relative overflow-hidden group transition-all" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border-color: rgba(255,255,255,0.1);">
        <div class="flex justify-between items-center relative z-10">
            <div>
                <h2 class="text-2xl font-bold text-white mb-2">📄 {{ __('Manajemen CV') }}</h2>
                <p class="text-slate-300">{{ __('Buat, edit, dan kelola CV Anda dengan mudah') }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('cv.form') }}" class="btn bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg border border-indigo-500/50 transition-all">
                    ✏️ {{ __('Buat CV Baru') }}
                </a>
                <a href="{{ route('cv.list') }}" class="btn bg-white/10 hover:bg-white/20 text-white border border-white/20 shadow-lg backdrop-blur-md transition-all">
                    📋 {{ __('Lihat CV Saya') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Cover Letter Management Section -->
    <div class="mb-8 p-6 rounded-[2rem] border shadow-lg relative overflow-hidden group transition-all" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border-color: rgba(255,255,255,0.1);">
        <div class="flex justify-between items-center relative z-10">
            <div>
                <h2 class="text-2xl font-bold text-white mb-2">✉️ {{ __('Manajemen Cover Letter') }}</h2>
                <p class="text-slate-300">{{ __('Buat surat lamaran kerja profesional dalam hitungan detik') }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('cover-letter.form') }}" class="btn bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg border border-indigo-500/50 transition-all">
                    ✍️ {{ __('Buat Surat Baru') }}
                </a>
                <a href="{{ route('cover-letter.list') }}" class="btn bg-white/10 hover:bg-white/20 text-white border border-white/20 shadow-lg backdrop-blur-md transition-all">
                    📂 {{ __('Daftar Surat') }}
                </a>
            </div>
        </div>
    </div>

</main>