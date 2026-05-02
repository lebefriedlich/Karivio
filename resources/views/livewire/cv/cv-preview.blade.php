<main class="p-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen">
    @php
        $formatDate = function($date) {
            if (!$date) return '';
            if (strtolower($date) == 'sekarang' || strtolower($date) == 'present') return 'Sekarang';
            
            $months = [
                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
            ];

            try {
                $dt = \Carbon\Carbon::parse($date);
                $m = $dt->format('m');
                $y = $dt->format('Y');
                return ($months[$m] ?? $dt->format('F')) . ' ' . $y;
            } catch (\Exception $e) {
                return $date;
            }
        };
    @endphp
    <!-- Header dengan Aksi Utama -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">
                Preview CV - {{ $cv->full_name }}
            </h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Lihat hasil akhir CV Anda sebelum didownload atau dibagikan</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('cv.list') }}" class="btn bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg shadow-indigo-600/20 px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-arrow-left-line text-lg"></i> Kembali
            </a>
            <a href="{{ route('cv.form', $cv->id) }}" class="btn bg-primary text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-edit-line text-lg"></i> Edit Data
            </a>
            <button wire:click="exportPdf" class="btn px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all" style="background-color: #dc2626; padding: 10px 20px; color: white; border-radius: 12px; font-weight: 700; border: none; display: flex; align-items: center; font-size: 14px; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all">
                <i class="ri-file-pdf-line text-lg"></i> Export PDF
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main Content (CV Paper) -->
        <div class="lg:col-span-2 flex justify-center">
            <div class="bg-white dark:bg-gray-900 shadow-2xl border border-gray-100 dark:border-gray-800 ring-1 ring-gray-200/50 dark:ring-white/5 dark:text-gray-200" 
                 style="width: 210mm; min-height: 297mm; padding: 1.27cm 1cm 1.27cm 1.27cm; box-sizing: border-box; font-family: 'Times New Roman', Times, serif; font-size: 11pt; line-height: 1.2; border-radius: 4px; position: relative; background-image: linear-gradient(to bottom, transparent 297mm, #e5e7eb 297mm, #e5e7eb 297.5mm, transparent 297.5mm); background-size: 100% 297.5mm;">
                <div style="width: 100%;">
                    <!-- Header (Centered like PDF) -->
                    <div class="text-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white uppercase tracking-tight mb-1">{{ $cv->full_name }}</h1>
                        <div class="text-[10pt] text-gray-700 dark:text-gray-300">
                            {{ $cv->phone }} | 
                            <a href="mailto:{{ $cv->email }}" class="text-blue-600 dark:text-blue-400 underline font-medium">{{ $cv->email }}</a> | 
                            @if ($cv->linkedin_url)
                                <a href="{{ $cv->linkedin_url }}" class="text-blue-600 dark:text-blue-400 underline font-medium">Linkedin Profil</a> | 
                            @endif
                            @if ($cv->portfolio_url)
                                <a href="{{ $cv->portfolio_url }}" class="text-blue-600 dark:text-blue-400 underline font-medium">Portofolio</a> | 
                            @endif
                            {{ $cv->location }}
                        </div>
                    </div>

                    <!-- Profil -->
                    @if ($cv->professional_summary)
                        <section class="mb-5">
                            <h2 class="text-[11pt] font-bold text-gray-900 dark:text-gray-100 uppercase border-b border-gray-900 dark:border-gray-700 mb-2 w-full">Profil</h2>
                            <p class="text-gray-700 dark:text-gray-300 text-justify leading-relaxed">{{ $cv->professional_summary }}</p>
                        </section>
                    @endif

                    <!-- Pendidikan -->
                    @if ($cv->education && count($cv->education) > 0)
                        <section class="mb-5">
                            <h2 class="text-[11pt] font-bold text-gray-900 dark:text-gray-100 uppercase border-b border-gray-900 dark:border-gray-700 mb-2 w-full">Pendidikan</h2>
                            @foreach ($cv->education as $edu)
                                <div class="mb-3">
                                    <div class="flex justify-between font-bold text-gray-900 dark:text-gray-100">
                                        <span>{{ $edu['institution'] ?? '' }}</span>
                                        <span>{{ $formatDate($edu['start_date'] ?? '') }} – {{ ($edu['is_current'] ?? false) ? 'Sekarang' : $formatDate($edu['end_date'] ?? '') }}</span>
                                    </div>
                                    <div class="flex justify-between italic text-gray-700 dark:text-gray-300">
                                        <span>{{ $edu['major'] ?? '' }}</span>
                                        <span>@if(!empty($edu['score'])) (IPK: {{ $edu['score'] }}) @endif</span>
                                    </div>
                                </div>
                            @endforeach
                        </section>
                    @endif

                    <!-- Pengalaman Profesional -->
                    @if ($cv->work_experiences && count($cv->work_experiences) > 0)
                        <section class="mb-5">
                            <h2 class="text-[11pt] font-bold text-gray-900 dark:text-gray-100 uppercase border-b border-gray-900 dark:border-gray-700 mb-2 w-full">Pengalaman Profesional</h2>
                            @foreach ($cv->work_experiences as $work)
                                <div class="mb-3">
                                    <div class="flex justify-between font-bold text-gray-900 dark:text-gray-100 uppercase">
                                        <span>{{ $work['company'] }}</span>
                                        <span>{{ $formatDate($work['start_date']) }} – {{ ($work['is_current'] ?? false) ? 'Sekarang' : $formatDate($work['end_date'] ?? '') }}</span>
                                    </div>
                                    <div class="italic text-gray-700 dark:text-gray-300 mb-1">{{ $work['position'] }}</div>
                                    @if ($work['description'])
                                        <ul class="list-disc text-gray-700 dark:text-gray-300 text-[10pt] space-y-0.5" style="list-style-type: disc !important; margin-left: 15px !important;">
                                            @foreach(explode("\n", str_replace("\r", "", $work['description'])) as $line)
                                                @if(trim($line))
                                                    <li>{{ ltrim(trim($line), '- ') }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </section>
                    @endif

                    <!-- Pengalaman Asistensi -->
                    @if ($cv->assistance_experiences && count($cv->assistance_experiences) > 0)
                        <section class="mb-5">
                            <h2 class="text-[11pt] font-bold text-gray-900 dark:text-gray-100 uppercase border-b border-gray-900 dark:border-gray-700 mb-2 w-full">Pengalaman Asistensi</h2>
                            @foreach ($cv->assistance_experiences as $ast)
                                <div class="mb-3">
                                    <div class="flex justify-between font-bold text-gray-900 dark:text-gray-100 uppercase">
                                        <span>{{ $ast['role'] }}</span>
                                        <span>{{ $formatDate($ast['start_date']) }} – {{ ($ast['is_current'] ?? false) ? 'Sekarang' : $formatDate($ast['end_date'] ?? '') }}</span>
                                    </div>
                                    <div class="italic text-gray-700 dark:text-gray-300 mb-1">{{ $ast['location'] }}</div>
                                    @if ($ast['description'])
                                        <ul class="list-disc text-gray-700 dark:text-gray-300 text-[10pt] space-y-0.5" style="list-style-type: disc !important; margin-left: 15px !important;">
                                            @foreach(explode("\n", str_replace("\r", "", $ast['description'])) as $line)
                                                @if(trim($line))
                                                    <li>{{ ltrim(trim($line), '- ') }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </section>
                    @endif

                    <!-- Pengalaman Organisasi -->
                    @if ($cv->organization_experiences && count($cv->organization_experiences) > 0)
                        <section class="mb-5">
                            <h2 class="text-[11pt] font-bold text-gray-900 dark:text-gray-100 uppercase border-b border-gray-900 dark:border-gray-700 mb-2 w-full">Pengalaman Organisasi</h2>
                            @foreach ($cv->organization_experiences as $org)
                                <div class="mb-3">
                                    <div class="flex justify-between font-bold text-gray-900 dark:text-gray-100 uppercase">
                                        <span>{{ $org['role'] }}</span>
                                        <span>{{ $formatDate($org['start_date']) }} – {{ ($org['is_current'] ?? false) ? 'Sekarang' : $formatDate($org['end_date'] ?? '') }}</span>
                                    </div>
                                    <div class="italic text-gray-700 dark:text-gray-300 mb-1">{{ $org['organization'] }}</div>
                                    @if (!empty($org['description']))
                                        <ul class="list-disc text-gray-700 dark:text-gray-300 text-[10pt] space-y-0.5" style="list-style-type: disc !important; margin-left: 15px !important;">
                                            @foreach(explode("\n", str_replace("\r", "", $org['description'])) as $line)
                                                @if(trim($line))
                                                    <li>{{ ltrim(trim($line), '- ') }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </section>
                    @endif

                    <!-- Skills & Languages -->
                    @php
                        $techSkills = $cv->technical_skills ?? [];
                        $softSkills = $cv->soft_skills ?? [];
                        $hasSkills = count($techSkills) > 0 || count($softSkills) > 0 || ($cv->languages && count($cv->languages) > 0);
                    @endphp

                    @if ($hasSkills)
                        <section class="mb-5">
                            <h2 class="text-[11pt] font-bold text-gray-900 dark:text-gray-100 uppercase border-b border-gray-900 dark:border-gray-700 mb-2 w-full">Skills</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    @if (count($techSkills) > 0)
                                        <div class="font-bold uppercase mb-1 text-[10pt] text-gray-900 dark:text-white">Hard Skill</div>
                                        <ul class="list-disc text-gray-700 dark:text-gray-300 text-sm space-y-0.5" style="list-style-type: disc !important; margin-left: 15px !important;">
                                            @foreach ($techSkills as $skill)
                                                <li>
                                                    @if(is_array($skill))
                                                        <span class="font-bold text-gray-900 dark:text-white">{{ $skill['category'] ?? 'Skill' }}:</span> {{ $skill['skills'] ?? '' }}
                                                    @else
                                                        {{ $skill }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div>
                                    @if (count($softSkills) > 0)
                                        <div class="font-bold uppercase mb-1 text-[10pt] text-gray-900 dark:text-white">Soft Skill</div>
                                        <ul class="list-disc text-gray-700 dark:text-gray-300 text-sm space-y-0.5" style="list-style-type: disc !important; margin-left: 15px !important;">
                                            @foreach ($softSkills as $skill)
                                                <li>{{ $skill }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if ($cv->languages && count($cv->languages) > 0)
                                        <div class="font-bold uppercase mt-3 mb-1 text-[10pt] text-gray-900 dark:text-white">Bahasa</div>
                                        <ul class="list-disc text-gray-700 dark:text-gray-300 text-sm space-y-0.5" style="list-style-type: disc !important; margin-left: 15px !important;">
                                            @foreach ($cv->languages as $lang)
                                                <li>{{ $lang['language'] }} ({{ $lang['proficiency'] }})</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </section>
                    @endif
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
                        <button wire:click="exportPdf" style="background-color: #dc2626; padding: 12px 20px; color: white; border-radius: 12px; font-weight: 700; border: none; display: flex; align-items: center; justify-content: center; width: 100%; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all">
                            <i class="ri-file-pdf-line" style="margin-right: 8px;"></i> EXPORT PDF
                        </button>
                        <a href="{{ route('cv.form', $cv->id) }}" style="background-color: #2563eb; padding: 12px 20px; color: white; border-radius: 12px; font-weight: 700; text-decoration: none; display: flex; align-items: center; justify-content: center; width: 100%; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all">
                            <i class="ri-edit-line" style="margin-right: 8px;"></i> EDIT DATA CV
                        </a>
                    </div>
                </div>

                <!-- Statistik -->
                <div class="bg-primary rounded-2xl shadow-lg p-6 text-white" style="border-radius: 2rem !important;">
                    <h3 class="font-black mb-4 flex items-center gap-2">
                        <i class="ri-bar-chart-box-line"></i> RINGKASAN DATA
                    </h3>
                    <div class="space-y-3 text-sm font-medium">
                        <div class="flex justify-between items-center opacity-90">
                            <span>Pengalaman</span>
                            <span class="bg-white/20 px-2 py-0.5 rounded">{{ count($cv->work_experiences ?? []) }}</span>
                        </div>
                        <div class="flex justify-between items-center opacity-90">
                            <span>Hard Skill</span>
                            <span class="bg-white/20 px-2 py-0.5 rounded">{{ count($cv->technical_skills ?? []) }}</span>
                        </div>
                        <div class="flex justify-between items-center opacity-90">
                            <span>Bahasa</span>
                            <span class="bg-white/20 px-2 py-0.5 rounded">{{ count($cv->languages ?? []) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
