<main class="p-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-slate-900 dark:text-slate-200 text-2xl font-bold tracking-tight">
                @if ($coverLetterId)
                    {{ __('Edit Cover Letter') }} - {{ $company_name }}
                @else
                    {{ __('Buat Cover Letter') }}
                @endif
            </h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">{{ __('Isi data Cover Letter Anda') }}</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('cover-letter.list') }}"
                class="btn bg-secondary text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i class="ri-arrow-left-line text-lg"></i> {{ __('Kembali') }}
            </a>
        </div>
    </div>

    <div class="w-full">
        <div class="card bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 shadow-sm"
            style="border-radius: 2rem !important;">
            <div class="card-header border-b border-slate-100 dark:border-slate-700">
                <h4 class="card-title text-slate-900 dark:text-slate-200">{{ __('Form Data Lamaran') }}</h4>
            </div>

            <div class="p-6">
                <form wire:submit.prevent="save" class="space-y-12">
                    <!-- Language Selection -->
                    <div class="bg-primary/5 p-6 rounded-2xl border border-primary/10 mb-8">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <h5 class="text-lg font-bold text-primary">
                                    {{ __('Bahasa Cover Letter / Cover Letter Language') }}
                                </h5>
                                <p class="text-sm text-slate-500">
                                    {{ __('Pilih bahasa untuk label dan format tanggal') }} / Choose language for labels
                                    and dates
                                </p>
                            </div>
                            <div class="w-full md:w-64">
                                <select wire:model.live="language"
                                    class="w-full px-4 py-3 border border-primary/20 bg-white dark:bg-slate-900 dark:text-white rounded-xl focus:ring-2 focus:ring-primary font-bold">
                                    <option value="id">{{ __('Bahasa Indonesia') }}</option>
                                    <option value="en">English</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- 1. Data Pribadi -->
                    <div>
                        <div class="flex items-center gap-2 mb-6">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">1</span>
                            <h5 class="text-xl font-bold text-slate-900 dark:text-slate-200">{{ __('Data Pribadi') }}
                            </h5>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Nama Lengkap') }}</label>
                                <input type="text" wire:model.live="full_name"
                                    class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="{{ __('Nama Lengkap') }}">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Nomor Telepon') }}</label>
                                <input type="tel" wire:model="phone"
                                    class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="{{ __('0812...') }}">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Email') }}</label>
                                <input type="email" wire:model="email"
                                    class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="{{ __('email@contoh.com') }}">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Kota Asal') }}</label>
                                <input type="text" wire:model="city"
                                    class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="{{ __('Kota') }}">
                            </div>
                        </div>
                    </div>
                    <!-- 2. Data Perusahaan & Posisi -->
                    <div class="mt-6">
                        <div class="flex items-center gap-2 mb-6">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">2</span>
                            <h5 class="text-xl font-bold">{{ __('Tujuan Lamaran') }}</h5>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Nama Perusahaan') }}</label>
                                <input type="text" wire:model.live="company_name"
                                    class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="{{ __('Nama Perusahaan') }}">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Posisi yang Dilamar') }}</label>
                                <input type="text" wire:model.live="applied_position"
                                    class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="{{ __('Posisi') }}">
                            </div>
                            <div class="md:col-span-2">
                                <label
                                    class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Alamat Perusahaan') }}</label>
                                <input type="text" wire:model="company_address"
                                    class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="{{ __('Alamat Perusahaan') }}">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-300">{{ __('Tanggal Surat') }}</label>
                                <input type="date" wire:model="date"
                                    class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- 3. Isi Surat -->
                    <div class="relative mt-6">
                        <div class="flex items-center gap-2 mb-6">
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full font-bold">3</span>
                            <h5 class="text-xl font-bold text-slate-900 dark:text-slate-200">
                                {{ __('Isi Surat (Body)') }}
                            </h5>
                        </div>

                        <div class="relative" x-data="{ 
                                showSuggest: false,
                                suggestPos: { top: '0px', left: '0px' },
                                // Entangle for instant reactivity
                                full_name: @entangle('full_name'),
                                company_name: @entangle('company_name'),
                                applied_position: @entangle('applied_position'),
                                placeholders: [
                                    { label: '{{ __("Nama Lengkap") }}', icon: 'ri-user-line', key: 'full_name' },
                                    { label: '{{ __("Nama Perusahaan") }}', icon: 'ri-building-line', key: 'company_name' },
                                    { label: '{{ __("Posisi") }}', icon: 'ri-briefcase-line', key: 'applied_position' }
                                ],
                                handleInput(e) {
                                    const val = e.target.value;
                                    const cursor = e.target.selectionStart;
                                    const lastOne = val.substring(cursor - 1, cursor);
                                    
                                    if (lastOne === '@') {
                                        this.updatePosition(e.target);
                                        this.showSuggest = true;
                                    } else {
                                        this.showSuggest = false;
                                    }
                                },
                                updatePosition(el) {
                                    const style = window.getComputedStyle(el);
                                    const mirror = document.createElement('div');
                                    const span = document.createElement('span');
                                    
                                    // Match textarea exactly
                                    Object.assign(mirror.style, {
                                        position: 'absolute',
                                        visibility: 'hidden',
                                        whiteSpace: 'pre-wrap',
                                        wordWrap: 'break-word',
                                        width: el.clientWidth + 'px',
                                        font: style.font,
                                        padding: style.padding,
                                        lineHeight: style.lineHeight,
                                        boxSizing: style.boxSizing,
                                        left: '0px',
                                        top: '0px'
                                    });
                                    
                                    const text = el.value.substring(0, el.selectionStart - 1);
                                    mirror.textContent = text;
                                    span.textContent = '@';
                                    mirror.appendChild(span);
                                    el.offsetParent.appendChild(mirror);
                                    
                                    this.suggestPos = {
                                        top: (span.offsetTop - el.scrollTop + 40) + 'px',
                                        left: Math.min(span.offsetLeft, el.clientWidth - 320) + 'px'
                                    };
                                    
                                    el.offsetParent.removeChild(mirror);
                                },
                                insert(key) {
                                    const el = this.$refs.textarea;
                                    const start = el.selectionStart;
                                    const end = el.selectionEnd;
                                    const text = el.value;
                                    const before = text.substring(0, start - 1);
                                    const after = text.substring(end);
                                    
                                    const realValue = this[key]; // Access entangled state
                                    const valToInsert = realValue || '';
                                    const newVal = before + valToInsert + after;
                                    this.$wire.set('content', newVal);
                                    this.showSuggest = false;
                                    
                                    setTimeout(() => {
                                        el.focus();
                                        const pos = before.length + valToInsert.length;
                                        el.setSelectionRange(pos, pos);
                                    }, 10);
                                }
                            }">
                            <textarea x-ref="textarea" wire:model="content" @input="handleInput($event)" rows="15"
                                class="w-full px-3 py-2 border border-gray-300 text-black dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-lg focus:ring-2 focus:ring-primary/20 transition-all font-sans text-sm"
                                placeholder="{{ __('Tulis surat Anda di sini... Gunakan @ untuk bantuan data.') }}"></textarea>

                            <!-- Precision Caret-Following Menu -->
                            <div x-show="showSuggest" @click.away="showSuggest = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                :style="'top: ' + suggestPos.top + '; left: ' + suggestPos.left"
                                class="absolute w-80 bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl border border-slate-200 dark:border-slate-700 rounded-2xl shadow-2xl z-50 overflow-hidden ring-1 ring-black/5">
                                <div class="max-h-64 overflow-y-auto p-1.5">
                                    <template x-for="p in placeholders">
                                        <button type="button" @click="insert(p.key)"
                                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary hover:text-white transition-all group text-left">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center group-hover:bg-white/20 transition-colors">
                                                <i :class="p.icon"
                                                    class="text-slate-600 dark:text-slate-400 group-hover:text-white"></i>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-bold text-slate-800 dark:text-slate-100 group-hover:text-white"
                                                    x-text="p.label"></p>
                                                <p class="text-[10px] opacity-60 group-hover:opacity-100"
                                                    x-text="$data[p.key] || '{{ __('Belum diisi') }}'"></p>
                                            </div>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-start gap-4 pt-2">
                        <button type="submit" wire:loading.attr="disabled"
                            style="background-color: #16a34a; padding: 12px 28px; color: white; border-radius: 12px; font-weight: 800; border: none; display: flex; align-items: center; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                            class="hover:opacity-90 transition-all disabled:opacity-75 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="save">
                                <i class="ri-save-fill" style="margin-right: 8px; font-size: 1.25rem;"></i>
                                <span>{{ __('SIMPAN COVER LETTER') }}</span>
                            </span>
                            <span wire:loading wire:target="save" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <span>{{ __('MENYIMPAN...') }}</span>
                            </span>
                        </button>
                        @if ($coverLetterId)
                            <a href="{{ route('cover-letter.preview', $coverLetterId) }}"
                                style="background-color: #2563eb; padding: 12px 28px; color: white; border-radius: 12px; font-weight: 800; text-decoration: none; display: flex; align-items: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                                class="hover:opacity-90 transition-all">
                                <i class="ri-eye-fill" style="margin-right: 8px; font-size: 1.25rem;"></i>
                                <span>{{ __('PREVIEW COVER LETTER') }}</span>
                            </a>
                            <button type="button" wire:click="exportPdf"
                                style="background-color: #dc2626; padding: 12px 28px; color: white; border-radius: 12px; font-weight: 800; border: none; display: flex; align-items: center; font-size: 14px; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                                class="hover:opacity-90 transition-all">
                                <i class="ri-file-pdf-line" style="margin-right: 8px; font-size: 1.25rem;"></i>
                                <span>{{ __('EXPORT PDF') }}</span>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>