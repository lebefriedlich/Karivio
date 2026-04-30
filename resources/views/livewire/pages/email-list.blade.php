<main class="p-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">📧 Riwayat Pengiriman Email</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Pantau semua lamaran yang telah Anda kirim via Gmail.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('send-email', ['type' => 'compose', 'id' => 'new']) }}" class="btn bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg shadow-indigo-600/20 px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-mail-add-line text-lg"></i> Tulis Email Baru
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm" style="border-radius: 2rem !important;">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                    <i class="ri-mail-line text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Terkirim</p>
                    <p class="text-2xl font-black text-slate-900 dark:text-white">{{ \App\Models\EmailLog::where('user_id', auth()->id())->where('status', 'sent')->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm" style="border-radius: 2rem !important;">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 dark:text-amber-400">
                    <i class="ri-time-line text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Dalam Antrean</p>
                    <p class="text-2xl font-black text-slate-900 dark:text-white">{{ \App\Models\EmailLog::where('user_id', auth()->id())->where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm" style="border-radius: 2rem !important;">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-red-50 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400">
                    <i class="ri-error-warning-line text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Gagal</p>
                    <p class="text-2xl font-black text-slate-900 dark:text-white">{{ \App\Models\EmailLog::where('user_id', auth()->id())->where('status', 'failed')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50">
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Waktu Pengiriman</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Penerima</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Subjek</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Lampiran</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Status</th>
                        <th class="p-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($emailLogs as $log)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors">
                            <td class="p-4">
                                <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $log->created_at->format('d M Y') }}</p>
                                <p class="text-[10px] text-slate-500">{{ $log->created_at->format('H:i') }} WIB</p>
                            </td>
                            <td class="p-4">
                                <p class="text-sm font-semibold">{{ $log->to }}</p>
                            </td>
                            <td class="p-4">
                                <p class="text-sm text-slate-600 dark:text-slate-400 truncate max-w-[200px]" title="{{ $log->subject }}">
                                    {{ $log->subject }}
                                </p>
                            </td>
                            <td class="p-4">
                                <div class="flex -space-x-1">
                                    @foreach($log->attachments as $att)
                                        <div class="w-7 h-7 rounded-lg bg-red-50 border-2 border-white dark:border-slate-800 flex items-center justify-center text-red-600 shadow-sm" title="{{ $att['name'] }}">
                                            <i class="ri-file-pdf-fill text-sm"></i>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                @if($log->status === 'sent')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Terkirim
                                    </span>
                                @elseif($log->status === 'failed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-100 text-red-700 text-[10px] font-bold uppercase tracking-wider" title="{{ $log->error_message }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Gagal
                                    </span>
                                @else
                                    @if($log->scheduled_at && $log->scheduled_at->isFuture())
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-[10px] font-bold uppercase tracking-wider" title="Dijadwalkan pada {{ $log->scheduled_at->format('d M Y H:i') }}">
                                            <i class="ri-time-line text-amber-500"></i> Terjadwal
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-[10px] font-bold uppercase tracking-wider animate-pulse">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Antrean
                                        </span>
                                    @endif
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @if($log->status === 'failed')
                                    <button wire:click="retry('{{ $log->id }}')" class="btn btn-sm" style="background-color: #2563eb; color: #ffffff; border: none; font-size: 10px; padding: 4px 10px; border-radius: 6px; font-weight: bold; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                        <i class="ri-refresh-line" style="margin-right: 8px;"></i> Kirim Ulang
                                    </button>
                                @elseif($log->status === 'pending')
                                    <button wire:click="cancel('{{ $log->id }}')" class="btn btn-sm" style="background-color: #dc2626; color: #ffffff; border: none; font-size: 10px; padding: 4px 10px; border-radius: 6px; font-weight: bold; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                        <i class="ri-close-circle-line" style="margin-right: 8px;"></i> Batalkan
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-slate-50 dark:bg-slate-900 rounded-full flex items-center justify-center text-slate-300 mb-4">
                                        <i class="ri-mail-open-line text-4xl"></i>
                                    </div>
                                    <p class="text-slate-500 font-medium">Belum ada riwayat email.</p>
                                    <p class="text-slate-400 text-xs mt-1">Mulai kirim lamaran Anda sekarang!</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($emailLogs->hasPages())
            <div class="p-4 border-t border-slate-100 dark:border-slate-700">
                {{ $emailLogs->links() }}
            </div>
        @endif
    </div>
</main>
