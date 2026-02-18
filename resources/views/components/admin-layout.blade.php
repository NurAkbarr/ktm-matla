<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KTM Digital - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo-kampus.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased" x-data="{ sidebarOpen: false }">

<div class="min-h-screen flex flex-col md:flex-row">

    <!-- OVERLAY FOR MOBILE SIDEBAR -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"></div>

    <!-- SIDEBAR -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 shadow-xl transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto md:shadow-none flex flex-col">
        
        <!-- Logo / Title -->
        <div class="h-20 flex items-center justify-center border-b border-gray-100 px-6">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo-kampus.png') }}" alt="Logo Kampus" class="h-10 w-auto object-contain">
                <div>
                    <h2 class="text-lg font-bold text-gray-800 leading-tight tracking-tight">
                        KTM Digital
                    </h2>
                    <p class="text-[10px] uppercase font-semibold text-gray-500 tracking-wider">
                        Admin Panel
                    </p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Main Menu</p>

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors duration-200
               {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>

            {{-- Data Mahasiswa --}}
            <a href="{{ route('admin.mahasiswa.index') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors duration-200
               {{ request()->routeIs('admin.mahasiswa.*') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.mahasiswa.*') ? 'text-green-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Data Mahasiswa
            </a>

        </nav>

        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center justify-between mb-4 px-2">
                <div class="flex items-center">
                    <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold text-xs uppercase">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700 truncate w-32">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- CONTENT AREA -->
    <div class="flex-1 flex flex-col min-w-0 bg-gray-50">

        <!-- TOPBAR (Mobile Toggle) -->
        <header class="bg-white shadow-sm border-b border-gray-100 h-16 flex items-center justify-between px-4 md:px-6 lg:px-8">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none focus:text-gray-700 md:hidden p-2 rounded-md hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-xl font-bold text-gray-800 ml-2 md:ml-0">
                    Dashboard Overview
                </h1>
            </div>

            <div class="flex items-center space-x-4">
               <!-- You can add notifications or other header items here -->
               <div class="text-sm text-gray-400 hidden md:block">Welcome back, {{ auth()->user()->name }}</div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-4 md:p-8 overflow-y-auto">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-white border-t border-gray-100 py-4 px-6 text-center md:text-left">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} KTM Digital. All rights reserved.</p>
        </footer>

    </div>

</div>

</body>
</html>
