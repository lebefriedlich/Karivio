<main class="p-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">
                @if ($coverLetterId)
                    Edit Cover Letter - {{ $company_name }}
                @else
                    Buat Cover Letter Baru
                @endif
            </h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Isi data Cover Letter Anda</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('cover-letter.list') }}" class="btn bg-secondary text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-arrow-left-line text-lg"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-5">
        <div class="col-span-12 lg:col-span-7">
            <div class="card bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 shadow-sm" style="border-radius: 2rem !important;">
                <div class="card-header border-b border-slate-100 dark:border-slate-700">
                    <h4 class="card-title text-slate-900 dark:text-slate-200">Form Data Lamaran</h4>
                </div>

                <div class="p-6">


                    <form wire:submit.prevent="save" class="space-y-12">
                        <!-- 1. Data Pribadi -->
                        <div>
                            <div class="flex items-center gap-2 mb-6">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">1</span>
                                <h5 class="text-xl font-bold text-slate-900 dark:text-slate-200">Data Pribadi</h5>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                                <input type="text" wire:model.live="full_name" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Nama Lengkap">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Nomor Telepon</label>
                                <input type="tel" wire:model="phone" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="0812...">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Email</label>
                                <input type="email" wire:model="email" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="email@contoh.com">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Kota Asal</label>
                                <input type="text" wire:model="city" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Kota">
                            </div>
                            </div>
                        </div>

                        <!-- 2. Data Perusahaan & Posisi -->
                        <div>
                            <div class="flex items-center gap-2 mb-6">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">2</span>
                                <h5 class="text-xl font-bold">Tujuan Lamaran</h5>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Nama Perusahaan</label>
                                <input type="text" wire:model.live="company_name" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Nama Perusahaan">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Posisi yang Dilamar</label>
                                <input type="text" wire:model.live="applied_position" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Posisi">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Alamat Perusahaan</label>
                                <input type="text" wire:model="company_address" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Alamat Perusahaan">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Tanggal Surat</label>
                                <input type="date" wire:model="date" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                            </div>
                        </div>

                        <!-- 3. Isi Surat -->
                        <div>
                            <div class="flex items-center gap-2 mb-6">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">3</span>
                                <h5 class="text-xl font-bold text-slate-900 dark:text-slate-200">Isi Surat (Body)</h5>
                            </div>
                            <textarea wire:model="content" rows="15" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 font-mono text-sm"></textarea>
                        </div>

                        <div class="flex flex-wrap items-center justify-start gap-4 pt-8">
                            <button type="submit" wire:loading.attr="disabled" style="background-color: #16a34a; padding: 12px 28px; color: white; border-radius: 12px; font-weight: 800; border: none; display: flex; align-items: center; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all disabled:opacity-75 disabled:cursor-not-allowed">
                                <span wire:loading.remove wire:target="save">
                                    <i class="ri-save-fill" style="margin-right: 8px; font-size: 1.25rem;"></i> 
                                    <span>SIMPAN COVER LETTER</span>
                                </span>
                                <span wire:loading wire:target="save" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>MENYIMPAN...</span>
                                </span>
                            </button>
                            @if ($coverLetterId)
                                <a href="{{ route('cover-letter.preview', $coverLetterId) }}" style="background-color: #2563eb; padding: 12px 28px; color: white; border-radius: 12px; font-weight: 800; text-decoration: none; display: flex; align-items: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all">
                                    <i class="ri-eye-fill" style="margin-right: 8px; font-size: 1.25rem;"></i> 
                                    <span>PREVIEW COVER LETTER</span>
                                </a>
                                <button type="button" wire:click="exportPdf" style="background-color: #dc2626; padding: 12px 28px; color: white; border-radius: 12px; font-weight: 800; border: none; display: flex; align-items: center; font-size: 14px; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all">
                                    <i class="ri-file-pdf-line" style="margin-right: 8px; font-size: 1.25rem;"></i> 
                                    <span>EXPORT PDF</span>
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Hint Section -->
        <div class="col-span-12 lg:col-span-5">
            <div class="sticky top-6 space-y-6">
                <div class="bg-indigo-600 rounded-2xl p-6 text-white shadow-xl" style="border-radius: 2rem !important;">
                    <h5 class="font-black flex items-center gap-2 mb-4 uppercase tracking-wider">
                        <i class="ri-lightbulb-line"></i> Panduan Placeholder
                    </h5>
                    <div class="space-y-4">
                        <p class="text-sm opacity-90 leading-relaxed">Gunakan kode di bawah ini di dalam teks surat Anda agar data terisi otomatis:</p>
                        <div class="grid grid-cols-1 gap-2">
                            <div class="bg-white/10 p-2 rounded border border-white/20 flex justify-between items-center">
                                <code class="text-xs text-yellow-300 font-bold bg-black/20 px-2 py-0.5 rounded shadow-sm">@{{ Nama Lengkap }}</code>
                                <span class="text-[10px] opacity-75 font-semibold">Nama Anda</span>
                            </div>
                            <div class="bg-white/10 p-2 rounded border border-white/20 flex justify-between items-center">
                                <code class="text-xs text-yellow-300 font-bold bg-black/20 px-2 py-0.5 rounded shadow-sm">@{{ Nama Perusahaan }}</code>
                                <span class="text-[10px] opacity-75 font-semibold">Nama Perusahaan</span>
                            </div>
                            <div class="bg-white/10 p-2 rounded border border-white/20 flex justify-between items-center">
                                <code class="text-xs text-yellow-300 font-bold bg-black/20 px-2 py-0.5 rounded shadow-sm">@{{ Posisi }}</code>
                                <span class="text-[10px] opacity-75 font-semibold">Posisi Dilamar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
