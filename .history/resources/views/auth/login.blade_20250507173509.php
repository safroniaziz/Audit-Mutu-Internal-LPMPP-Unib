<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | ALESI UNIB</title>
  <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="stylesheet" href="{{ asset('assets/output.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body class="bg-gray-100">
  <main class="h-screen flex items-center justify-center">
    <div class="bg-white shadow-2xl rounded-3xl w-full max-w-5xl flex overflow-hidden">

      <!-- Left (Form) -->
      <div class="w-full md:w-1/2 p-10">
        <div class="text-center mb-8">
          <img src="{{ asset('assets/src/images/logo_unib.png') }}" class="h-20 mx-auto" alt="UNIB Logo">
          <h1 class="text-2xl font-bold text-gray-800 mt-4 leading-tight">
            Adaptif E-Learning System<br><span class="text-blue-600">Universitas Bengkulu</span>
          </h1>
        </div>

        @if (session('success'))
          <div class="mb-4 p-3 text-green-700 bg-green-100 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
          <div class="mb-4 p-3 text-red-700 bg-red-100 rounded">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
              class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
              placeholder="Email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="text-red-500 text-sm mt-1" />
          </div>

          <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600">Password</label>
            <input type="password" name="password"
              class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
              placeholder="Password" required />
            <x-input-error :messages="$errors->get('password')" class="text-red-500 text-sm mt-1" />
          </div>

          <button type="submit"
            class="w-full py-2 mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
            Login
          </button>

        </form>
      </div>

      <!-- Right (Animation) -->
      <div class="hidden md:flex w-1/2 bg-blue-50 relative items-center justify-center p-6">
        <lottie-player src="{{ asset('assets/src/images/animation.json') }}" background="transparent" speed="1" loop autoplay class="w-full h-full"></lottie-player>
        <div class="absolute bottom-4 left-4 right-4 text-center">
          <p class="text-gray-700 font-semibold text-sm">
            Sistem Informasi Audit Mutu Internal<br><span class="text-blue-600">LPPM Universitas Bengkulu</span>
          </p>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
