<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ __('Profil Saya') }}</h4>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Left Column: Header Section -->
        <div class="xl:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col items-center p-8 h-full" style="border-radius: 1.5rem !important;">
                <!-- Avatar -->
                <div class="w-36 h-36 rounded-full overflow-hidden border-4 border-gray-100 dark:border-gray-700 shadow-md mb-6">
                    <img src="{{ Auth::user()->avatar ?? asset('assets/images/users/avatar-1.jpg') }}" alt="User Avatar" class="h-full w-full object-cover">
                </div>
                
                <!-- Info -->
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-500 dark:text-gray-400 font-medium mb-6">
                        {{ __('Bergabung sejak') }} {{ Auth::user()->created_at->translatedFormat('F Y') }}
                    </p>
                    <div class="w-full h-px bg-gray-200 dark:bg-gray-700 mb-6"></div>
                    <span class="inline-flex items-center gap-2 py-2 px-5 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Status: Aktif
                    </span>
                </div>
            </div>
        </div>

        <!-- Right Column: Form Section -->
        <div class="xl:col-span-2">
            <div class="card bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 h-full" style="border-radius: 1.5rem !important;">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h5 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('Detail Personal') }}</h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('Informasi ini akan terisi otomatis saat Anda membuat CV atau Cover Letter.') }}</p>
                </div>
                
                <div class="p-6">
                    <form wire:submit.prevent="updateProfile" class="flex flex-col h-full justify-between">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Nama Lengkap') }}</label>
                                <input type="text" id="name" wire:model="name" class="form-input w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary focus:ring-primary">
                                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Email') }}</label>
                                <input type="email" id="email" wire:model="email" class="form-input w-full rounded-md border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-500 cursor-not-allowed" readonly>
                                <span class="text-xs text-gray-500 mt-1 block">{{ __('Email tidak dapat diubah.') }}</span>
                            </div>

                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Nomor Telepon') }}</label>
                                <input type="text" id="phone_number" wire:model="phone_number" class="form-input w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary focus:ring-primary">
                                @error('phone_number') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Kota / Domisili') }}</label>
                                <input type="text" id="city" wire:model="city" class="form-input w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary focus:ring-primary">
                                @error('city') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="btn bg-primary text-white shadow-lg shadow-primary/30 px-6 py-2 rounded-md transition-all hover:bg-primary-dark">
                                {{ __('Simpan Perubahan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
