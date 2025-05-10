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
    <!-- Three.js for 3D effects -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.150.0/three.min.js"></script>
    <!-- GSAP for smooth animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            overflow-x: hidden;
        }

        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%232563eb' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .download-item {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 1;
        }

        .download-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.3);
        }

        .download-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%);
            border-radius: inherit;
            z-index: -1;
            transition: opacity 0.4s ease;
            opacity: 0;
        }

        .download-item:hover::before {
            opacity: 1;
        }

        .login-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .login-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.6s ease;
        }

        .login-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.4);
        }

        .login-btn:hover::after {
            left: 100%;
        }

        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            transform: scale(1.01);
        }

        /* Particle system */
        #particle-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.5;
        }

        /* 3D Network visualization */
        #network-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* Enhanced floating shapes */
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .floating-shapes div {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.3) 0%, rgba(37, 99, 235, 0.1) 100%);
            animation: float 20s infinite ease-in-out;
            filter: blur(3px);
        }

        .floating-shapes div:nth-child(1) {
            top: 10%;
            left: 70%;
            width: 120px;
            height: 120px;
            animation-delay: 0s;
        }

        .floating-shapes div:nth-child(2) {
            top: 60%;
            left: 80%;
            width: 80px;
            height: 80px;
            animation-delay: 2s;
        }

        .floating-shapes div:nth-child(3) {
            top: 80%;
            left: 60%;
            width: 60px;
            height: 60px;
            animation-delay: 4s;
        }

        .floating-shapes div:nth-child(4) {
            top: 30%;
            left: 80%;
            width: 100px;
            height: 100px;
            animation-delay: 6s;
        }

        .floating-shapes div:nth-child(5) {
            top: 70%;
            left: 10%;
            width: 90px;
            height: 90px;
            animation-delay: 8s;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.3) 0%, rgba(67, 56, 202, 0.1) 100%);
        }

        .floating-shapes div:nth-child(6) {
            top: 20%;
            left: 30%;
            width: 70px;
            height: 70px;
            animation-delay: 10s;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.3) 0%, rgba(55, 48, 163, 0.1) 100%);
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg) scale(1);
                opacity: 0.5;
            }
            25% {
                transform: translateY(-30px) rotate(10deg) scale(1.05);
                opacity: 0.8;
            }
            50% {
                transform: translateY(10px) rotate(-5deg) scale(0.95);
                opacity: 0.6;
            }
            75% {
                transform: translateY(-20px) rotate(15deg) scale(1.05);
                opacity: 0.7;
            }
        }

        /* Network SVG with enhanced animation */
        .network-path {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: dash 20s linear infinite;
            filter: drop-shadow(0 0 3px rgba(255, 255, 255, 0.5));
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
            animation: pulse 4s infinite ease-in-out;
            filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.7));
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.5);
                opacity: 0.7;
            }
        }

        /* Variasi animasi untuk titik-titik */
        .network-dot:nth-child(1) { animation-delay: 0.1s; }
        .network-dot:nth-child(2) { animation-delay: 0.4s; }
        .network-dot:nth-child(3) { animation-delay: 0.7s; }
        .network-dot:nth-child(4) { animation-delay: 1.0s; }
        .network-dot:nth-child(5) { animation-delay: 1.3s; }
        .network-dot:nth-child(6) { animation-delay: 1.6s; }
        .network-dot:nth-child(7) { animation-delay: 1.9s; }
        .network-dot:nth-child(8) { animation-delay: 2.2s; }
        .network-dot:nth-child(9) { animation-delay: 2.5s; }
        .network-dot:nth-child(10) { animation-delay: 2.8s; }
        .network-dot:nth-child(11) { animation-delay: 3.1s; }
        .network-dot:nth-child(12) { animation-delay: 3.4s; }

        /* Enhanced floating background */
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
            animation: float-bubble 25s infinite ease-in-out;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }

        @keyframes float-bubble {
            0%, 100% {
                transform: translate(0, 0) scale(1) rotate(0deg);
                opacity: 0.3;
            }
            25% {
                transform: translate(15px, -40px) scale(1.1) rotate(10deg);
                opacity: 0.6;
            }
            50% {
                transform: translate(30px, 0) scale(0.9) rotate(-5deg);
                opacity: 0.4;
            }
            75% {
                transform: translate(-15px, 40px) scale(1.05) rotate(15deg);
                opacity: 0.5;
            }
        }

        /* Document items animation */
        .download-btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .download-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: all 0.4s ease;
        }

        .download-btn:hover::before {
            left: 100%;
        }

        /* Interactive help buttons */
        .help-btn {
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .help-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.6s ease;
        }

        .help-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .help-btn:hover::after {
            left: 100%;
        }

        /* Card hovering effect */
        .hovering-card {
            animation: card-hover 6s ease-in-out infinite;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        @keyframes card-hover {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        /* Form input animation */
        .input-wrapper {
            position: relative;
            overflow: hidden;
        }

        .input-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #1e40af);
            transition: width 0.4s ease;
        }

        .input-wrapper:focus-within::after {
            width: 100%;
        }

        /* Loading dots animation for submit button */
        @keyframes loading-dots {
            0%, 80%, 100% { opacity: 0; }
            40% { opacity: 1; }
        }

        .loading-dots span {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: white;
            animation: loading-dots 1.4s infinite ease-in-out both;
        }

        .loading-dots span:nth-child(1) { animation-delay: -0.32s; }
        .loading-dots span:nth-child(2) { animation-delay: -0.16s; }

        /* Alert notification animation */
        .alert-notification {
            animation: slide-in 0.5s forwards, fade-out 0.5s forwards 5s;
            transform: translateX(100%);
        }

        @keyframes slide-in {
            to { transform: translateX(0); }
        }

        @keyframes fade-out {
            to { opacity: 0; }
        }

        /* Card flip effect */
        .card-3d-container {
            perspective: 1000px;
        }

        .card-3d {
            transition: transform 1s;
            transform-style: preserve-3d;
        }

        /* Responsive text glow effect */
        .text-glow {
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
            animation: text-pulse 4s infinite ease-in-out;
        }

        @keyframes text-pulse {
            0%, 100% {
                text-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
            }
            50% {
                text-shadow: 0 0 20px rgba(59, 130, 246, 0.8);
            }
        }

        /* Mouse trail effect */
        .mouse-trail {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            pointer-events: none;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.8) 0%, rgba(59, 130, 246, 0) 70%);
            transform: translate(-50%, -50%);
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        /* Wave loading animation */
        .wave-loading {
            display: inline-block;
            position: relative;
        }

        .wave-loading span {
            display: inline-block;
            width: 4px;
            height: 20px;
            margin: 0 2px;
            background-color: white;
            animation: wave-loading 1s infinite ease-in-out;
        }

        .wave-loading span:nth-child(1) { animation-delay: 0s; }
        .wave-loading span:nth-child(2) { animation-delay: 0.1s; }
        .wave-loading span:nth-child(3) { animation-delay: 0.2s; }
        .wave-loading span:nth-child(4) { animation-delay: 0.3s; }
        .wave-loading span:nth-child(5) { animation-delay: 0.4s; }

        @keyframes wave-loading {
            0%, 40%, 100% { transform: scaleY(0.4); }
            20% { transform: scaleY(1); }
        }

        /* Background gradient animation */
        .animated-gradient {
            background: linear-gradient(-45deg, #3b82f6, #1e40af, #4f46e5, #2563eb);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>

<body class="m-0 font-sans antialiased font-normal text-slate-600 bg-pattern min-h-screen flex items-center justify-center">
    <!-- Particles background -->
    <canvas id="particle-canvas"></canvas>

    <!-- Floating shapes with enhanced animations -->
    <div class="floating-shapes">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden shadow-2xl max-w-7xl mx-auto hovering-card" data-aos="fade-up" data-aos-duration="1200">
            <!-- Kiri: Form -->
            <div class="w-full md:w-2/5 p-8 flex flex-col justify-center space-y-6">
                <div class="text-center mb-4" data-aos="zoom-in" data-aos-delay="300">
                    <img src="{{ asset('assets/src/images/logo_unib.png') }}" class="h-24 mx-auto mb-2 animate-bounce-slow" alt="logo">
                    <h2 class="text-2xl font-bold text-blue-600 text-glow">SIAMI LPPM UNIB</h2>
                    <p class="text-sm text-gray-500">Sistem Informasi Audit Mutu Internal</p>
                </div>

                <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-l-4 border-blue-500 p-5 rounded-lg shadow-md" data-aos="fade-right" data-aos-delay="400">
                    <div class="flex items-start">
                        <div class="bg-blue-500 rounded-full p-2 mr-4 text-white flex-shrink-0 pulse-animation">
                            <i class="fas fa-shield-alt text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-blue-800 mb-1">Akses Sistem</h3>
                            <p class="text-blue-700 leading-relaxed">Selamat datang, mohon masukkan email dan password anda untuk mengakses dashboard dan fitur sistem.</p>
                        </div>
                    </div>
                </div>

                <div id="alert-container">
                    <!-- Dynamic alerts will appear here -->
                </div>

                <form id="login-form" method="POST" action="{{ route('login') }}" class="space-y-5" data-aos="fade-up" data-aos-delay="500">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="input-wrapper relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="form-input pl-10 w-full rounded-lg border border-gray-300 bg-white px-3 py-3 text-gray-700 focus:border-blue-500 focus:outline-none"
                                placeholder="nama@email.com" autofocus autocomplete="email" />
                            <div class="email-validation absolute right-3 top-3 hidden">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="input-wrapper relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" id="password" name="password"
                                class="form-input pl-10 w-full rounded-lg border border-gray-300 bg-white px-3 py-3 text-gray-700 focus:border-blue-500 focus:outline-none"
                                placeholder="••••••••" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer toggle-password">
                                <i class="fas fa-eye-slash text-gray-400"></i>
                            </div>
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

                    <button type="submit" id="login-button" class="login-btn w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white focus:outline-none">
                        <i class="fas fa-sign-in-alt mr-2"></i> MASUK
                        <div class="loading-dots hidden ml-2">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                </form>

                <div class="text-center text-sm text-gray-500 pt-4 border-t">
                    <p>LPPM Universitas Bengkulu &copy; 2025</p>
                </div>
            </div>

            <!-- Kanan: File Downloads Section -->
            <div class="w-full md:w-3/5 animated-gradient text-white p-8 relative overflow-hidden">
                <!-- 3D Network visualization -->
                <canvas id="network-canvas"></canvas>

                <!-- Latar belakang dengan gelembung animasi yang ditingkatkan -->
                <div class="floating-bg">
                    <div class="floating-bubble" style="width: 180px; height: 180px; top: 10%; left: 10%; animation-delay: 0s;"></div>
                    <div class="floating-bubble" style="width: 120px; height: 120px; top: 40%; left: 70%; animation-delay: 2s;"></div>
                    <div class="floating-bubble" style="width: 100px; height: 100px; top: 80%; left: 20%; animation-delay: 4s;"></div>
                    <div class="floating-bubble" style="width: 150px; height: 150px; top: 60%; left: 80%; animation-delay: 6s;"></div>
                    <div class="floating-bubble" style="width: 90px; height: 90px; top: 30%; left: 40%; animation-delay: 8s;"></div>
                    <div class="floating-bubble" style="width: 110px; height: 110px; top: 70%; left: 50%; animation-delay: 10s;"></div>
                    <div class="floating-bubble" style="width: 130px; height: 130px; top: 25%; left: 85%; animation-delay: 12s;"></div>
                    <div class="floating-bubble" style="width: 85px; height: 85px; top: 85%; left: 75%; animation-delay: 14s;"></div>
                </div>

                <!-- Network SVG dengan animasi yang ditingkatkan -->
                <div class="absolute top-0 left-0 w-full h-full opacity-20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 800">
                        <g fill="none" stroke="#FFF" stroke-width="2">
                            <path class="network-path" d="M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63"></path>
                            <path class="network-path" d="M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764" style="animation-delay: 0.5s"></path>
                            <path class="network-path" d="M520 660L578 842 731 737 840 599 603
