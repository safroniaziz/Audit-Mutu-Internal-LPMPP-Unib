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

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%232563eb' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .download-item {
            transition: all 0.3s ease;
        }

        .download-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        }

        .login-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }

        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .floating-shapes div {
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.3) 0%, rgba(37, 99, 235, 0.1) 100%);
            animation: float 15s infinite ease-in-out;
        }

        .floating-shapes div:nth-child(1) {
            top: 10%;
            left: 70%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }

        .floating-shapes div:nth-child(2) {
            top: 60%;
            left: 80%;
            width: 60px;
            height: 60px;
            animation-delay: 2s;
        }

        .floating-shapes div:nth-child(3) {
            top: 80%;
            left: 60%;
            animation-delay: 4s;
        }

        .floating-shapes div:nth-child(4) {
            top: 30%;
            left: 80%;
            width: 70px;
            height: 70px;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.5;
            }
            50% {
                transform: translateY(-20px) rotate(10deg);
                opacity: 0.8;
            }
        }

        /* Animasi untuk garis dan titik SVG */
        .network-path {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: dash 30s linear infinite;
        }

        @keyframes dash {
            0% {
                stroke-dashoffset: 1000;
            }
            50% {
                stroke-dashoffset: 0;
            }
            100% {
                stroke-dashoffset: -1000;
            }
        }

        .network-dot {
            animation: pulse 3s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.3);
                opacity: 0.7;
            }
        }

        /* Variasi animasi untuk titik-titik */
        .network-dot:nth-child(1) { animation-delay: 0.1s; }
        .network-dot:nth-child(2) { animation-delay: 0.3s; }
        .network-dot:nth-child(3) { animation-delay: 0.5s; }
        .network-dot:nth-child(4) { animation-delay: 0.7s; }
        .network-dot:nth-child(5) { animation-delay: 0.9s; }
        .network-dot:nth-child(6) { animation-delay: 1.1s; }
        .network-dot:nth-child(7) { animation-delay: 1.3s; }
        .network-dot:nth-child(8) { animation-delay: 1.5s; }
        .network-dot:nth-child(9) { animation-delay: 1.7s; }
        .network-dot:nth-child(10) { animation-delay: 1.9s; }
        .network-dot:nth-child(11) { animation-delay: 2.1s; }
        .network-dot:nth-child(12) { animation-delay: 2.3s; }

        /* Animasi untuk latar belakang floating */
        .floating-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            overflow: hidden;
        }

        .floating-bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(1px);
            animation: float-bubble 15s infinite ease-in-out;
        }

        @keyframes float-bubble {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            25% {
                transform: translate(10px, -30px) scale(1.05);
            }
            50% {
                transform: translate(20px, 0) scale(0.95);
            }
            75% {
                transform: translate(-10px, 30px) scale(1.02);
            }
        }

        <style>
    /* Custom scrollbar untuk container dokumen */
    .documents-container::-webkit-scrollbar {
        width: 5px;
    }

    .documents-container::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }

    .documents-container::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 10px;
    }

    .documents-container::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    /* Transisi smooth untuk ukuran padding */
    .download-item {
        transition: all 0.3s ease;
    }

    </style>
</head>

