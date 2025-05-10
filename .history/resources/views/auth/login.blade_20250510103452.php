<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIAMI LPPM UNIB - Login</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">

    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- alpine js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
    <!-- flag icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css" rel="stylesheet">
    <!-- aos -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- particles -->
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.9.3/tsparticles.bundle.min.js"></script>
    <!-- typed.js -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: #2563EB;
            --primary-dark: #1D4ED8;
            --secondary: #0EA5E9;
            --accent: #8B5CF6;
            --background: #F8FAFC;
            --text-dark: #1E293B;
            --text-light: #64748B;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background);
            overflow-x: hidden;
        }

        .login-form {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .download-item {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .download-item:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .login-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #cbd5e1;
            border-radius: 4px;
            outline: none;
            transition: all 0.3s;
            position: relative;
            cursor: pointer;
        }

        .custom-checkbox:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .custom-checkbox:checked::before {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
        }

        .file-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .file-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent 30%
            );
            animation: rotate 4s linear infinite;
        }

        @keyframes rotate {
            100% {
                transform: rotate(1turn);
            }
        }

        .file-card-inner {
            position: relative;
            z-index: 1;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .announcement-ticker {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        }

        .news-ticker {
            overflow: hidden;
            white-space: nowrap;
        }

        .news-ticker-content {
            display: inline-block;
            animation: ticker 30s linear infinite;
            padding-right: 50px;
        }

        @keyframes ticker {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        .animated-gradient {
            background: linear-gradient(270deg, #3b82f6, #1e40af, #7c3aed, #2563eb);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .help-btn {
            transition: all 0.3s ease;
        }

        .help-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M0,96L48,112C96,128,192,160,288,165.3C384,171,480,149,576,122.7C672,96,768,64,864,80C960,96,1056,160,1152,186.7C1248,213,1344,203,1392,197.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #ef4444;
            color: white;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .language-switch {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }

        .badge-new {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ef4444;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            font-weight: bold;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Dark mode toggle */
        .dark-mode-toggle {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
        }

        .toggle-checkbox {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .toggle-slot {
            position: relative;
            width: 60px;
            height: 30px;
            border-radius: 15px;
            background-color: #374151;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .toggle-checkbox:checked ~ .toggle-slot {
            background-color: #60a5fa;
        }

        .toggle-button {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-checkbox:checked ~ .toggle-slot .toggle-button {
            left: 33px;
        }

        .sun-icon, .moon-icon {
            position: absolute;
            width: 14px;
            height: 14px;
            transition: opacity 0.3s;
        }

        .sun-icon {
            opacity: 0;
            color: #f59e0b;
        }

        .moon-icon {
            opacity: 1;
            color: #6366f1;
        }

        .toggle-checkbox:checked ~ .toggle-slot .sun-icon {
            opacity: 1;
        }

        .toggle-checkbox:checked ~ .toggle-slot .moon-icon {
            opacity: 0;
        }
    </style>
</head>

<body class="m-0 font-sans antialiased font-normal text-slate-600" x-data="{ darkMode: false }">
    <!-- Dark Mode Toggle -->
    <div class="dark-mode-toggle">
        <label class="toggle">
            <input type="checkbox" class="toggle-checkbox" x-model="darkMode">
            <div class="toggle-slot">
                <div class="toggle-button">
                    <i class="fas fa-sun sun-icon"></i>
                    <i class="fas fa-moon moon-icon"></i>
                </div>
            </div>
        </label>
    </div>

    <!-- Language Switch -->
    <div class="language-switch">
        <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-lg p-1 flex space-x-1">
            <button class="flex items-center justify-center p-2 rounded-md bg-blue-500 text-white">
                <span class="flag-icon flag-icon-id"></span>
                <span class="ml-1 text-xs">ID</span>
            </button>
            <button class="flex items-center justify-center p-2 rounded-md text-gray-600 hover:bg-gray-100 transition">
                <span class="flag-icon flag-icon-gb"></span>
                <span class="ml-1 text-xs">EN</span>
            </button>
        </div>
    </div>

    <!-- Particles Background -->
    <div id="particles-js" class="fixed inset-0 z-0"></div>

    <!-- Announcement Ticker -->
    <div class="announcement-ticker fixed w-full text-white py-2 z-20 bottom-0">
        <div class="news-ticker">
            <div class="news-ticker-content">
                <span class="inline-flex items-center px-2 py-1 mr-3 rounded bg-white bg-opacity-20">
                    <i class="fas fa-bullhorn mr-1"></i> PENGUMUMAN
                </span>
                Pendaftaran Audit Mutu Internal Tahun 2025 akan dibuka pada tanggal 20 Mei 2025
                <span class="mx-5">•</span>
                <span class="inline-flex items-center px-2 py-1 mr-3 rounded bg-white bg-opacity-20">
                    <i class="fas fa-calendar-alt mr-1"></i> AGENDA
                </span>
                Workshop Peningkatan Kompetensi Auditor Internal pada 15-17 Juni 2025
                <span class="mx-5">•</span>
                <span class="inline-flex items-center px-2 py-1 mr-3 rounded bg-white bg-opacity-20">
                    <i class="fas fa-info-circle mr-1"></i> INFO
                </span>
                Pembaruan sistem SIAMI versi 3.0 akan diluncurkan bulan Juli 2025
            </div>
        </div>
    </div>

    <main class="min-h-screen flex items-center justify-center px-4 py-12 relative z-10" :class="{'bg-slate-900': darkMode, 'bg-slate-50': !darkMode}">
        <div class="container mx-auto max-w-7xl">
            <div class="flex flex-col md:flex-row rounded-3xl overflow-hidden shadow-2xl"
                :class="{'bg-gray-800 text-white': darkMode, 'bg-white': !darkMode}"
                data-aos="fade-up" data-aos-duration="1000">

                <!-- Kiri: Form -->
                <div class="w-full md:w-2/5 p-8 flex flex-col justify-center relative" :class="{'bg-gray-800': darkMode, 'bg-white': !darkMode}">
                    <div class="absolute top-0 right-0 rounded-bl-3xl px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-400 text-white text-xs shadow-lg transform -translate-y-2 translate-x-2">
                        <span class="font-bold">SISTEM VERSI 2.5</span>
                    </div>

                    <div class="text-center mb-6">
                        <div class="mb-4 flex justify-center" data-aos="zoom-in" data-aos-delay="200">
                            <img src="{{ asset('assets/src/images/logo_unib.png') }}" class="h-24" alt="logo">
                        </div>
                        <h2 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400" data-aos="fade-up" data-aos-delay="300">
                            SIAMI LPPM UNIB
                        </h2>
                        <p class="text-sm text-gray-500" :class="{'text-gray-400': darkMode}" data-aos="fade-up" data-aos-delay="400">
                            Sistem Informasi Audit Mutu Internal
                        </p>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-md mb-6" :class="{'bg-blue-900 bg-opacity-30': darkMode}">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-600" :class="{'text-blue-400': darkMode}"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700" :class="{'text-blue-300': darkMode}" id="typed-text"></p>
                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="p-4 rounded-lg bg-green-50 border-l-4 border-green-500 mb-6" :class="{'bg-green-900 bg-opacity-30': darkMode}">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-600" :class="{'text-green-400': darkMode}"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700" :class="{'text-green-300': darkMode}">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 rounded-lg bg-red-50 border-l-4 border-red-500 mb-6" :class="{'bg-red-900 bg-opacity-30': darkMode}">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-times-circle text-red-600" :class="{'text-red-400': darkMode}"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700" :class="{'text-red-300': darkMode}">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5" data-aos="fade-up" data-aos-delay="500">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium mb-1" :class="{'text-gray-300': darkMode, 'text-gray-700': !darkMode}">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope" :class="{'text-gray-400': !darkMode, 'text-gray-500': darkMode}"></i>
                                </div>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-input pl-10 w-full rounded-lg border border-gray-300 bg-white px-3 py-3 text-gray-700 focus:border-blue-500 focus:outline-none transition-all duration-300"
                                    :class="{'bg-gray-700 border-gray-600 text-white placeholder-gray-400': darkMode}"
                                    placeholder="nama@email.com" autofocus autocomplete="email" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" :class="{'text-gray-300': darkMode, 'text-gray-700': !darkMode}">Password</label>
                            <div class="relative" x-data="{ show: false }">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock" :class="{'text-gray-400': !darkMode, 'text-gray-500': darkMode}"></i>
                                </div>
                                <input :type="show ? 'text' : 'password'" name="password"
                                    class="form-input pl-10 w-full rounded-lg border border-gray-300 bg-white px-3 py-3 text-gray-700 focus:border-blue-500 focus:outline-none transition-all duration-300"
                                    :class="{'bg-gray-700 border-gray-600 text-white placeholder-gray-400': darkMode}"
                                    placeholder="••••••••" />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" @click="show = !show" class="text-gray-400 hover:text-gray-600 focus:outline-none" :class="{'hover:text-gray-300': darkMode}">
                                        <i class="fas" :class="{'fa-eye': !show, 'fa-eye-slash': show}"></i>
                                    </button>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" name="remember" class="custom-checkbox" :class="{'bg-gray-700 border-gray-600': darkMode}">
                                <label for="remember" class="ml-2 block text-sm" :class="{'text-gray-300': darkMode, 'text-gray-700': !darkMode}">Ingat saya</label>
                            </div>

                            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors" :class="{'text-blue-400 hover:text-blue-300': darkMode}">
                                Lupa password?
                            </a>
                        </div>

                        <button type="submit" class="login-btn w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white focus:outline-none">
                            <i class="fas fa-sign-in-alt mr-2"></i> MASUK
                        </button>
                    </form>

                    <div class="mt-6 flex items-center justify-center" data-aos="fade-up" data-aos-delay="600">
                        <div class="flex-grow border-t border-gray-300" :class="{'border-gray-700': darkMode}"></div>
                        <span class="mx-4 text-xs text-gray-500" :class="{'text-gray-400': darkMode}">ATAU MASUK DENGAN</span>
                        <div class="flex-grow border-t border-gray-300" :class="{'border-gray-700': darkMode}"></div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3" data-aos="fade-up" data-aos-delay="700">
                        <button type="button" class="inline-flex justify-center items-center px-4 py-2 rounded-lg border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none transition-all duration-300"
                            :class="{'bg-gray-700 border-gray-600 text-gray-200 hover:bg-gray-600': darkMode}">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            Google
                        </button>
                        <button type="button" class="inline-flex justify-center items-center px-4 py-2 rounded-lg border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none transition-all duration-300"
                            :class="{'bg-gray-700 border-gray-600 text-gray-200 hover:bg-gray-600': darkMode}">
                            <i class="fab fa-microsoft text-blue-500 mr-2"></i>
                            Microsoft
                        </button>
                    </div>

                    <div class="text-center text-xs text-gray-500 mt-8" :class="{'text-gray-400': darkMode}">
                        <p>LPPM Universitas Bengkulu &copy; 2025</p>
                    </div>
                </div>

                <!-- Kanan: File Downloads & Info -->
                <div class="w-full md:w-3/5 animated-gradient text-white p-8 relative overflow-hidden">
                    <!-- Wave Animation -->
                    <div class="wave"></div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-3 gap-4 mb-8" data-aos="fade-up" data-aos-delay="300">
                        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-4 border border-white border-opacity-10">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-blue-100">Total Audit</p>
                                    <h3 class="text-2xl font-bold">256</h3>
                                </div>
                                <div class="bg-blue-500 bg-opacity-20 p-3 rounded-lg">
                                    <i class="fas fa-chart-bar text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-4 border border-white border-opacity-10">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-blue-100">Pengguna Aktif</p>
                                    <h3 class="text-2xl font-bold">127</h3>
                                </div>
                                <div class="bg-blue-500 bg-opacity-20 p-3 rounded-lg">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-4 border border-white border-opacity-10">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-blue-100">Unduhan</p>
                                    <h3 class="text-2xl font-bold">1.4K</h3>
                                </div>
                                <div class="bg-blue-500 bg-opacity-20 p-3 rounded-lg">
                                    <i class="fas fa-download text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- File Downloads -->
                    <div class="relative mb-8" data-aos="fade-up" data-aos-delay="400">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold flex items-center">
                                <i class="fas fa-file-download mr-2"></i> Dokumen Terkait
                            </h2>
                            <a href="#" class="text-xs font-medium text-blue-100 hover:text-white flex items-center">
                                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>

                        <!-- Swiper Slider -->
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <!-- File 1 -->
                                <div class="swiper-slide">
                                    <div class="file-card w-full">
                                        <div class="file-card-inner p-4">
                                            <div class="relative">
                                                <span class="badge-new">Baru</span>
                                                <div class="bg-red-500 bg-opacity-20 p-4 rounded-lg flex justify-center mb-3">
                                                    <i class="fas fa-file-pdf text-4xl"></i>
                                                </div>
                                                <h3 class="font-medium text-center">Panduan Audit Mu
