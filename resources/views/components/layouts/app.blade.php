<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Karivio - A professional job application management system" name="description">
    <meta content="Karivio" name="author">
    <title>Karivio - {{ $title ?? 'Dashboard' }}</title>

    <link rel="shortcut icon" href="{{ asset('logo.svg') }}">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('assets/js/config.min.js') }}"></script>

    @livewireStyles
</head>

<body>
    <div data-sidenav-view="hover">
        <div class="flex wrapper">

            <!-- Sidenav Menu -->
            <div class="app-menu">

                <!-- App Logo -->
                <a href="{{ route('dashboard') }}" class="logo-box">
                    <!-- Light Logo -->
                    <div class="logo-light">
                        <img src="{{ asset('logo.svg') }}" class="logo-lg" style="height: 50px;" alt="Light logo">
                        <img src="{{ asset('logo.svg') }}" class="logo-sm" style="height: 50px;" alt="Small logo">
                    </div>

                    <!-- Dark Logo -->
                    <div class="logo-dark">
                        <img src="{{ asset('logo.svg') }}" class="logo-lg" style="height: 50px;" alt="Dark logo">
                        <img src="{{ asset('logo.svg') }}" class="logo-sm" style="height: 50px;" alt="Small logo">
                    </div>
                    <span class="text-white text-2xl font-bold ml-5 mt-1">Karivio</span>
                </a>

                <!-- Sidenav Menu Toggle Button -->
                <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5 z-50">
                    <span class="sr-only">Menu Toggle Button</span>
                    <i class="ri-checkbox-blank-circle-line text-xl"></i>
                </button>

                <!--- Menu -->
                <div class="scrollbar" data-simplebar>
                    <ul class="menu" data-fc-type="accordion">
                        <li class="menu-item">
                            <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="ri-home-4-line"></i>
                                </span>
                                <span class="menu-text"> Beranda </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('file-management') }}" class="menu-link {{ request()->routeIs('file-management') ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="ri-folder-open-line"></i>
                                </span>
                                <span class="menu-text"> File Saya </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('email.list') }}" class="menu-link {{ request()->routeIs('email.list') || request()->routeIs('send-email') ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="ri-mail-send-line"></i>
                                </span>
                                <span class="menu-text"> Kirim Email </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('cv.list') }}" class="menu-link {{ request()->routeIs('cv.*') ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="ri-file-list-3-line"></i>
                                </span>
                                <span class="menu-text"> CV Saya </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('cover-letter.list') }}" class="menu-link {{ request()->routeIs('cover-letter.*') ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="ri-mail-line"></i>
                                </span>
                                <span class="menu-text"> Cover Letter </span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- Sidenav Menu End  -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="page-content">

                <!-- Topbar Start -->
                <header class="app-header flex items-center px-4 gap-3.5">

                    <!-- App Logo -->
                    <a href="{{ route('dashboard') }}" class="logo-box">
                        <!-- Light Logo -->
                        <div class="logo-light">
                            <img src="{{ asset('logo.svg') }}" class="logo-lg" style="height: 32px;" alt="Light logo">
                            <img src="{{ asset('logo.svg') }}" class="logo-sm" style="height: 32px;" alt="Small logo">
                        </div>

                        <!-- Dark Logo -->
                        <div class="logo-dark">
                            <img src="{{ asset('logo.svg') }}" class="logo-lg" style="height: 32px;" alt="Dark logo">
                            <img src="{{ asset('logo.svg') }}" class="logo-sm" style="height: 32px;" alt="Small logo">
                        </div>
                    </a>

                    <!-- Sidenav Menu Toggle Button -->
                    <button id="button-toggle-menu" class="nav-link p-2">
                        <span class="sr-only">Menu Toggle Button</span>
                        <span class="flex items-center justify-center">
                            <i class="ri-menu-2-fill text-2xl"></i>
                        </span>
                    </button>

                    <!-- Theme Setting Button -->
                    <div class="relative ms-auto">
                        <button data-fc-type="offcanvas" data-fc-target="theme-customization" type="button" class="nav-link p-2">
                            <span class="sr-only">Customization</span>
                            <span class="flex items-center justify-center">
                                <i class="ri-settings-3-line text-2xl"></i>
                            </span>
                        </button>
                    </div>

                    <!-- Light/Dark Toggle Button -->
                    <div class="relative lg:flex hidden">
                        <button id="light-dark-mode" type="button" class="nav-link p-2">
                            <span class="sr-only">Light/Dark Mode</span>
                            <span class="flex items-center justify-center">
                                <i class="ri-moon-line text-2xl block dark:hidden"></i>
                                <i class="ri-sun-line text-2xl hidden dark:block"></i>
                            </span>
                        </button>
                    </div>

                    <!-- Fullscreen Toggle Button -->
                    <div class="relative lg:flex hidden">
                        <button data-toggle="fullscreen" type="button" class="nav-link p-2">
                            <span class="sr-only">Fullscreen Mode</span>
                            <span class="flex items-center justify-center">
                                <i class="ri-fullscreen-line text-2xl"></i>
                            </span>
                        </button>
                    </div>

                    <!-- Profile Dropdown Button -->
                    <div class="relative">
                        <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button" class="nav-link flex items-center gap-2.5 px-3 bg-black/5 border-x border-black/10">
                            @if(Auth::check())
                                <img src="{{ Auth::user()->avatar ?? asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" class="rounded-full h-8">
                                <span class="md:flex flex-col gap-0.5 text-start hidden">
                                    <h5 class="text-sm">{{ Auth::user()->name }}</h5>
                                    <span class="text-xs text-gray-500">{{ Auth::user()->email }}</span>
                                </span>
                            @else
                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" class="rounded-full h-8">
                                <span class="md:flex flex-col gap-0.5 text-start hidden">
                                    <h5 class="text-sm">Tamu</h5>
                                </span>
                            @endif
                        </button>

                        <div class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-44 z-50 transition-all duration-300 bg-white shadow-lg border rounded-lg py-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            <!-- item-->
                            <h6 class="flex items-center py-2 px-3 text-xs text-gray-800 dark:text-gray-400">Selamat Datang !</h6>

                            <!-- item-->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2 py-1.5 px-4 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    <i class="ri-logout-box-line text-lg align-middle"></i>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </header>
                <!-- Topbar End -->

                {{ $slot }}

                <!-- Footer Start -->
                <footer class="footer h-16 flex items-center px-6 bg-white shadow dark:bg-gray-800 mt-auto">
                    <div class="flex md:justify-between justify-center w-full gap-4">
                        <div>
                            <script>document.write(new Date().getFullYear())</script> © Karivio - <a href="#" target="_blank">Karivio Team</a>
                        </div>
                        <div class="md:flex hidden gap-4 item-center md:justify-end">
                            <a href="javascript: void(0);" class="text-sm leading-5 text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">Tentang</a>
                            <a href="javascript: void(0);" class="text-sm leading-5 text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">Dukungan</a>
                            <a href="javascript: void(0);" class="text-sm leading-5 text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">Hubungi Kami</a>
                        </div>
                    </div>
                </footer>
                <!-- Footer End -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>

        <!-- Theme Settings Offcanvas -->
        <div>
            <div id="theme-customization" class="fc-offcanvas-open:translate-x-0 hidden translate-x-full rtl:-translate-x-full fixed inset-y-0 end-0 transition-all duration-300 transform max-w-72 w-full z-50 bg-white dark:bg-gray-800" tabindex="-1">
                <div class="h-16 flex items-center text-white bg-primary px-6 gap-3">
                    <h5 class="text-base flex-grow">Pengaturan Tema</h5>
                    <button type="button" data-fc-dismiss><i class="ri-close-line text-xl"></i></button>
                </div>

                <div class="h-[calc(100vh-128px)]" data-simplebar>
                    <div class="p-6">
                        <div class="mb-6">
                            <h5 class="font-semibold text-sm mb-3">Theme</h5>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-mode" id="layout-color-light" value="light">
                                    <label class="ms-1.5" for="layout-color-light"> Light </label>
                                </div>

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-mode" id="layout-color-dark" value="dark">
                                    <label class="ms-1.5" for="layout-color-dark"> Dark </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h5 class="font-semibold text-sm mb-3">Direction</h5>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="dir" id="direction-ltr" value="ltr">
                                    <label class="ms-1.5" for="direction-ltr"> LTR </label>
                                </div>

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="dir" id="direction-rtl" value="rtl">
                                    <label class="ms-1.5" for="direction-rtl"> RTL </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6 2xl:block hidden">
                            <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Beranda</h4>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-layout-width" id="layout-mode-default" value="default">
                                    <label class="ms-1.5" for="layout-mode-default"> Fluid </label>
                                </div>

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-layout-width" id="layout-mode-boxed" value="boxed">
                                    <label class="ms-1.5" for="layout-mode-boxed"> Boxed </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h5 class="font-semibold text-sm mb-3">Sidenav View</h5>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-sidenav-view" id="sidenav-view-default" value="default">
                                    </label>
                                    <label class="ms-1.5" for="sidenav-view-default"> Default </label>
                                </div>                       

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-sidenav-view" id="sidenav-view-sm" value="sm">
                                    <label class="ms-1.5" for="sidenav-view-sm"> Small </label>
                                </div>

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-sidenav-view" id="sidenav-view-md" value="md">
                                    <label class="ms-1.5" for="sidenav-view-md"> Compact </label>
                                </div>                      

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-sidenav-view" id="sidenav-view-mobile" value="mobile">
                                    <label class="ms-1.5" for="sidenav-view-mobile"> Mobile </label>
                                </div>

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-sidenav-view" id="sidenav-view-hidden" value="hidden">
                                    <label class="ms-1.5" for="sidenav-view-hidden"> Hidden </label>
                                </div>
                            
                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-sidenav-view" id="sidenav-view-hover" value="hover">
                                    <label class="ms-1.5" for="sidenav-view-hover"> Hover </label>
                                </div>

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-sidenav-view" id="sidenav-view-hover-active" value="hover-active">
                                    <label class="ms-1.5" for="sidenav-view-hover-active"> Hover Active </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h5 class="font-semibold text-sm mb-3">Menu Color</h5>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-menu-color" id="menu-color-light" value="light">
                                    <label class="ms-1.5" for="menu-color-light"> Light </label>
                                </div>

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-menu-color" id="menu-color-dark" value="dark">
                                    <label class="ms-1.5" for="menu-color-dark"> Dark </label>
                                </div>

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-menu-color" id="menu-color-brand" value="brand">
                                    <label class="ms-1.5" for="menu-color-brand"> Brand </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h5 class="font-semibold text-sm mb-3">Topbar Color</h5>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-topbar-color" id="topbar-color-light" value="light">
                                    <label class="ms-1.5" for="topbar-color-light"> Light </label>
                                </div>

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-topbar-color" id="topbar-color-dark" value="dark">
                                    <label class="ms-1.5" for="topbar-color-dark"> Dark </label>
                                </div>

                                <div class="flex items-center">
                                    <input class="form-switch form-switch-sm" type="checkbox" name="data-topbar-color" id="topbar-color-brand" value="brand">
                                    <label class="ms-1.5" for="topbar-color-brand"> Brand </label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h5 class="font-semibold text-sm mb-3">Layout Position</h5>

                            <div class="flex btn-radio">
                                <input type="radio" class="form-radio hidden" name="data-layout-position" id="layout-position-fixed" value="fixed">
                                <label class="btn rounded-e-none bg-gray-100 dark:bg-gray-700" for="layout-position-fixed">Fixed</label>
                                <input type="radio" class="form-radio hidden" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                                <label class="btn rounded-s-none bg-gray-100 dark:bg-gray-700" for="layout-position-scrollable">Scrollable</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-16 p-4 flex items-center gap-4 border-t border-gray-300 dark:border-gray-600 px-6">
                    <button type="button" class="btn bg-primary text-white w-1/2" id="reset-layout">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/lucide/umd/lucide.min.js') }}"></script>
    <script src="{{ asset('assets/libs/@frostui/tailwindcss/frostui.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            showCloseButton: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                toast.style.zIndex = '999999';
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            @if(session()->has('success'))
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}"
                });
            @endif

            @if(session()->has('error'))
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}"
                });
            @endif
        });

        window.addEventListener('toast', event => {
            const data = Array.isArray(event.detail) ? event.detail[0] : event.detail;
            Toast.fire({
                icon: data.type || 'success',
                title: data.title || '',
                text: data.message || '',
                confirmButtonColor: data.type === 'error' ? '#ef4444' : '#3b82f6',
            });
        });

        window.addEventListener('confirm', event => {
            // Handle Livewire 3 event structure
            let data = event.detail;
            if (Array.isArray(data)) data = data[0];
            
            Swal.fire({
                title: data.title || 'Apakah Anda yakin?',
                text: data.message || "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: data.confirmButtonText || 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn bg-danger text-white px-4 py-2 mx-2',
                    cancelButton: 'btn bg-secondary text-white px-4 py-2 mx-2'
                },
                buttonsStyling: false,
                showCloseButton: true,
                didOpen: (modal) => {
                    modal.style.zIndex = '999999';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    if (data.onConfirm) {
                        Livewire.dispatch(data.onConfirm, { id: data.id });
                    }
                }
            });
        });
    </script>
    @livewireScripts
</body>
</html>
