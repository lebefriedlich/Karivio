<main class="p-6" x-data>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">
                ✉️{{ __('List Cover Letter Saya') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                {{ __('Kelola dan lihat semua Cover Letter Anda') }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button wire:click="openTemplateModal"
                class="btn bg-success hover:bg-success/90 text-white shadow-lg shadow-success/20 px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-file-text-line text-lg"></i> {{ __('Template Body') }}
            </button>
            <a href="{{ route('cover-letter.form') }}"
                class="btn bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg shadow-indigo-600/20 px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-add-line text-lg"></i> {{ __('Buat Cover Letter Baru') }}
            </a>
        </div>

    </div>

    <!-- Template Modal -->
    @if($showTemplateModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" style="background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);">
            <div class="w-full max-w-xl overflow-hidden animate-in fade-in zoom-in duration-300" 
                 style="background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(24px); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 1.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
                <div class="p-6 flex justify-between items-center" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <h3 class="text-xl font-bold flex items-center gap-2" style="color: #fff;">
                        <i class="ri-file-text-line" style="color: #fbbf24;"></i>
                        {{ __('Default Template Body') }}
                    </h3>
                    <button wire:click="$set('showTemplateModal', false)"
                        class="rounded-full flex items-center justify-center transition-all"
                        style="width: 32px; height: 32px; background: rgba(255,255,255,0.05); color: #94a3b8; border: none;">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>
                <div class="p-6">
                    <p class="text-sm mb-5" style="color: #cbd5e1;">
                        {{ __('Atur template default yang akan digunakan saat membuat Cover Letter baru. Gunakan placeholder berikut untuk pengisian otomatis:') }}
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-5 p-4 rounded-2xl text-xs font-mono" 
                         style="background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.2);">
                        <div class="font-bold flex items-center gap-2" style="color: #818cf8;">
                            <i class="ri-briefcase-line"></i> @{{ posisi }} / @{{ position }}
                        </div>
                        <div class="font-bold flex items-center gap-2" style="color: #818cf8;">
                            <i class="ri-building-line"></i> @{{ nama perusahaan }} / @{{ company name }}
                        </div>
                    </div>
                    <textarea wire:model="templateContent" rows="8"
                        class="w-full px-5 py-4 rounded-2xl transition-all resize-none shadow-inner"
                        style="background: rgba(0,0,0,0.25); border: 1px solid rgba(255,255,255,0.1); color: #fff; font-size: 14px;"
                        placeholder="{{ __('Tulis template Anda di sini...') }}"></textarea>
                </div>
                <div class="p-6 flex justify-end gap-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <button wire:click="$set('showTemplateModal', false)"
                        class="px-6 py-2.5 rounded-xl font-bold transition-all"
                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #cbd5e1;">
                        {{ __('Batal') }}
                    </button>
                    <button wire:click="saveTemplate"
                        class="px-6 py-2.5 rounded-xl font-bold transition-all"
                        style="background: #4f46e5; border: 1px solid rgba(99,102,241,0.5); color: #fff; box-shadow: 0 4px 14px 0 rgba(79,70,229,0.39);">
                        {{ __('Simpan Template') }}
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if ($coverLetters->isEmpty())
        <div
            class="bg-gray-50 dark:bg-gray-900/50 border-2 border-dashed border-gray-300 dark:border-slate-700 rounded-lg p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-slate-600 mb-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 dark:text-slate-200">{{ __('Belum ada Cover Letter') }}</h3>
            <p class="text-gray-600 dark:text-slate-400 mt-2">{{ __('Mulai dengan membuat Cover Letter pertama Anda') }}</p>
            <a href="{{ route('cover-letter.form') }}" class="mt-4 inline-block btn bg-primary text-white">
                {{ __('Buat Cover Letter Sekarang') }}
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($coverLetters as $coverLetter)
                <div
                    class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $coverLetter->full_name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-400 mt-1">{{ $coverLetter->email }}</p>
                        <p class="text-sm text-gray-600 dark:text-slate-400">{{ $coverLetter->phone }}</p>

                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-slate-700">
                            <div class="grid grid-cols-2 gap-2 text-xs text-gray-600 dark:text-slate-400 mb-4">
                                <div>
                                    <span class="font-semibold">📍 {{ __('Lokasi') }}:</span> {{ $coverLetter->city ?? '-' }}
                                </div>
                                <div>
                                    <span class="font-semibold">💼 {{ __('Posisi') }}:</span>
                                    {{ $coverLetter->applied_position ?? '-' }}
                                </div>
                                <div>
                                    <span class="font-semibold">💼 {{ __('Perusahaan') }}:</span>
                                    {{ $coverLetter->company_name ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('cover-letter.form', $coverLetter->id) }}"
                                class="flex-1 btn bg-primary/10 text-primary text-sm text-center">
                                ✏️ {{ __('Edit') }}
                            </a>
                            <a href="{{ route('cover-letter.preview', $coverLetter->id) }}"
                                class="flex-1 btn bg-info/10 text-info text-sm text-center">
                                👁️ {{ __('Preview') }}
                            </a>
                            <button wire:click="confirmDelete('{{ $coverLetter->id }}')"
                                class="flex-1 btn bg-danger/10 text-danger text-sm">
                                🗑️ {{ __('Hapus') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $coverLetters->links() }}
        </div>
    @endif
</main>