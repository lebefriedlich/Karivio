<main class="p-6 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">Kirim Lamaran Baru</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Lengkapi form di bawah untuk mengirim lamaran via Gmail.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('email.list') }}" class="btn bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 font-bold px-4 py-2 rounded-xl text-sm">
                <i class="ri-arrow-left-line mr-1"></i> Kembali ke Riwayat
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Left: Form -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden" style="border-radius: 2rem !important;">
                <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-red-600">
                            <i class="ri-mail-send-line text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 dark:text-white">Tulis Lamaran Baru</h3>
                            <p class="text-xs text-slate-500">Menggunakan antrean (Queue) sistem</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Placeholder Controls -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Nama Anda</label>
                        <input type="text" wire:model.live="name" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-200 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white" placeholder="Nama Lengkap">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Posisi Dilamar</label>
                        <input type="text" wire:model.live="position" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-200 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white" placeholder="Posisi Dilamar">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Nama Perusahaan</label>
                        <input type="text" wire:model.live="company_name" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-200 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white" placeholder="Nama Perusahaan">
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kepada (Recruiter)</label>
                                <input type="email" wire:model="to" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Email Recruiter">
                                @error('to') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Subjek</label>
                                <input type="text" wire:model="subject" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Subjek Email">
                                @error('subject') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Waktu Kirim (Opsional)</label>
                                <input type="datetime-local" wire:model="scheduled_at" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 transition-all">
                                <p class="text-[10px] text-slate-400 mt-1 italic">Kosongkan untuk kirim sekarang.</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Isi Email</label>
                            <textarea wire:model="body" rows="10" class="w-full px-4 py-4 rounded-xl border border-slate-200 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 transition-all font-serif text-[15px] leading-relaxed"></textarea>
                            @error('body') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-indigo-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700 flex justify-end overflow-visible">
                    <button wire:click="send" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold transition-all shadow-lg shadow-indigo-600/20 whitespace-nowrap flex-shrink-0" wire:loading.attr="disabled">
                        <span wire:loading.remove class="flex items-center gap-2 px-5">
                            <i class="ri-send-plane-fill"></i> MASUKKAN ANTREAN
                        </span>
                        <span wire:loading class="flex items-center gap-2 px-5">
                            <i class="ri-loader-4-line animate-spin"></i> Memproses...
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- System Files -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm" style="border-radius: 2rem !important;">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2 text-sm uppercase tracking-wide">
                    <i class="ri-database-2-line text-primary"></i> Lampirkan File Sistem
                </h3>
                <div class="space-y-2 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($allSystemFiles as $file)
                        <label class="flex items-center gap-3 p-3 rounded-xl border {{ in_array($file['id'], $selectedSystemFileIds) ? 'bg-primary/5 border-primary/30' : 'bg-white dark:bg-slate-900 border-slate-100 dark:border-slate-800' }} cursor-pointer transition-all">
                            <input type="checkbox" wire:model.live="selectedSystemFileIds" value="{{ $file['id'] }}" class="w-4 h-4 text-primary rounded">
                            <div class="overflow-hidden">
                                <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $file['name'] }}</p>
                                <p class="text-[10px] text-slate-500">{{ $file['type'] === 'cv' ? 'CV' : 'Cover Letter' }}</p>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Upload -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm" style="border-radius: 2rem !important;">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2 text-sm uppercase tracking-wide">
                    <i class="ri-upload-cloud-2-line text-emerald-500"></i> Upload Manual
                </h3>
                
                <div class="relative group">
                    <label for="externalFiles" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-300 dark:border-slate-600 dark:bg-gray-900/50 rounded-2xl cursor-pointer bg-slate-50 dark:bg-slate-900/50 hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 hover:border-emerald-400 dark:hover:border-emerald-500 transition-all duration-300 active:scale-[0.98]">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="ri-add-circle-line text-2xl text-slate-400 group-hover:text-emerald-500 transition-colors"></i>
                            <p class="mt-2 text-[10px] text-slate-500 dark:text-slate-400 font-medium text-center px-2">Klik untuk pilih file</p>
                            <p class="text-[9px] text-slate-400 dark:text-slate-500 mt-1 italic">Total Maksimal 3 File (Sistem + Manual)</p>
                        </div>
                        <input id="externalFiles" type="file" wire:model.live="externalFiles" multiple class="hidden">
                    </label>
                    
                    @error('externalFiles') 
                        <p class="text-[10px] text-red-500 mt-2">{{ $message }}</p> 
                    @enderror
                </div>

                @if($externalFiles)
                    <div class="mt-4 space-y-2">
                        @foreach($externalFiles as $index => $file)
                            @if($file)
                            <div class="flex items-center justify-between p-2 bg-emerald-50/50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-800 rounded-lg animate-in fade-in slide-in-from-top-1">
                                <div class="flex items-center gap-2 truncate">
                                    <i class="ri-file-text-line text-emerald-600"></i>
                                    <span class="text-[10px] font-medium text-slate-700 dark:text-white truncate">{{ $file->getClientOriginalName() }}</span>
                                </div>
                                <button type="button" wire:click="$set('externalFiles.{{ $index }}', null)" class="text-slate-400 hover:text-red-500 transition-colors">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Info -->
            <div class="p-6 text-white shadow-xl border border-indigo-500/30" style="background-color: #5c57a3ff; border-radius: 2rem !important;">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white">
                        <i class="ri-timer-line text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white uppercase tracking-widest">Sistem Antrean</p>
                        <p class="text-[10px] text-indigo-100">Menggunakan Laravel Queue</p>
                    </div>
                </div>
                <p class="text-xs leading-relaxed text-white/90">
                    Email tidak dikirim langsung saat Anda klik tombol. Email dimasukkan ke antrean agar aplikasi tetap cepat. Status akan berubah menjadi <b>Terkirim</b> setelah diproses oleh server.
                </p>
            </div>
        </div>
    </div>
</main>