<body class="m-0 font-sans antialiased font-normal text-slate-600 bg-pattern min-h-screen flex items-center justify-center">
    <div class="floating-shapes">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden shadow-2xl max-w-7xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
            <!-- Kiri: Form -->
            <div class="w-full md:w-2/5 p-8 flex flex-col justify-center space-y-6">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/src/images/logo_unib.png') }}" class="h-24 mx-auto mb-2" alt="logo">
                    <h2 class="text-2xl font-bold text-blue-600">SIAMI LPPM UNIB</h2>
                    <p class="text-sm text-gray-500">Sistem Informasi Audit Mutu Internal</p>
                </div>

                <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-l-4 border-blue-500 p-5 rounded-lg shadow-md" data-aos="fade-right" data-aos-delay="400">
                    <div class="flex items-start">
                        <div class="bg-blue-500 rounded-full p-2 mr-4 text-white flex-shrink-0">
                            <i class="fas fa-shield-alt text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-blue-800 mb-1">Akses Sistem</h3>
                            <p class="text-blue-700 leading-relaxed">Selamat datang, mohon masukkan email dan password anda untuk mengakses dashboard dan fitur sistem.</p>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="p-4 rounded-lg bg-green-50 border-l-4 border-green-500">
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 rounded-lg bg-red-50 border-l-4 border-red-500">
                        <p class="text-red-700">{{ session('error') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-input pl-10 w-full rounded-lg border border-gray-300 bg-white px-3 py-3 text-gray-700 focus:border-blue-500 focus:outline-none"
                                placeholder="nama@email.com" autofocus autocomplete="email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password"
                                class="form-input pl-10 w-full rounded-lg border border-gray-300 bg-white px-3 py-3 text-gray-700 focus:border-blue-500 focus:outline-none"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                        </div>

                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                            Lupa password?
                        </a>
                    </div>

                    <button type="submit" class="login-btn w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white focus:outline-none">
                        <i class="fas fa-sign-in-alt mr-2"></i> MASUK
                    </button>
                </form>

                <div class="text-center text-sm text-gray-500 pt-4 border-t">
                    <p>LPPM Universitas Bengkulu &copy; 2025</p>
                </div>
            </div>

            <!-- Kanan: File Downloads Section -->
            <div class="w-full md:w-3/5 bg-gradient-to-br from-blue-600 to-blue-900 text-white p-8 relative overflow-hidden">
                <!-- Latar belakang dengan gelembung animasi -->
                <div class="floating-bg">
                    <div class="floating-bubble" style="width: 150px; height: 150px; top: 10%; left: 10%; animation-delay: 0s;"></div>
                    <div class="floating-bubble" style="width: 100px; height: 100px; top: 40%; left: 70%; animation-delay: 2s;"></div>
                    <div class="floating-bubble" style="width: 80px; height: 80px; top: 80%; left: 20%; animation-delay: 4s;"></div>
                    <div class="floating-bubble" style="width: 120px; height: 120px; top: 60%; left: 80%; animation-delay: 6s;"></div>
                    <div class="floating-bubble" style="width: 70px; height: 70px; top: 30%; left: 40%; animation-delay: 8s;"></div>
                    <div class="floating-bubble" style="width: 90px; height: 90px; top: 70%; left: 50%; animation-delay: 10s;"></div>
                </div>

                <!-- Network SVG dengan animasi -->
                <div class="absolute top-0 left-0 w-full h-full opacity-20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 800">
                        <g fill="none" stroke="#FFF" stroke-width="1.5">
                            <path class="network-path" d="M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63"></path>
                            <path class="network-path" d="M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764" style="animation-delay: 0.5s"></path>
                            <path class="network-path" d="M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880" style="animation-delay: 1s"></path>
                            <path class="network-path" d="M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382" style="animation-delay: 1.5s"></path>
                            <path class="network-path" d="M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269" style="animation-delay: 2s"></path>
                        </g>
                        <g fill="#FFF">
                            <circle class="network-dot" cx="769" cy="229" r="5"></circle>
                            <circle class="network-dot" cx="539" cy="269" r="5"></circle>
                            <circle class="network-dot" cx="603" cy="493" r="5"></circle>
                            <circle class="network-dot" cx="731" cy="737" r="5"></circle>
                            <circle class="network-dot" cx="520" cy="660" r="5"></circle>
                            <circle class="network-dot" cx="309" cy="538" r="5"></circle>
                            <circle class="network-dot" cx="295" cy="764" r="5"></circle>
                            <circle class="network-dot" cx="40" cy="599" r="5"></circle>
                            <circle class="network-dot" cx="102" cy="382" r="5"></circle>
                            <circle class="network-dot" cx="127" cy="80" r="5"></circle>
                            <circle class="network-dot" cx="370" cy="105" r="5"></circle>
                            <circle class="network-dot" cx="578" cy="42" r="5"></circle>
                        </g>
                    </svg>
                </div>

                <div class="relative z-10">
                    <h2 class="text-3xl font-bold mb-8">Dokumen Terkait</h2>

                    <div class="space-y-5" data-aos="fade-up" data-aos-delay="300">
                        <div class="download-item flex items-center bg-white bg-opacity-10 backdrop-blur-sm p-4 rounded-xl hover:cursor-pointer">
                            <div class="mr-4 bg-white rounded-lg p-3 text-blue-600">
                                <i class="fas fa-file-pdf text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium">Panduan Audit Mutu Internal</h3>
                                <p class="text-xs text-blue-100">PDF - 2.4 MB</p>
                            </div>
                            <a href="#" class="download-btn bg-white text-blue-600 rounded-lg p-2 hover:bg-blue-50 transition">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>

                        <div class="download-item flex items-center bg-white bg-opacity-10 backdrop-blur-sm p-4 rounded-xl hover:cursor-pointer">
                            <div class="mr-4 bg-white rounded-lg p-3 text-blue-600">
                                <i class="fas fa-file-excel text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium">Format Instrumen AMI 2025</h3>
                                <p class="text-xs text-blue-100">Excel - 1.2 MB</p>
                            </div>
                            <a href="#" class="download-btn bg-white text-blue-600 rounded-lg p-2 hover:bg-blue-50 transition">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>

                        <div class="download-item flex items-center bg-white bg-opacity-10 backdrop-blur-sm p-4 rounded-xl hover:cursor-pointer">
                            <div class="mr-4 bg-white rounded-lg p-3 text-blue-600">
                                <i class="fas fa-file-word text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium">Template Laporan Hasil AMI</h3>
                                <p class="text-xs text-blue-100">Word - 652 KB</p>
                            </div>
                            <a href="#" class="download-btn bg-white text-blue-600 rounded-lg p-2 hover:bg-blue-50 transition">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>

                        <div class="download-item flex items-center bg-white bg-opacity-10 backdrop-blur-sm p-4 rounded-xl hover:cursor-pointer">
                            <div class="mr-4 bg-white rounded-lg p-3 text-blue-600">
                                <i class="fas fa-file-powerpoint text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium">Presentasi Sosialisasi AMI</h3>
                                <p class="text-xs text-blue-100">PowerPoint - 3.8 MB</p>
                            </div>
                            <a href="#" class="download-btn bg-white text-blue-600 rounded-lg p-2 hover:bg-blue-50 transition">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>

                    <div class="mt-10" data-aos="fade-up" data-aos-delay="350">
                        <h3 class="font-medium text-lg mb-3">Butuh bantuan?</h3>
                        <div class="space-y-3">
                            <a href="https://wa.me/6281234567890" class="help-btn inline-flex items-center w-full px-4 py-3 bg-white bg-opacity-20 backdrop-blur-sm rounded-lg hover:bg-opacity-30 transition">
                                <i class="fab fa-whatsapp text-lg mr-3"></i>
                                <div>
                                    <span class="font-medium block">Admin SIAMI - Budi Santoso</span>
                                    <span class="text-xs text-blue-100">+62 812-3456-7890</span>
                                </div>
                            </a>
                            <a href="tel:+627412345678" class="help-btn inline-flex items-center w-full px-4 py-3 bg-white bg-opacity-20 backdrop-blur-sm rounded-lg hover:bg-opacity-30 transition">
                                <i class="fas fa-phone-alt text-lg mr-3"></i>
                                <div>
                                    <span class="font-medium block">Sekretariat LPPM UNIB</span>
                                    <span class="text-xs text-blue-100">+62 741-2345-678</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- aos -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init();

            // Animasi tambahan untuk network dots
            const dots = document.querySelectorAll('.network-dot');

            // Animasi gelembung latar belakang tambahan
            generateFloatingBubbles();
        });

        // Fungsi untuk membuat gelembung acak tambahan di latar belakang
        function generateFloatingBubbles() {
            const floatingBg = document.querySelector('.floating-bg');
            const bubbleCount = 10;

            for (let i = 0; i < bubbleCount; i++) {
                const size = Math.random() * 40 + 20; // 20-60px
                const bubble = document.createElement('div');
                bubble.classList.add('floating-bubble');
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.top = `${Math.random() * 100}%`;
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.animationDelay = `${Math.random() * 15}s`;
                bubble.style.animationDuration = `${15 + Math.random() * 15}s`;
                bubble.style.opacity = `${Math.random() * 0.3}`;

                floatingBg.appendChild(bubble);
            }
        }
    </script>
</body>

</html>
