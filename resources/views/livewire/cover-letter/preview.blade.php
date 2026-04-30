<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen">
    <!-- Header dengan Aksi Utama -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Preview Cover Letter</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1 font-medium">{{ $coverLetter->company_name }}</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('cover-letter.list') }}" style="padding: 10px 20px; border-radius: 12px; font-weight: 700; text-decoration: none; display: flex; align-items: center; font-size: 14px;" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                <i class="ri-arrow-left-line" style="margin-right: 6px;"></i> KEMBALI
            </a>
            <a href="{{ route('cover-letter.form', $coverLetter->id) }}" style="background-color: #2563eb; padding: 10px 20px; color: white; border-radius: 12px; font-weight: 700; text-decoration: none; display: flex; align-items: center; font-size: 14px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all">
                <i class="ri-edit-line" style="margin-right: 6px;"></i> EDIT DATA
            </a>
            <button wire:click="exportPdf" style="background-color: #dc2626; padding: 10px 20px; color: white; border-radius: 12px; font-weight: 700; border: none; display: flex; align-items: center; font-size: 14px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); cursor: pointer;" class="hover:opacity-90 transition-all">
                <i class="ri-file-pdf-line" style="margin-right: 6px;"></i> EXPORT PDF
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main Content (Cover Letter Paper) -->
        <div class="lg:col-span-2 flex justify-center">
            <div class="bg-white dark:bg-gray-900 shadow-2xl border border-gray-100 dark:border-gray-800 ring-1 ring-gray-200/50 dark:ring-white/5 dark:text-gray-200" 
                 style="width: 210mm; min-height: 297mm; padding: 1.27cm 1cm 1.27cm 1.27cm; box-sizing: border-box; font-family: 'Times New Roman', serif; font-size: 12pt; line-height: 1.15; border-radius: 4px; position: relative; background-image: linear-gradient(to bottom, transparent 297mm, #e5e7eb 297mm, #e5e7eb 297.5mm, transparent 297.5mm); background-size: 100% 297.5mm;">
                <!-- Header -->
                <div style="text-align: right; margin-bottom: 30pt;">
                    <div style="font-weight: bold; font-size: 12pt; text-transform: capitalize;" class="text-gray-900 dark:text-white">{{ $coverLetter->full_name }}</div>
                    <div>{{ $coverLetter->phone }}</div>
                    <div class="text-blue-600 dark:text-blue-400 underline">{{ $coverLetter->email }}</div>
                </div>

                <!-- Date -->
                <div style="margin-bottom: 20pt;">
                    {{ $coverLetter->city }}, {{ \Carbon\Carbon::parse($coverLetter->date)->translatedFormat('d F Y') }}
                </div>

                <!-- Recipient -->
                <div style="margin-bottom: 20pt;">
                    Kepada Yth.<br>
                    Tim Rekrutmen<br>
                    <span style="font-weight: bold;">{{ $coverLetter->company_name }}</span><br>
                    {{ $coverLetter->company_address }}
                </div>

                <!-- Content -->
                <div class="text-justify">
                    @php
                        $bodyText = str_replace('Dengan hormat,', '<div style="text-align: left; margin-bottom: 10pt;">Dengan hormat,</div>', $processedContent);
                        $paragraphs = explode("\n", $bodyText);
                        foreach($paragraphs as $p) {
                            $p = trim($p);
                            if (!empty($p)) {
                                if (strpos($p, '<div') !== false) {
                                    echo $p;
                                } else {
                                    echo '<p style="margin: 0 0 10pt 0;">' . $p . '</p>';
                                }
                            }
                        }
                    @endphp
                </div>

                <!-- Signature -->
                <div style="margin-top: 40pt;">
                    Hormat Saya,<br><br><br><br>
                    <strong>{{ $coverLetter->full_name }}</strong>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="lg:col-span-1">
            <div class="sticky top-6 space-y-6">
                <!-- Aksi Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden" style="border-radius: 2rem !important;">
                    <div class="p-6 bg-gray-50/50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="font-black text-gray-900 dark:text-white flex items-center gap-2">
                            <i class="ri-flashlight-line text-primary"></i> AKSI CEPAT
                        </h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <button wire:click="exportPdf" style="background-color: #dc2626; padding: 12px 20px; color: white; border-radius: 12px; font-weight: 700; border: none; display: flex; align-items: center; justify-content: center; width: 100%; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all text-center">
                            <i class="ri-file-pdf-line" style="margin-right: 8px;"></i> EXPORT PDF
                        </button>
                        <a href="{{ route('cover-letter.form', $coverLetter->id) }}" style="background-color: #2563eb; padding: 12px 20px; color: white; border-radius: 12px; font-weight: 700; text-decoration: none; display: flex; align-items: center; justify-content: center; width: 100%; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all text-center">
                            <i class="ri-edit-line" style="margin-right: 8px;"></i> EDIT DATA
                        </a>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-primary rounded-2xl shadow-lg p-6 text-white" style="border-radius: 2rem !important;">
                    <h3 class="font-black mb-4 flex items-center gap-2">
                        <i class="ri-building-line"></i> INFO LAMARAN
                    </h3>
                    <div class="space-y-3 text-sm font-medium">
                        <div class="flex flex-col opacity-90 border-b border-white/20 pb-2">
                            <span class="text-xs opacity-75 mb-1">Posisi</span>
                            <span class="font-bold">{{ $coverLetter->applied_position }}</span>
                        </div>
                        <div class="flex flex-col opacity-90 border-b border-white/20 pb-2">
                            <span class="text-xs opacity-75 mb-1">Perusahaan</span>
                            <span class="font-bold">{{ $coverLetter->company_name }}</span>
                        </div>
                        <div class="flex flex-col opacity-90 pb-1">
                            <span class="text-xs opacity-75 mb-1">Tanggal Buat</span>
                            <span class="font-bold">{{ \Carbon\Carbon::parse($coverLetter->created_at)->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
