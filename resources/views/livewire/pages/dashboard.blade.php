<main class="p-6">

    <!-- Page Title Start -->
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Beranda</h4>
    </div>
    <!-- Page Title End -->

    <!-- File Management Section -->
    <div class="mb-8 p-6 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:!from-emerald-950/20 dark:!to-emerald-900/20 rounded-lg border border-emerald-200 dark:!border-emerald-800 shadow-sm dark:shadow-none" style="background: linear-gradient(to right, #ecfdf5, #d1fae5); border-color: #a7f3d0; border-radius: 2rem !important;">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-900 mb-2">📁 File Saya</h2>
                <p class="text-indigo-700 dark:text-gray-500/90">Lihat semua dokumen CV dan Cover Letter Anda di satu tempat</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('email.list') }}" class="btn bg-white dark:bg-slate-800 text-indigo dark:text-emerald-300 shadow-lg shadow-red-600/10 border border-transparent dark:border-emerald-800/50">
                    ✉️ Kirim Email
                </a>
                <a href="{{ route('file-management') }}" class="btn bg-indigo-600 dark:bg-emerald-600 text-white shadow-lg shadow-indigo-600/20">
                    📂 Buka File Saya
                </a>
            </div>
        </div>
    </div>

    <!-- CV Management Section -->
    <div class="mb-8 p-6 bg-gradient-to-r from-blue-50 to-blue-100 dark:!from-blue-950/20 dark:!to-blue-900/20 rounded-lg border border-blue-200 dark:!border-blue-800 shadow-sm dark:shadow-none" style="background: linear-gradient(to right, #eff6ff, #dbeafe); border-color: #bfdbfe; border-radius: 2rem !important;">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-900 mb-2">📄 Manajemen CV</h2>
                <p class="text-blue-700 dark:text-gray-500/90">Buat, edit, dan kelola CV Anda dengan mudah</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('cv.form') }}" class="btn bg-primary text-white shadow-lg shadow-primary/20">
                    ✏️ Buat CV Baru
                </a>
                <a href="{{ route('cv.list') }}" class="btn bg-white dark:bg-slate-800 text-primary border border-primary/20 dark:border-blue-800/50 shadow-sm">
                    📋 Lihat CV Saya
                </a>
            </div>
        </div>
    </div>

    <!-- Cover Letter Management Section -->
    <div class="mb-8 p-6 bg-gradient-to-r from-blue-50 to-blue-100 dark:!from-indigo-950/20 dark:!to-indigo-900/20 rounded-lg border border-blue-200 dark:!border-indigo-800 shadow-sm dark:shadow-none" style="background: linear-gradient(to right, #eff6ff, #dbeafe); border-color: #bfdbfe; border-radius: 2rem !important;">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-900 mb-2">✉️ Manajemen Cover Letter</h2>
                <p class="text-blue-700 dark:text-gray-500/90">Buat surat lamaran kerja profesional dalam hitungan detik</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('cover-letter.form') }}" class="btn bg-primary text-white shadow-lg shadow-primary/20">
                    ✍️ Buat Surat Baru
                </a>
                <a href="{{ route('cover-letter.list') }}" class="btn bg-white dark:bg-slate-800 text-primary dark:text-indigo-300 border border-primary/20 dark:border-indigo-800/50 shadow-sm">
                    📂 Daftar Surat
                </a>
            </div>
        </div>
    </div>

</main>