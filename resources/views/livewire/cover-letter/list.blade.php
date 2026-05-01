<main class="p-6" x-data>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">✉️Daftar Cover Letter Saya</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola dan lihat semua Cover Letter Anda</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('cover-letter.form') }}" class="btn bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg shadow-indigo-600/20 px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-add-line text-lg"></i> Buat Cover Letter Baru
            </a>
        </div>
    
    </div>

    @if ($coverLetters->isEmpty())
        <div class="bg-gray-50 dark:bg-gray-900/50 border-2 border-dashed border-gray-300 dark:border-slate-700 rounded-lg p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 dark:text-slate-200">Belum ada Cover Letter</h3>
            <p class="text-gray-600 dark:text-slate-400 mt-2">Mulai dengan membuat Cover Letter pertama Anda</p>
            <a href="{{ route('cover-letter.form') }}" class="mt-4 inline-block btn bg-primary text-white">
                Buat Cover Letter Sekarang
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($coverLetters as $coverLetter)
                <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $coverLetter->full_name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-400 mt-1">{{ $coverLetter->email }}</p>
                        <p class="text-sm text-gray-600 dark:text-slate-400">{{ $coverLetter->phone }}</p>

                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-slate-700">
                            <div class="grid grid-cols-2 gap-2 text-xs text-gray-600 dark:text-slate-400 mb-4">
                                <div>
                                    <span class="font-semibold">📍 Lokasi:</span> {{ $coverLetter->city ?? '-' }}
                                </div>
                                <div>
                                    <span class="font-semibold">💼 Posisi:</span> {{ $coverLetter->applied_position ?? '-' }}
                                </div>
                                <div>
                                    <span class="font-semibold">💼 Perusahaan:</span> {{ $coverLetter->company_name ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('cover-letter.form', $coverLetter->id) }}" class="flex-1 btn bg-primary/10 text-primary text-sm text-center">
                                ✏️ Edit
                            </a>
                            <a href="{{ route('cover-letter.preview', $coverLetter->id) }}" class="flex-1 btn bg-info/10 text-info text-sm text-center">
                                👁️ Preview
                            </a>
                            <button wire:click="confirmDelete('{{ $coverLetter->id }}')"
                                    class="flex-1 btn bg-danger/10 text-danger text-sm">
                                🗑️ Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</main>
