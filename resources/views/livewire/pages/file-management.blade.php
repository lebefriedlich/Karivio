<main class="p-6">
    <!-- Page Title Start -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">📁 File Saya</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola semua dokumen CV dan Cover Letter Anda di satu tempat.</p>
        </div>
    </div>
    <!-- Page Title End -->

    @if ($files->isEmpty())
        <div class="bg-gray-50 dark:bg-gray-900/50 border-2 border-dashed border-gray-300 dark:border-slate-700 rounded-lg p-12 text-center">
            <div class="w-16 h-16 mx-auto text-gray-400 dark:text-slate-600 mb-4">
                <i class="ri-folder-info-line text-5xl text-slate-300"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-slate-200">Belum ada File</h3>
            <p class="text-gray-600 dark:text-slate-400 mt-2">Mulai dengan membuat CV atau Cover Letter Anda</p>
            <div class="justify-center flex gap-3 mt-6">
                <a href="{{ route('cv.form') }}" class="btn bg-primary text-white">
                    Buat CV
                </a>
                <a href="{{ route('cover-letter.form') }}" class="btn bg-indigo-600 text-white">
                    Buat Cover Letter
                </a>
            </div>
        </div>
    @else
    <!-- File List Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($files as $file)
                <div class="group relative bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden" style="border-radius: 2rem !important;">
                    <!-- Header Card -->
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-{{ $file['color'] }}-50 dark:bg-{{ $file['color'] }}-900/20 text-{{ $file['color'] }}-600 dark:text-{{ $file['color'] }}-400 shadow-inner">
                                <i class="{{ $file['icon'] }} text-2xl"></i>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $file['color'] }}-100 dark:bg-{{ $file['color'] }}-900/30 text-{{ $file['color'] }}-800 dark:text-{{ $file['color'] }}-300">
                                {{ $file['type'] }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-slate-900 dark:text-white truncate mb-1" title="{{ $file['title'] }}">
                            {{ $file['title'] }}
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 truncate mb-4">
                            {{ $file['subtitle'] }}
                        </p>

                        <div class="flex items-center text-xs text-slate-400 dark:text-slate-500 mb-6">
                            <i class="ri-time-line mr-1.5"></i>
                            Terakhir diubah: {{ $file['date']->diffForHumans() }}
                        </div>

                        <!-- Actions -->
                        <div class="grid grid-cols-2 gap-3 mt-auto">
                            <a href="{{ $file['route_preview'] }}" class="flex items-center justify-center gap-2 py-2.5 px-4 bg-slate-50 dark:bg-slate-700 hover:bg-slate-100 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 rounded-xl font-bold text-sm transition-colors border border-slate-200 dark:border-slate-600">
                                <i class="ri-eye-line"></i> Preview
                            </a>
                            <button wire:click="export('{{ $file['type'] }}', '{{ $file['id'] }}')" class="flex items-center justify-center gap-2 py-2.5 px-4 bg-{{ $file['color'] }}-600 hover:bg-{{ $file['color'] }}-700 text-white rounded-xl font-bold text-sm transition-all shadow-lg shadow-{{ $file['color'] }}-500/20 border-none cursor-pointer">
                                <i class="ri-download-2-line"></i> PDF
                            </button>
                        </div>
                    </div>

                    <!-- Footer Card / Edit Link -->
                    <a href="{{ $file['route_edit'] }}" class="block py-3 px-5 text-center text-xs font-semibold text-slate-400 dark:text-slate-500 hover:text-{{ $file['color'] }}-600 dark:hover:text-{{ $file['color'] }}-400 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700 transition-colors">
                        <i class="ri-edit-line mr-1"></i> Edit Dokumen
                    </a>
                </div>
            @endforeach
        </div>
    @endforelse
</main>
