<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">

    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/output.css') }}">
    <!-- alpine js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
    <!-- flag icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css" rel="stylesheet">
    <!-- aos -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- lottie -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <style>
        .custom-link {
            text-decoration: none;
        }

        .custom-link:hover {
            text-decoration: none;
        }

        .custom-link::after {
            content: "";
            display: block;
            width: 0;
            height: 2px;
            background-color: #2563EB;
            margin-top: 5px;
            transition: width 0.3s;
        }

        .custom-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-slate-500 bg-pat">
    <main class="transition-all duration-200 ease-soft-in-out h-full">
        <div class="relative grid h-screen place-items-center overflow-hidden bg-center bg-cover">
            <div class="container z-10">
                <div class="flex">
                    <!-- Kiri: Form -->
                    <div class="flex flex-col w-full mx-auto md:w-1/3 justify-center my-auto transition-all duration-500 transform hover:scale-[1.01] hover:shadow-2xl">
                        <div class="flex flex-col bg-transparent border-0 shadow-none rounded-2xl">
                            <div class="pb-0 mb-0 bg-transparent border-b-0 rounded-t-2xl w-full text-center">
                                <h3 class="mb-4 md:text-3xl text-2xl text-transparent bg-gradient-to-tl from-black to-blue-500 font-bold bg-clip-text">
                                    SILAHKAN LOGIN DI SINI <br> ADAPTIF E-LEARNING SYSTEM
                                </h3>
                                <img src="{{ asset('assets/src/images/logo_unib.png') }}" class="h-32 mx-auto mb-4" alt="logo">
                            </div>

                            <div class="flex-auto pb-6 pl-6 pr-6 pt-0">
                                @if (session('success'))
                                    <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-lg">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                                    <div class="mb-4">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="focus:shadow-md focus:shadow-blue-500 text-sm block w-full appearance-none rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 transition-all focus:border-blue-500 focus:outline-none"
                                            placeholder="Email" autofocus autocomplete="email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
                                    <div class="mb-4">
                                        <input type="password" name="password"
                                            class="focus:shadow-md focus:shadow-blue-500 text-sm block w-full appearance-none rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 transition-all focus:border-blue-500 focus:outline-none"
                                            placeholder="Password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div class="text-center">
                                        <button type="submit"
                                            class="inline-block w-full px-6 py-3 mt-6 font-bold text-white uppercase rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-blue-400 hover:scale-105 hover:shadow-lg transition-all duration-200">
                                            LOGIN
                                        </button>

                                    </div>
                                </form>
                            </div>

                            <div class="pb-0 mb-0 bg-transparent border-b-0 rounded-t-2xl w-full text-center">
                                <h4 class="mb-4 text-transparent bg-gradient-to-tl from-black to-blue-500 font-bold bg-clip-text">
                                    SISTEM INFORMASI AUDIT MUTU INTERNAL <br>LPPM UNIVERSITAS BENGKULU
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Animasi -->
                    <div class="w-full md:w-2/3">
                        <div class="absolute top-0 hidden w-full h-full overflow-hidden -skew-x-12 ml-20 md:block bg-[#152042]"
                            style="filter: drop-shadow(0px 0px 20px #666);">
                            <div class="absolute inset-x-0 top-0 z-0 h-full -ml-16 bg-cover skew-x-10">
                                <div class="bg-gray-900 w-full h-full opacity-50"></div>
                            </div>
                        </div>
                        <lottie-player src="{{ asset('assets/src/images/animation.json') }}" background="transparent" speed="1"
                            class="w-10/12 h-10/12 ml-20 mt-10" loop autoplay></lottie-player>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
