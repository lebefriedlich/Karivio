<main class="p-6">
    @php
        $monthsId = [
            '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
            '05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Agu',
            '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des'
        ];
        $monthsEn = [
            '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
            '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug',
            '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'
        ];

        $f = function($d) use ($monthsId, $monthsEn, $language) {
            if(!$d) return '';
            try {
                $dt = \Carbon\Carbon::parse($d);
                $months = $language === 'en' ? $monthsEn : $monthsId;
                return ($months[$dt->format('m')] ?? $dt->format('M')) . ' ' . $dt->format('Y');
            } catch(\Exception $e) { return $d; }
        };
    @endphp
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">
                @if ($cv && $cv->exists)
                    {{ __('Edit CV') }} - {{ $cv->full_name }}
                @else
                    {{ __('Buat CV') }}
                @endif
            </h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">{{ __('Isi data pribadi dan profesional Anda') }}</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('cv.list') }}" class="btn bg-secondary text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-arrow-left-line text-lg"></i> {{ __('Kembali') }}
            </a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6" >
        <div class="{{ $cvId ? 'col-span-12 lg:col-span-8' : 'col-span-12' }}">
            <div class="card bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 shadow-sm" style="border-radius: 2rem !important;">
                <div class="card-header border-b border-slate-100 dark:border-slate-700">
                    <h4 class="card-title text-slate-900 dark:text-slate-200">{{ __('Form Data CV') }}</h4>
                </div>

                <div class="p-6">


                    <form wire:submit="saveCv" class="space-y-12">
                        <!-- Language Selection -->
                        <div class="bg-primary/5 p-6 rounded-2xl border border-primary/10 mb-8">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div>
                                    <h5 class="text-lg font-bold text-primary">{{ __('Bahasa CV / CV Language') }}</h5>
                                    <p class="text-sm text-slate-500">{{ __('Pilih bahasa untuk label dan format tanggal') }} / Choose language for labels and dates</p>
                                </div>
                                <div class="w-full md:w-64">
                                    <select wire:model.live="language" class="w-full px-4 py-3 border border-primary/20 bg-white dark:bg-slate-900 dark:text-white rounded-xl focus:ring-2 focus:ring-primary font-bold">
                                        <option value="id">{{ __('Bahasa Indonesia') }}</option>
                                        <option value="en">English</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- 1. Identitas Diri -->
                        <div>
                            <div class="flex items-center gap-2 mb-6">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">1</span>
                                <h5 class="text-xl font-bold">{{ __('Identitas Diri') }}</h5>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Nama Lengkap') }}</label>
                                    <input type="text" wire:model="full_name" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="{{ __('Nama Lengkap') }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Nomor Telepon') }}</label>
                                    <input type="tel" wire:model="phone" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="{{ __('0812...') }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Email') }}</label>
                                    <input type="email" wire:model="email" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="{{ __('email@contoh.com') }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Domisili (Kota/Kabupaten)') }}</label>
                                    <input type="text" wire:model="location" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="{{ __('Contoh: Jakarta Selatan') }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('URL LinkedIn') }}</label>
                                    <input type="url" wire:model="linkedin_url" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://linkedin.com/in/username">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('URL Portofolio / Website') }}</label>
                                    <input type="url" wire:model="portfolio_url" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://portofolio.com">
                                </div>
                            </div>
                        </div>

                        <!-- 2. Profil -->
                        <div>
                            <div class="flex items-center gap-2 mb-6">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">2</span>
                                <h5 class="text-xl font-bold text-slate-900 dark:text-slate-200">{{ __('Tentang Saya / Ringkasan Profesional') }}</h5>
                            </div>
                            <div>
                                <textarea wire:model="professional_summary" rows="5" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="{{ __('Ceritakan singkat tentang pengalaman dan keahlian Anda...') }}"></textarea>
                            </div>
                        </div>

                        <!-- 3. Pendidikan -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">3</span>
                                <h5 class="text-xl font-bold">{{ __('Pendidikan') }}</h5>
                            </div>
                            <p class="text-sm text-gray-500 mb-6">{{ __('Urutkan dari yang terbaru.') }}</p>
                            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700 mb-6">
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Instansi Pendidikan') }}</label>
                                        <input type="text" wire:model="current_education.institution" placeholder="{{ __('Contoh: Universitas Gadjah Mada') }}" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Jurusan / Program Studi') }}</label>
                                        <input type="text" wire:model="current_education.major" placeholder="{{ __('Contoh: Teknik Informatika') }}" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Nilai (IPK/Akhir)') }}</label>
                                        <input type="text" wire:model="current_education.score" placeholder="{{ __('Contoh: 3.80 / 4.00') }}" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Mulai') }}</label>
                                        <input type="month" wire:model="current_education.start_date" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                         <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Selesai') }}</label>
                                         <input type="month" wire:model="current_education.end_date" @if($current_education['is_current'] ?? false) disabled @endif class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm disabled:opacity-50">
                                         <div class="mt-1 flex items-center gap-1">
                                             <input type="checkbox" wire:model.live="current_education.is_current" id="edu_current" class="rounded border-gray-300">
                                             <label for="edu_current" class="text-xs text-gray-500">{{ $language === 'en' ? 'Present' : __('Masih Berjalan (Sekarang)') }}</label>
                                         </div>
                                     </div>
                                </div>
                                <button type="button" wire:click="addEducation" wire:loading.attr="disabled" class="w-full py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition disabled:opacity-75">
                                    <span wire:loading.remove wire:target="addEducation">+ {{ __('Tambah Pendidikan') }}</span>
                                    <span wire:loading wire:target="addEducation">{{ __('Memproses...') }}</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                @foreach ($education as $index => $edu)
                                    <div class="border border-gray-200 dark:border-gray-900 rounded-lg p-4 flex justify-between items-center group hover:border-primary transition">
                                        <div>
                                            <h6 class="font-bold text-gray-800 dark:text-slate-200">{{ $edu['institution'] }}</h6>
                                            <p class="text-sm text-gray-600 dark:text-slate-400">{{ $edu['major'] }} • {{ $edu['score'] }}</p>
                                            <p class="text-xs text-gray-400 dark:text-slate-500">{{ $f($edu['start_date']) }} - {{ ($edu['is_current'] ?? false) ? ($language === 'en' ? 'Present' : 'Sekarang') : $f($edu['end_date'] ?? '') }}</p>
                                        </div>
                                        <div class="flex gap-1">
                                            <button type="button" wire:click="editEducation({{ $index }})" class="w-8 h-8 flex items-center justify-center rounded-full text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20" title="Edit">
                                                <i class="ri-edit-line"></i>
                                            </button>
                                            <button type="button" wire:click="removeEducation({{ $index }})" class="w-8 h-8 flex items-center justify-center rounded-full text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20" title="Hapus">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- 4. Pengalaman Profesional -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">4</span>
                                <h5 class="text-xl font-bold text-slate-900 dark:text-slate-200">{{ __('Pengalaman Profesional') }}</h5>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700 mb-6">
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Perusahaan / Organisasi') }}</label>
                                        <input type="text" wire:model="current_work.company" placeholder="{{ __('Nama Perusahaan') }}" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Posisi / Jabatan') }}</label>
                                        <input type="text" wire:model="current_work.position" placeholder="{{ __('Contoh: Backend Developer') }}" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Mulai') }}</label>
                                        <input type="month" wire:model="current_work.start_date" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                         <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Selesai') }}</label>
                                         <input type="month" wire:model="current_work.end_date" @if($current_work['is_current'] ?? false) disabled @endif class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm disabled:opacity-50">
                                         <div class="mt-1 flex items-center gap-1">
                                             <input type="checkbox" wire:model.live="current_work.is_current" id="work_current" class="rounded border-gray-300">
                                             <label for="work_current" class="text-xs text-gray-500">{{ $language === 'en' ? 'Present' : __('Masih Bekerja (Sekarang)') }}</label>
                                         </div>
                                     </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Deskripsi Pekerjaan') }}</label>
                                        <textarea wire:model="current_work.description" placeholder="{{ __('Apa yang Anda kerjakan? Gunakan poin-poin jika perlu.') }}" rows="3" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm"></textarea>
                                    </div>
                                </div>
                                <button type="button" wire:click="addWorkExperience" wire:loading.attr="disabled" class="w-full py-2 bg-primary text-white rounded-lg font-semibold transition disabled:opacity-75">
                                    <span wire:loading.remove wire:target="addWorkExperience">+ {{ __('Tambah Pengalaman Kerja') }}</span>
                                    <span wire:loading wire:target="addWorkExperience">{{ __('Memproses...') }}</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                @foreach ($work_experiences as $index => $work)
                                    <div class="border border-gray-200 dark:border-gray-900 rounded-lg p-4 flex justify-between items-start group hover:border-primary transition">
                                        <div class="flex-1">
                                            <h6 class="font-bold text-gray-800 dark:text-slate-200">{{ $work['position'] }} di {{ $work['company'] }}</h6>
                                            <p class="text-xs text-gray-400 dark:text-slate-500 mb-2">
                                                {{ $f($work['start_date']) }} - {{ ($work['is_current'] ?? false) ? ($language === 'en' ? 'Present' : 'Sekarang') : $f($work['end_date'] ?? '') }}
                                            </p>
                                            <ul class="list-disc ml-5 text-sm text-gray-600 dark:text-slate-400 space-y-1">
                                                @foreach(explode("\n", $work['description']) as $line)
                                                    @if(trim($line)) <li>{{ trim($line, "- ") }}</li> @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="ml-4 flex gap-1">
                                            <button type="button" wire:click="editWorkExperience({{ $index }})" class="w-8 h-8 flex items-center justify-center rounded-full text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20" title="Edit">
                                                <i class="ri-edit-line"></i>
                                            </button>
                                            <button type="button" wire:click="removeWorkExperience({{ $index }})" class="w-8 h-8 flex items-center justify-center rounded-full text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20" title="Hapus">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- 5. Pengalaman Organisasi -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">5</span>
                                <h5 class="text-xl font-bold text-slate-900 dark:text-slate-200">{{ __('Pengalaman Organisasi') }}</h5>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700 mb-6">
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Nama Organisasi') }}</label>
                                        <input type="text" wire:model="current_org.organization" placeholder="{{ __('Nama Organisasi') }}" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Jabatan') }}</label>
                                        <input type="text" wire:model="current_org.role" placeholder="{{ __('Jabatan') }}" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Mulai') }}</label>
                                        <input type="month" wire:model="current_org.start_date" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div>
                                         <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Selesai') }}</label>
                                         <input type="month" wire:model="current_org.end_date" @if($current_org['is_current'] ?? false) disabled @endif class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm disabled:opacity-50">
                                         <div class="mt-1 flex items-center gap-1">
                                             <input type="checkbox" wire:model.live="current_org.is_current" id="org_current" class="rounded border-gray-300">
                                             <label for="org_current" class="text-xs text-gray-500">{{ $language === 'en' ? 'Present' : __('Masih Berjalan (Sekarang)') }}</label>
                                         </div>
                                     </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Deskripsi Kegiatan') }}</label>
                                        <textarea wire:model="current_org.description" placeholder="{{ __('Deskripsi Kegiatan') }}" rows="3" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg"></textarea>
                                    </div>
                                </div>
                                <button type="button" wire:click="addOrganization" wire:loading.attr="disabled" class="w-full py-2 bg-primary text-white rounded-lg font-semibold transition disabled:opacity-75">
                                    <span wire:loading.remove wire:target="addOrganization">+ {{ __('Tambah Pengalaman Organisasi') }}</span>
                                    <span wire:loading wire:target="addOrganization">{{ __('Memproses...') }}</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                @foreach ($organization_experiences as $index => $org)
                                    <div class="border border-gray-200 dark:border-gray-900 rounded-lg p-4 flex justify-between items-start group hover:border-primary transition">
                                        <div class="flex-1">
                                            <h6 class="font-bold text-gray-800 dark:text-slate-200">{{ $org['role'] }} - {{ $org['organization'] }}</h6>
                                            <p class="text-xs text-gray-400 dark:text-slate-500 mb-2">{{ $f($org['start_date']) }} - {{ ($org['is_current'] ?? false) ? ($language === 'en' ? 'Present' : 'Sekarang') : $f($org['end_date'] ?? '') }}</p>
                                            <ul class="list-disc ml-5 text-sm text-gray-600 dark:text-slate-400 space-y-1">
                                                @foreach(explode("\n", $org['description']) as $line)
                                                    @if(trim($line)) <li>{{ trim($line, "- ") }}</li> @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="ml-4 flex gap-1">
                                            <button type="button" wire:click="editOrganization({{ $index }})" class="w-8 h-8 flex items-center justify-center rounded-full text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20" title="Edit">
                                                <i class="ri-edit-line"></i>
                                            </button>
                                            <button type="button" wire:click="removeOrganization({{ $index }})" class="w-8 h-8 flex items-center justify-center rounded-full text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20" title="Hapus">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- 6. Pengalaman Asistensi (Commented Out) -->
                        {{-- 
                        <div>
                            ... (Assistance Experience Content) ...
                        </div>
                        --}}

                        <!-- 7. Skill (Hard & Soft) -->
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">7</span>
                                <h5 class="text-xl font-bold">{{ __('Keahlian (Skill)') }}</h5>
                            </div>

                            <div class="grid md:grid-cols-2 gap-5">
                                <!-- Hard Skills -->
                                <div>
                                    <h6 class="font-bold text-gray-700 dark:text-white mb-3">{{ __('Hard Skill (Per Kategori)') }}</h6>
                                    <p class="text-xs text-gray-500 dark:text-slate-400 mb-4 italic">{{ __('Contoh: Bahasa Pemrograman : PHP, JS, Go') }}</p>
                                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800 mb-4">
                                        <div class="space-y-3 mb-3">
                                            <input type="text" wire:model="current_hard_skill.category" placeholder="{{ __('Kategori (Misal: Bahasa Pemrograman)') }}" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                            <textarea wire:model="current_hard_skill.skills" placeholder="{{ __('Isi Skill (Misal: PHP, JavaScript, Go)') }}" rows="2" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm"></textarea>
                                        </div>
                                        <button type="button" wire:click="addHardSkill" wire:loading.attr="disabled" style="background-color: #2563eb; color: white; padding: 6px 12px; border-radius: 8px; font-size: 0.875rem; font-weight: 600; border: none; width: 100%; cursor: pointer;" class="disabled:opacity-75">
                                            <span wire:loading.remove wire:target="addHardSkill">+ {{ __('Tambah Kategori') }}</span>
                                            <span wire:loading wire:target="addHardSkill">...</span>
                                        </button>
                                    </div>
                                    <div class="space-y-2">
                                        @foreach ($hard_skills as $index => $skill)
                                            <div class="flex justify-between items-center p-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-slate-700 rounded-lg text-sm">
                                                <span class="flex-1 dark:text-slate-300"><strong class="dark:text-white">{{ $skill['category'] }}</strong>: {{ $skill['skills'] }}</span>
                                                <div class="flex gap-1">
                                                    <button type="button" wire:click="editHardSkill({{ $index }})" class="text-blue-500" title="Edit">
                                                        <i class="ri-edit-line text-lg"></i>
                                                    </button>
                                                    <button type="button" wire:click="removeHardSkill({{ $index }})" class="text-red-500" title="Hapus">
                                                        <i class="ri-close-line text-lg"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Soft Skills -->
                                <div>
                                    <h6 class="font-bold text-gray-700 dark:text-white mb-3">{{ __('Soft Skill') }}</h6>
                                    <div class="flex gap-2 mb-4">
                                        <input type="text" wire:model="current_soft_skill" placeholder="{{ __('Misal: Leadership') }}" class="flex-1 px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                        <button type="button" wire:click="addSoftSkill" wire:loading.attr="disabled" style="background-color: #4f46e5; color: white; padding: 8px 16px; border-radius: 8px; font-size: 0.875rem; border: none; cursor: pointer;" class="disabled:opacity-75">
                                            <span wire:loading.remove wire:target="addSoftSkill">{{ __('Tambah') }}</span>
                                            <span wire:loading wire:target="addSoftSkill">...</span>
                                        </button>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($soft_skills as $index => $skill)
                                            <span class="inline-flex items-center gap-1.5 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300 px-3 py-1 rounded-full text-xs font-semibold border border-indigo-100 dark:border-indigo-800">
                                                {{ $skill }}
                                                <button type="button" wire:click="removeSoftSkill({{ $index }})" class="hover:text-indigo-900 dark:hover:text-white">
                                                    <i class="ri-close-line"></i>
                                                </button>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 8. Bahasa -->
                        <div>
                            <div class="flex items-center gap-2 mb-6">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">8</span>
                                <h5 class="text-xl font-bold">{{ __('Kemampuan Bahasa') }}</h5>
                            </div>
                            <div class="grid md:grid-cols-2 gap-4 bg-gray-50 dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700 mb-6">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Bahasa') }}</label>
                                    <input type="text" wire:model="current_language.language" placeholder="{{ __('Misal: Indonesia') }}" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">{{ __('Tingkat Kemampuan') }}</label>
                                    <select wire:model="current_language.proficiency" class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                        <option value="Pemula">{{ __('Pemula (Beginner)') }}</option>
                                        <option value="Menengah">{{ __('Menengah (Intermediate)') }}</option>
                                        <option value="Mahir">{{ __('Mahir (Advanced)') }}</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2">
                                    <button type="button" wire:click="addLanguage" wire:loading.attr="disabled" class="w-full py-2 bg-secondary text-white rounded-lg font-semibold transition disabled:opacity-75">
                                        <span wire:loading.remove wire:target="addLanguage">+ {{ __('Tambah Bahasa') }}</span>
                                        <span wire:loading wire:target="addLanguage">{{ __('Memproses...') }}</span>
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($languages as $index => $lang)
                                    <div class="flex justify-between items-center p-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-slate-700 rounded-lg">
                                        <div>
                                            <span class="font-bold text-gray-800 dark:text-slate-200">{{ $lang['language'] }}</span>
                                            <span class="text-xs text-gray-400 dark:text-slate-500 ml-2">({{ $lang['proficiency'] }})</span>
                                        </div>
                                        <div class="flex gap-1">
                                            <button type="button" wire:click="editLanguage({{ $index }})" class="text-blue-500" title="Edit">
                                                <i class="ri-edit-line"></i>
                                            </button>
                                            <button type="button" wire:click="removeLanguage({{ $index }})" class="text-red-500" title="Hapus">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-start gap-4 pt-8">
                            <button type="submit" wire:loading.attr="disabled" style="background-color: #16a34a; padding: 12px 28px; color: white; border-radius: 12px; font-weight: 800; border: none; display: flex; align-items: center; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all disabled:opacity-75 disabled:cursor-not-allowed">
                                 <span wire:loading.remove wire:target="saveCv">
                                     <i class="ri-save-fill" style="margin-right: 8px; font-size: 1.25rem;"></i> 
                                     <span>{{ __('SIMPAN DATA CV') }}</span>
                                 </span>
                                 <span wire:loading wire:target="saveCv" class="flex items-center">
                                     <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                         <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                         <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                     </svg>
                                     <span>{{ __('MENYIMPAN...') }}</span>
                                 </span>
                            </button>
                            @if ($cv && $cv->exists)
                                <a href="{{ route('cv.preview', $cv->id) }}" style="background-color: #2563eb; padding: 12px 28px; color: white; border-radius: 12px; font-weight: 800; text-decoration: none; display: flex; align-items: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all">
                                    <i class="ri-eye-fill" style="margin-right: 8px; font-size: 1.25rem;"></i> 
                                    <span>{{ __('PREVIEW CV') }}</span>
                                </a>
                            @endif
                            @if ($cvId && $cv && $cv->exists)
                                <button type="button" wire:click="exportPdf" style="background-color: #dc2626; padding: 12px 28px; color: white; border-radius: 12px; font-weight: 800; border: none; display: flex; align-items: center; font-size: 14px; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all">
                                    <i class="ri-file-pdf-line" style="margin-right: 8px; font-size: 1.25rem;"></i> 
                                    <span>{{ __('EXPORT PDF') }}</span>
                                </button>
                            @endif 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
