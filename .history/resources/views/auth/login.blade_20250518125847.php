<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIAMI LPPM UNIB - Login</title>
    <link rel="shortcut icon" href="{{ asset('assets/src/images/logo_unib.png') }}">

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

        .documents-container {
            /* Remove max-height restrictions */
            max-height: none !important;
            overflow-y: visible !important;
        }

        /* Improve the document items to fit better */
        .download-item {
            transition: all 0.3s ease;
            margin-bottom: 0.5rem; /* Consistent spacing */
        }

        /* Ensure the right side content takes full height */
        @media (min-width: 768px) {
            .w-full.md\:w-3\/5 {
                display: flex;
                flex-direction: column;
                min-height: 100%;
            }

            .w-full.md\:w-3\/5 > .relative {
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            /* Fix positioning for the help section */
            .mt-auto {
                margin-top: auto !important;
            }
        }

        /* Animasi hover yang lebih halus */
        .download-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
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

            <!-- Changes to the right panel layout -->
            <div class="w-full md:w-3/5 bg-gradient-to-br from-blue-600 to-blue-900 text-white p-8 relative overflow-hidden">
                <!-- Particle Network Canvas -->
                <canvas id="particle-network" class="absolute top-0 left-0 w-full h-full opacity-20 pointer-events-none"></canvas>

                <!-- Content -->
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <h2 class="text-3xl font-bold mb-5">Dokumen Terkait</h2>
                        <div class="documents-container" data-aos="fade-up" data-aos-delay="300">
                            <div class="space-y-2" id="documents-list">
                                @foreach ($dokumenAmis as $dokumen)
                                    <li class="download-item p-3 bg-white rounded shadow flex justify-between items-center">
                                        <span class="text-blue-700 font-medium">
                                            <i class="fas fa-file-alt mr-2"></i> {{ $dokumen['nama_dokumen'] }}
                                        </span>
                                        <a href="{{ $dokumen['path'] }}" target="_blank" class="text-blue-600 hover:underline">
                                            Download
                                        </a>
                                    </li>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto pt-6" data-aos="fade-up" data-aos-delay="350">
                        <h3 class="font-medium text-lg mb-3">Butuh bantuan?</h3>
                        <div class="space-y-3">
                            <a href="https://wa.me/6281234567890" class="help-btn inline-flex items-center w-full px-4 py-3 bg-white bg-opacity-20 backdrop-blur-sm rounded-lg hover:bg-opacity-30 transition">
                                <i class="fab fa-whatsapp text-lg mr-3"></i>
                                <div>
                                    <span class="font-medium block">Admin SIAMI - Budi Santoso</span>
                                    <span class="text-xs text-blue-100">+62 812-3456-7890</span>
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
    const canvas = document.getElementById('particle-network');
    const ctx = canvas.getContext('2d');

    // Mouse position tracking
    let mouseX = null;
    let mouseY = null;
    let isMouseInCanvas = false;

    canvas.addEventListener('mousemove', (e) => {
        const rect = canvas.getBoundingClientRect();
        mouseX = e.clientX - rect.left;
        mouseY = e.clientY - rect.top;
        isMouseInCanvas = true;
    });

    canvas.addEventListener('mouseleave', () => {
        isMouseInCanvas = false;
        mouseX = null;
        mouseY = null;
    });

    // Set canvas size
    function resizeCanvas() {
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
        initParticles();
    }

    // Particle class
    class Particle {
        constructor() {
            this.reset();
            this.baseSize = Math.random() * 2 + 1;
            this.size = this.baseSize;
            this.color = `hsl(${Math.random() * 60 + 200}, 80%, 60%)`; // Blueish colors
        }

        reset() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.speedX = Math.random() * 1 - 0.5;
            this.speedY = Math.random() * 1 - 0.5;
            this.originalSpeedX = this.speedX;
            this.originalSpeedY = this.speedY;
        }

        update() {
            // Boundary check with bounce
            if (this.x < 0 || this.x > canvas.width) {
                this.speedX *= -1;
                this.x = this.x < 0 ? 0 : canvas.width;
            }
            if (this.y < 0 || this.y > canvas.height) {
                this.speedY *= -1;
                this.y = this.y < 0 ? 0 : canvas.height;
            }

            // Mouse interaction
            if (isMouseInCanvas && mouseX !== null && mouseY !== null) {
                const dx = mouseX - this.x;
                const dy = mouseY - this.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < 150) {
                    // Repel particles from mouse
                    const forceDirectionX = dx / distance;
                    const forceDirectionY = dy / distance;
                    const force = (150 - distance) / 50;

                    this.x -= forceDirectionX * force;
                    this.y -= forceDirectionY * force;

                    // Scale particle size based on distance
                    this.size = this.baseSize * (1 + (1 - distance/150) * 2);
                } else {
                    this.size = this.baseSize;
                }
            }

            // Apply some random movement variation
            this.speedX = this.originalSpeedX + (Math.random() * 0.2 - 0.1);
            this.speedY = this.originalSpeedY + (Math.random() * 0.2 - 0.1);

            this.x += this.speedX;
            this.y += this.speedY;
        }

        draw() {
            // Draw glow effect
            const gradient = ctx.createRadialGradient(
                this.x, this.y, 0,
                this.x, this.y, this.size * 2
            );
            gradient.addColorStop(0, this.color);
            gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

            ctx.fillStyle = gradient;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size * 2, 0, Math.PI * 2);
            ctx.fill();

            // Draw core particle
            ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size * 0.6, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    // Create and manage particles
    let particles = [];
    const maxDistance = 150;

    function initParticles() {
        particles = [];
        const particleCount = Math.floor((canvas.width * canvas.height) / 5000); // Density based on canvas size

        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }
    }

    // Animation loop
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Update and draw particles
        particles.forEach(particle => {
            particle.update();
            particle.draw();
        });

        // Draw connections
        ctx.lineWidth = 0.8;

        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < maxDistance) {
                    const opacity = 1 - distance / maxDistance;
                    ctx.strokeStyle = `rgba(200, 230, 255, ${opacity * 0.4})`;

                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }

        requestAnimationFrame(animate);
    }

    // Initialize
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();
    animate();
});

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

        document.addEventListener('DOMContentLoaded', function() {
            // Data dokumen (bisa diubah jumlahnya)
            const documents = [
                {
                    icon: 'fas fa-file-pdf',
                    title: 'Panduan Audit Mutu Internal',
                    type: 'PDF',
                    size: '2.4 MB'
                },
                {
                    icon: 'fas fa-file-excel',
                    title: 'Format Instrumen AMI 2025',
                    type: 'Excel',
                    size: '1.2 MB'
                },
                {
                    icon: 'fas fa-file-word',
                    title: 'Template Laporan Hasil AMI',
                    type: 'Word',
                    size: '652 KB'
                },
                {
                    icon: 'fas fa-file-powerpoint',
                    title: 'Presentasi Sosialisasi AMI',
                    type: 'PowerPoint',
                    size: '3.8 MB'
                },
                {
                    icon: 'fas fa-file-powerpoint',
                    title: 'Presentasi Sosialisasi AMI',
                    type: 'PowerPoint',
                    size: '3.8 MB'
                },{
                    icon: 'fas fa-file-powerpoint',
                    title: 'Presentasi Sosialisasi AMI',
                    type: 'PowerPoint',
                    size: '3.8 MB'
                },{
                    icon: 'fas fa-file-powerpoint',
                    title: 'Presentasi Sosialisasi AMI',
                    type: 'PowerPoint',
                    size: '3.8 MB'
                },
                // Bisa ditambah atau dikurangi sesuai kebutuhan
            ];

            const documentsContainer = document.getElementById('documents-list');

            // Render dokumen
            renderDocuments(documents);

            function renderDocuments(docs) {
                const documentsContainer = document.getElementById('documents-list');
                documentsContainer.innerHTML = '';

                // Determine optimal spacing based on document count
                const totalDocs = docs.length;
                let paddingClass = 'p-4'; // Default padding
                let spacingClass = 'space-y-3'; // Default spacing

                // Set padding and spacing based on document count
                if (totalDocs > 4) {
                    paddingClass = 'p-3';
                    spacingClass = 'space-y-2';
                }
                if (totalDocs > 6) {
                    paddingClass = 'p-2.5';
                    spacingClass = 'space-y-2';
                }

                // Update container class
                documentsContainer.className = spacingClass;

                // Create document elements
                docs.forEach(doc => {
                    const docElement = document.createElement('div');
                    docElement.className = `download-item flex items-center bg-white bg-opacity-10 backdrop-blur-sm ${paddingClass} rounded-xl hover:cursor-pointer`;

                    docElement.innerHTML = `
                        <div class="mr-3 bg-white rounded-lg p-2 text-blue-600">
                            <i class="${doc.icon} text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-medium text-sm md:text-base">${doc.title}</h3>
                            <p class="text-xs text-blue-100">${doc.type} - ${doc.size}</p>
                        </div>
                        <a href="#" class="download-btn bg-white text-blue-600 rounded-lg p-2 hover:bg-blue-50 transition">
                            <i class="fas fa-download"></i>
                        </a>
                    `;

                    documentsContainer.appendChild(docElement);
                });

                // Call adjustLayout to ensure proper sizing
                adjustLayout();
            }

            // Improved layout adjustment function
            function adjustLayout() {
                const rightSection = document.querySelector('.w-full.md\\:w-3\\/5');
                const leftSection = document.querySelector('.w-full.md\\:w-2\\/5');

                if (window.innerWidth >= 768) {
                    // Make right section at least as tall as left section
                    rightSection.style.minHeight = leftSection.offsetHeight + 'px';

                    // Calculate available height for documents
                    const documentsContainer = document.querySelector('.documents-container');
                    const helpSection = document.querySelector('.mt-auto');
                    const titleSection = document.querySelector('.text-3xl.font-bold');

                    if (documentsContainer && helpSection && titleSection) {
                        // Calculate space between title and help section
                        const availableSpace = rightSection.offsetHeight -
                                            (titleSection.offsetHeight + helpSection.offsetHeight + 100); // 100px for padding/margins

                        // If content needs scrolling, set max-height
                        const contentHeight = documentsContainer.scrollHeight;

                        if (contentHeight > availableSpace) {
                            documentsContainer.style.maxHeight = availableSpace + 'px';
                            documentsContainer.style.overflowY = 'auto';
                            documentsContainer.style.paddingRight = '8px';
                        } else {
                            // Otherwise, let it flow naturally
                            documentsContainer.style.maxHeight = 'none';
                            documentsContainer.style.overflowY = 'visible';
                            documentsContainer.style.paddingRight = '0';
                        }
                    }
                } else {
                    // Mobile view
                    rightSection.style.minHeight = 'auto';
                    const documentsContainer = document.querySelector('.documents-container');
                    if (documentsContainer) {
                        documentsContainer.style.maxHeight = 'none';
                    }
                }
            }

            // Register window events
            window.addEventListener('load', adjustLayout);
            window.addEventListener('resize', adjustLayout);

            // Make functions available to the window scope if needed
            window.adjustLayout = adjustLayout;
            window.renderDocuments = renderDocuments;
        });
    </script>
</body>

</html>
