<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIAMI UNIB</title>
    <link rel="shortcut icon" href="{{ asset('assets/src/images/logo_unib.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%232563eb' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .floating-shapes div {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.3) 0%, rgba(37, 99, 235, 0.1) 100%);
            animation: float 15s infinite ease-in-out;
        }

        .floating-shapes div:nth-child(1) {
            top: 10%;
            left: 10%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }

        .floating-shapes div:nth-child(2) {
            top: 60%;
            right: 10%;
            width: 60px;
            height: 60px;
            animation-delay: 2s;
        }

        .floating-shapes div:nth-child(3) {
            bottom: 10%;
            left: 20%;
            width: 50px;
            height: 50px;
            animation-delay: 4s;
        }

        .floating-shapes div:nth-child(4) {
            top: 30%;
            right: 15%;
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

        .primary-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            transition: all 0.3s ease;
        }

        .primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }

        .secondary-btn {
            transition: all 0.3s ease;
        }

        .secondary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="m-0 font-sans antialiased text-slate-600 bg-pattern min-h-screen flex items-center justify-center p-4">
    <div class="floating-shapes">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <main class="container mx-auto px-4">
        <div class="bg-white rounded-3xl overflow-hidden shadow-2xl max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row">
                <!-- Kiri: Content Error -->
                <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                    <!-- Logo -->
                    <div class="text-center mb-6">
                        <div class="flex justify-center items-center gap-4 mb-4">
                            <img src="{{ asset('assets/src/images/logo_unib.png') }}" class="h-16 md:h-20" alt="logo UNIB">
                            <img src="{{ asset('assets/src/images/pppep.png') }}" class="h-16 md:h-20" alt="logo PPPEP">
                        </div>
                        <h2 class="text-xl font-bold text-blue-600">SINTAMU LPMPP UNIB</h2>
                        <p class="text-xs text-gray-500">Sistem Integrasi Mutu UNIB</p>
                    </div>

                    <!-- Error Code -->
                    <div class="text-center mb-4">
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-bold @yield('badge-class', 'bg-blue-100 text-blue-600')">
                            <i class="@yield('badge-icon', 'fas fa-exclamation-circle') mr-2"></i>
                            Error @yield('code')
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 text-center mb-3">
                        @yield('title')
                    </h1>

                    <!-- Description -->
                    <p class="text-gray-600 text-center mb-6 leading-relaxed">
                        @yield('description')
                    </p>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        @yield('buttons')
                    </div>

                    <!-- Footer -->
                    <div class="text-center text-sm text-gray-500 pt-6 mt-6 border-t">
                        <p>LPMPP Universitas Bengkulu &copy; {{ date('Y') }}</p>
                    </div>
                </div>

                <!-- Kanan: Info Panel (mirip login) -->
                <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-600 to-blue-900 text-white p-8 md:p-12 relative overflow-hidden">
                    <!-- Pattern overlay -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <defs>
                                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                                    <circle cx="5" cy="5" r="1" fill="white"/>
                                </pattern>
                            </defs>
                            <rect width="100" height="100" fill="url(#grid)"/>
                        </svg>
                    </div>

                    <div class="relative z-10 flex flex-col h-full justify-center">
                        <!-- Error Icon Large -->
                        <div class="text-center mb-8">
                            <div class="inline-flex items-center justify-center w-24 h-24 md:w-32 md:h-32 rounded-full bg-white bg-opacity-20 mb-4">
                                <span class="text-5xl md:text-7xl font-bold">@yield('code')</span>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-white bg-opacity-15 backdrop-blur-sm border-l-4 @yield('border-color', 'border-orange-400') p-5 rounded-lg">
                            <div class="flex items-start">
                                <div class="@yield('icon-bg', 'bg-orange-400') rounded-full p-2 mr-4 text-white flex-shrink-0">
                                    <i class="@yield('info-icon', 'fas fa-info-circle') text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white mb-2">
                                        @yield('info-title', 'Apa yang terjadi?')
                                    </h3>
                                    <ul class="space-y-2 text-blue-100 text-sm">
                                        @yield('info-list')
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Help Section -->
                        <div class="mt-8">
                            <h3 class="font-medium text-lg mb-3">Butuh bantuan?</h3>
                            <a href="mailto:lpmpp@unib.ac.id" class="inline-flex items-center w-full px-4 py-3 bg-white bg-opacity-20 backdrop-blur-sm rounded-lg hover:bg-opacity-30 transition">
                                <i class="fas fa-envelope text-lg mr-3"></i>
                                <div>
                                    <span class="font-medium block">Hubungi Admin</span>
                                    <span class="text-xs text-blue-100">lpmpp@unib.ac.id</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
