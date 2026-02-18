<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Sistem KTM - Matla Islamic University</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo-kampus.png') }}" type="image/x-icon">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Perbaikan untuk gambar agar tidak distorsi di mobile */
        .img-cover { object-position: center; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50 p-4">

<div class="w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

    <div class="relative w-full md:w-1/2 h-64 md:h-auto">
        <img
            src="{{ asset('images/login-campus.jpg') }}"
            alt="Kampus Matla"
            class="absolute inset-0 w-full h-full object-cover img-cover"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-green-900/90 via-black/20 to-transparent flex flex-col justify-end p-8">
            <h2 class="text-white text-2xl md:text-3xl font-bold leading-tight">
                Selamat Datang di <br> Matla Islamic University
            </h2>
            <p class="text-gray-200 text-sm mt-2 hidden md:block">
                Sistem Informasi Akademik Terintegrasi
            </p>
        </div>
    </div>

    <div class="w-full md:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center">

        <div class="flex flex-col items-center mb-8">
            <img
                src="{{ asset('images/logo-kampus.png') }}"
                alt="Logo Kampus"
                class="h-20 md:h-24 w-auto mb-4 drop-shadow-sm"
            >
            <h3 class="text-xl font-bold text-gray-800 text-center">Masuk ke Akun Anda</h3>
            <p class="text-sm text-gray-500 text-center">Gunakan akun official Matla untuk akses penuh</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-100 flex items-start gap-3 animate-pulse">
                <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span class="text-sm text-red-600 font-medium">{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email / Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 text-sm transition shadow-sm placeholder-gray-400"
                        placeholder="nama@matla.ac.id"
                    >
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 text-sm transition shadow-sm placeholder-gray-400"
                        placeholder="••••••••"
                    >
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 cursor-pointer">
                        <svg id="eye-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg id="eye-slash-icon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                    <script>
                        function togglePassword() {
                            const passwordInput = document.getElementById('password');
                            const eyeIcon = document.getElementById('eye-icon');
                            const eyeSlashIcon = document.getElementById('eye-slash-icon');
                            
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                eyeIcon.classList.add('hidden');
                                eyeSlashIcon.classList.remove('hidden');
                            } else {
                                passwordInput.type = 'password';
                                eyeIcon.classList.remove('hidden');
                                eyeSlashIcon.classList.add('hidden');
                            }
                        }
                    </script>
                </div>
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-gray-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-green-600 transition rounded border-gray-300 focus:ring-green-500">
                    <span class="ml-2">Ingat Saya</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="font-medium text-green-700 hover:text-green-600 hover:underline">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <button
                type="submit"
                class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-md text-sm font-semibold text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:-translate-y-0.5"
            >
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-400 italic">
                Sistem Informasi Terintegrasi &copy; {{ date('Y') }} Matla Islamic University.
            </p>
        </div>

    </div>
</div>

</body>
</html>