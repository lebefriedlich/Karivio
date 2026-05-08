<main class="p-6 max-w-7xl mx-5 px-4 sm:px-6 lg:px-8 py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen">
    <!-- Header dengan Aksi Utama -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">
                {{ __('Pratinjau Cover Letter') }}
            </h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">{{ $coverLetter->company_name }}</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('cover-letter.list') }}"
                class="btn bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg shadow-indigo-600/20 px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-arrow-left-line text-lg"></i> Kembali
            </a>
            <a href="{{ route('cover-letter.form', $coverLetter->id) }}"
                class="btn bg-primary text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-edit-line text-lg"></i> Edit Data
            </a>
            <button wire:click="exportPdf"
                class="btn px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all"
                style="background-color: #dc2626; padding: 10px 20px; color: white; border-radius: 12px; font-weight: 700; border: none; display: flex; align-items: center; font-size: 14px; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                class="hover:opacity-90 transition-all">
                <i class="ri-file-pdf-line text-lg"></i> Export PDF
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main Content (Cover Letter Paper) -->
        <div class="lg:col-span-2 flex justify-center">
            @if($hasPdf)
                <div class="w-full bg-white dark:bg-gray-900 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800"
                    style="height: 1150px;">
                    <iframe src="{{ $pdfUrl }}" class="w-full h-full border-none"
                        style="display: block; border: none;"></iframe>
                </div>
            @else
                <div
                    class="w-full p-20 bg-white dark:bg-gray-800 rounded-3xl border-4 border-dashed border-gray-200 dark:border-gray-700 flex flex-col items-center justify-center text-center">
                    <div
                        class="w-20 h-20 bg-amber-50 dark:bg-amber-900/30 rounded-full flex items-center justify-center mb-6">
                        <i class="ri-file-warning-line text-4xl text-amber-500"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white">PDF Belum Siap!</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-3 max-w-sm">File PDF pratinjau belum dibuat. Silakan klik
                        tombol <b>Edit Data</b> lalu <b>Simpan</b> untuk men-generate file PDF terbaru.</p>
                    <a href="{{ route('cover-letter.form', $coverLetter->id) }}"
                        class="mt-8 px-8 py-3 bg-primary text-white rounded-xl font-bold hover:opacity-90 transition-all">
                        Edit & Simpan Sekarang
                    </a>
                </div>
            @endif
        </div>

        <!-- Sidebar Actions -->
        <div class="lg:col-span-1">
            <div class="sticky top-6 space-y-6">
                <!-- Aksi Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden"
                    style="border-radius: 2rem !important;">
                    <div class="p-6 bg-gray-50/50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="font-black text-gray-900 dark:text-white flex items-center gap-2">
                            <i class="ri-flashlight-line text-primary"></i> {{ __('AKSI CEPAT') }}
                        </h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <button wire:click="exportPdf"
                            style="background-color: #dc2626; padding: 12px 20px; color: white; border-radius: 12px; font-weight: 700; border: none; display: flex; align-items: center; justify-content: center; width: 100%; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                            class="hover:opacity-90 transition-all text-center">
                            <i class="ri-file-pdf-line" style="margin-right: 8px;"></i> {{ __('EXPORT PDF') }}
                        </button>
                        <a href="{{ route('cover-letter.form', $coverLetter->id) }}"
                            style="background-color: #2563eb; padding: 12px 20px; color: white; border-radius: 12px; font-weight: 700; text-decoration: none; display: flex; align-items: center; justify-content: center; width: 100%; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                            class="hover:opacity-90 transition-all text-center">
                            <i class="ri-edit-line" style="margin-right: 8px;"></i> {{ __('EDIT DATA') }}
                        </a>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-primary rounded-2xl shadow-lg p-6 text-white" style="border-radius: 2rem !important;">
                    <h3 class="font-black mb-4 flex items-center gap-2">
                        <i class="ri-building-line"></i> {{ __('INFO LAMARAN') }}
                    </h3>
                    <div class="space-y-3 text-sm font-medium">
                        <div class="flex flex-col opacity-90 border-b border-white/20 pb-2">
                            <span class="text-xs opacity-75 mb-1">{{ __('Posisi') }}</span>
                            <span class="font-bold">{{ $coverLetter->applied_position }}</span>
                        </div>
                        <div class="flex flex-col opacity-90 border-b border-white/20 pb-2">
                            <span class="text-xs opacity-75 mb-1">{{ __('Perusahaan') }}</span>
                            <span class="font-bold">{{ $coverLetter->company_name }}</span>
                        </div>
                        <div class="flex flex-col opacity-90 pb-1">
                            <span class="text-xs opacity-75 mb-1">{{ __('Tanggal Buat') }}</span>
                            <span
                                class="font-bold">{{ \Carbon\Carbon::parse($coverLetter->created_at)->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>