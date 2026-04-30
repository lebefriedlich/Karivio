<main class="p-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">
                @if ($cv && $cv->exists)
                    Edit CV - {{ $cv->full_name }}
                @else
                    Buat CV Baru
                @endif
            </h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Isi data pribadi dan profesional Anda</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('cv.list') }}" class="btn bg-secondary text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-arrow-left-line text-lg"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6" >
        <div class="{{ $cvId ? 'col-span-12 lg:col-span-8' : 'col-span-12' }}">
            <div class="card bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 shadow-sm" style="border-radius: 2rem !important;">
                <div class="card-header border-b border-slate-100 dark:border-slate-700">
                    <h4 class="card-title text-slate-900 dark:text-slate-200">Form Data CV</h4>
                </div>

                <div class="p-6">


                    <form wire:submit="saveCv" class="space-y-12">
                        <!-- 1. Identitas Diri -->
                        <div>
                            <div class="flex items-center gap-2 mb-6">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">1</span>
                                <h5 class="text-xl font-bold">Identitas Diri</h5>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                                    <input type="text" wire:model="full_name" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Nama Lengkap" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Nomor Telepon</label>
                                    <input type="tel" wire:model="phone" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="0812..." required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Email</label>
                                    <input type="email" wire:model="email" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="email@contoh.com" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">Domisili (Kota/Kabupaten)</label>
                                    <input type="text" wire:model="location" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Jakarta Selatan" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">URL LinkedIn</label>
                                    <input type="url" wire:model="linkedin_url" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://linkedin.com/in/username">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">URL Portofolio / Website</label>
                                    <input type="url" wire:model="portfolio_url" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://portofolio.com">
                                </div>
                            </div>
                        </div>

                        <!-- 2. Profil -->
                        <div>
                            <div class="flex items-center gap-2 mb-6">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">2</span>
                                <h5 class="text-xl font-bold text-slate-900 dark:text-slate-200">Tentang Saya / Ringkasan Profesional</h5>
                            </div>
                            <div>
                                <textarea wire:model="professional_summary" rows="5" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Ceritakan singkat tentang pengalaman dan keahlian Anda..."></textarea>
                            </div>
                        </div>

                        <!-- 3. Pendidikan -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">3</span>
                                <h5 class="text-xl font-bold">Pendidikan</h5>
                            </div>
                            <p class="text-sm text-gray-500 mb-6">Urutkan dari yang terbaru.</p>
                            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700 mb-6">
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Instansi Pendidikan</label>
                                        <input type="text" wire:model="current_education.institution" placeholder="Contoh: Universitas Gadjah Mada" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Jurusan / Program Studi</label>
                                        <input type="text" wire:model="current_education.major" placeholder="Contoh: Teknik Informatika" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Nilai (IPK/Akhir)</label>
                                        <input type="text" wire:model="current_education.score" placeholder="Contoh: 3.80 / 4.00" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Mulai</label>
                                        <input type="month" wire:model="current_education.start_date" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Selesai</label>
                                        <input type="month" wire:model="current_education.end_date" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                </div>
                                <button type="button" wire:click="addEducation" wire:loading.attr="disabled" class="w-full py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition disabled:opacity-75">
                                    <span wire:loading.remove wire:target="addEducation">+ Tambah Pendidikan</span>
                                    <span wire:loading wire:target="addEducation">Memproses...</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                @foreach ($education as $index => $edu)
                                    <div class="border border-gray-200 dark:border-gray-900 rounded-lg p-4 flex justify-between items-center group hover:border-primary transition">
                                        <div>
                                            <h6 class="font-bold text-gray-800 dark:text-slate-200">{{ $edu['institution'] }}</h6>
                                            <p class="text-sm text-gray-600 dark:text-slate-400">{{ $edu['major'] }} • {{ $edu['score'] }}</p>
                                            <p class="text-xs text-gray-400 dark:text-slate-500">{{ $edu['start_date'] }} s/d {{ $edu['end_date'] }}</p>
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
                                <h5 class="text-xl font-bold text-slate-900 dark:text-slate-200">Pengalaman Profesional</h5>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700 mb-6">
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Perusahaan / Organisasi</label>
                                        <input type="text" wire:model="current_work.company" placeholder="Nama Perusahaan" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Posisi / Jabatan</label>
                                        <input type="text" wire:model="current_work.position" placeholder="Contoh: Backend Developer" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Mulai</label>
                                        <input type="month" wire:model="current_work.start_date" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Selesai</label>
                                        <input type="month" wire:model="current_work.end_date" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Deskripsi Pekerjaan</label>
                                        <textarea wire:model="current_work.description" placeholder="Apa yang Anda kerjakan? Gunakan poin-poin jika perlu." rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm"></textarea>
                                    </div>
                                </div>
                                <button type="button" wire:click="addWorkExperience" wire:loading.attr="disabled" class="w-full py-2 bg-primary text-white rounded-lg font-semibold transition disabled:opacity-75">
                                    <span wire:loading.remove wire:target="addWorkExperience">+ Tambah Pengalaman Kerja</span>
                                    <span wire:loading wire:target="addWorkExperience">Memproses...</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                @foreach ($work_experiences as $index => $work)
                                    <div class="border border-gray-200 dark:border-gray-900 rounded-lg p-4 flex justify-between items-start group hover:border-primary transition">
                                        <div class="flex-1">
                                            <h6 class="font-bold text-gray-800 dark:text-slate-200">{{ $work['position'] }} di {{ $work['company'] }}</h6>
                                            <p class="text-xs text-gray-400 dark:text-slate-500 mb-2">{{ $work['start_date'] }} s/d {{ $work['end_date'] }}</p>
                                            <p class="text-sm text-gray-600 dark:text-slate-400 whitespace-pre-line">{{ $work['description'] }}</p>
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
                                <h5 class="text-xl font-bold text-slate-900 dark:text-slate-200">Pengalaman Organisasi</h5>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700 mb-6">
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Nama Organisasi</label>
                                        <input type="text" wire:model="current_org.organization" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Jabatan</label>
                                        <input type="text" wire:model="current_org.role" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Mulai</label>
                                        <input type="month" wire:model="current_org.start_date" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Selesai</label>
                                        <input type="month" wire:model="current_org.end_date" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Deskripsi Kegiatan</label>
                                        <textarea wire:model="current_org.description" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg"></textarea>
                                    </div>
                                </div>
                                <button type="button" wire:click="addOrganization" wire:loading.attr="disabled" class="w-full py-2 bg-primary text-white rounded-lg font-semibold transition disabled:opacity-75">
                                    <span wire:loading.remove wire:target="addOrganization">+ Tambah Pengalaman Organisasi</span>
                                    <span wire:loading wire:target="addOrganization">Memproses...</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                @foreach ($organization_experiences as $index => $org)
                                    <div class="border border-gray-200 dark:border-gray-900 rounded-lg p-4 flex justify-between items-start group hover:border-primary transition">
                                        <div class="flex-1">
                                            <h6 class="font-bold text-gray-800 dark:text-slate-200">{{ $org['role'] }} - {{ $org['organization'] }}</h6>
                                            <p class="text-xs text-gray-400 dark:text-slate-500 mb-2">{{ $org['start_date'] }} s/d {{ $org['end_date'] }}</p>
                                            <p class="text-sm text-gray-600 dark:text-slate-400 whitespace-pre-line">{{ $org['description'] }}</p>
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

                        <!-- 6. Pengalaman Asistensi -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">6</span>
                                <h5 class="text-xl font-bold">Pengalaman Asistensi</h5>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700 mb-6">
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Peran / Jabatan</label>
                                        <input type="text" wire:model="current_assistance.role" placeholder="Contoh: Asisten Laboratorium" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Instansi / Lokasi</label>
                                        <input type="text" wire:model="current_assistance.location" placeholder="Nama Instansi" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Mulai</label>
                                        <input type="month" wire:model="current_assistance.start_date" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Selesai</label>
                                        <input type="month" wire:model="current_assistance.end_date" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Deskripsi Tugas</label>
                                        <textarea wire:model="current_assistance.description" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg"></textarea>
                                    </div>
                                </div>
                                <button type="button" wire:click="addAssistance" wire:loading.attr="disabled" class="w-full py-2 bg-primary text-white rounded-lg font-semibold transition disabled:opacity-75">
                                    <span wire:loading.remove wire:target="addAssistance">+ Tambah Pengalaman Asistensi</span>
                                    <span wire:loading wire:target="addAssistance">Memproses...</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                @foreach ($assistance_experiences as $index => $ast)
                                    <div class="border border-gray-200 dark:border-gray-900 rounded-lg p-4 flex justify-between items-start group hover:border-primary transition">
                                        <div class="flex-1">
                                            <h6 class="font-bold text-gray-800 dark:text-slate-200">{{ $ast['role'] }} - {{ $ast['location'] }}</h6>
                                            <p class="text-xs text-gray-400 dark:text-slate-500 mb-2">{{ $ast['start_date'] }} s/d {{ $ast['end_date'] }}</p>
                                            <p class="text-sm text-gray-600 dark:text-slate-400 whitespace-pre-line">{{ $ast['description'] }}</p>
                                        </div>
                                        <div class="ml-4 flex gap-1">
                                            <button type="button" wire:click="editAssistance({{ $index }})" class="w-8 h-8 flex items-center justify-center rounded-full text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20" title="Edit">
                                                <i class="ri-edit-line"></i>
                                            </button>
                                            <button type="button" wire:click="removeAssistance({{ $index }})" class="w-8 h-8 flex items-center justify-center rounded-full text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20" title="Hapus">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- 7. Skill (Hard & Soft) -->
                        <div>
                            <div class="flex items-center gap-2 mb-8">
                                <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">7</span>
                                <h5 class="text-xl font-bold">Keahlian (Skill)</h5>
                            </div>

                            <div class="grid md:grid-cols-2 gap-5">
                                <!-- Hard Skills -->
                                <div>
                                    <h6 class="font-bold text-gray-700 dark:text-white mb-3">Hard Skill (Per Kategori)</h6>
                                    <p class="text-xs text-gray-500 dark:text-slate-400 mb-4 italic">Contoh: Bahasa Pemrograman : PHP, JS, Go</p>
                                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800 mb-4">
                                        <div class="space-y-3 mb-3">
                                            <input type="text" wire:model="current_hard_skill.category" placeholder="Kategori (Misal: Bahasa Pemrograman)" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                            <textarea wire:model="current_hard_skill.skills" placeholder="Isi Skill (Misal: PHP, JavaScript, Go)" rows="2" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm"></textarea>
                                        </div>
                                        <button type="button" wire:click="addHardSkill" wire:loading.attr="disabled" style="background-color: #2563eb; color: white; padding: 6px 12px; border-radius: 8px; font-size: 0.875rem; font-weight: 600; border: none; width: 100%; cursor: pointer;" class="disabled:opacity-75">
                                            <span wire:loading.remove wire:target="addHardSkill">+ Tambah Kategori</span>
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
                                    <h6 class="font-bold text-gray-700 dark:text-white mb-3">Soft Skill</h6>
                                    <div class="flex gap-2 mb-4">
                                        <input type="text" wire:model="current_soft_skill" placeholder="Misal: Leadership" class="flex-1 px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg text-sm">
                                        <button type="button" wire:click="addSoftSkill" wire:loading.attr="disabled" style="background-color: #4f46e5; color: white; padding: 8px 16px; border-radius: 8px; font-size: 0.875rem; border: none; cursor: pointer;" class="disabled:opacity-75">
                                            <span wire:loading.remove wire:target="addSoftSkill">Tambah</span>
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
                                <h5 class="text-xl font-bold">Kemampuan Bahasa</h5>
                            </div>
                            <div class="grid md:grid-cols-2 gap-4 bg-gray-50 dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-slate-700 mb-6">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Bahasa</label>
                                    <input type="text" wire:model="current_language.language" placeholder="Misal: Indonesia" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-500 dark:text-slate-400 mb-1">Tingkat Kemampuan</label>
                                    <select wire:model="current_language.proficiency" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg">
                                        <option value="Pemula">Pemula (Beginner)</option>
                                        <option value="Menengah">Menengah (Intermediate)</option>
                                        <option value="Lanjut">Lanjut (Advanced)</option>
                                        <option value="Fasih">Fasih (Fluent)</option>
                                        <option value="Bahasa Ibu">Bahasa Ibu (Native)</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2">
                                    <button type="button" wire:click="addLanguage" wire:loading.attr="disabled" class="w-full py-2 bg-secondary text-white rounded-lg font-semibold transition disabled:opacity-75">
                                        <span wire:loading.remove wire:target="addLanguage">+ Tambah Bahasa</span>
                                        <span wire:loading wire:target="addLanguage">Memproses...</span>
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
                                    <span>SIMPAN DATA CV</span>
                                </span>
                                <span wire:loading wire:target="saveCv" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>MENYIMPAN...</span>
                                </span>
                            </button>
                            @if ($cv && $cv->exists)
                                <a href="{{ route('cv.preview', $cv->id) }}" style="background-color: #2563eb; padding: 12px 28px; color: white; border-radius: 12px; font-weight: 800; text-decoration: none; display: flex; align-items: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" class="hover:opacity-90 transition-all">
                                    <i class="ri-eye-fill" style="margin-right: 8px; font-size: 1.25rem;"></i> 
                                    <span>PREVIEW CV</span>
                                </a>
                            @endif
                            @if ($cvId && $cv && $cv->exists)
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
    </div>
</main>
