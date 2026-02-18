<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light dark">
    <link rel="shortcut icon" href="{{ asset('images/logo-kampus.png') }}" type="image/x-icon">

    <title>Profil Mahasiswa - {{ $mahasiswa->nama }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* background-color removed to allow Tailwind classes to control theme */
        }
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-100 antialiased min-h-screen flex justify-center"
      x-data="{ 
          darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
          openModal: false, 
          activeItem: null,
          init() {
              // Apply initial state
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
              } else {
                  document.documentElement.classList.remove('dark');
              }
              
              // Watch for changes
              this.$watch('darkMode', val => {
                  localStorage.theme = val ? 'dark' : 'light';
                  if (val) {
                      document.documentElement.classList.add('dark');
                  } else {
                      document.documentElement.classList.remove('dark');
                  }
              });
          },
          showDetail(item) {
              this.activeItem = item;
              this.openModal = true;
          }
      }">

    <!-- Mobile App Container -->
    <div class="w-full max-w-md bg-gray-50 dark:bg-gray-900 min-h-screen shadow-2xl relative overflow-x-hidden flex flex-col transition-colors duration-300">
        
        <!-- HEADER -->
        <div class="bg-white dark:bg-gray-900 px-6 py-4 flex justify-between items-center shadow-sm sticky top-0 z-40 border-b border-gray-100 dark:border-gray-800 transition-colors duration-300">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-kampus.png') }}"
                     alt="MATLA Logo" 
                     class="h-8 w-auto object-contain">
                <span class="font-bold text-gray-800 dark:text-white text-lg tracking-wide">MATLA</span>
            </div>
            
            <div class="flex items-center gap-2">
                <!-- Dark Mode Toggle -->
                <button type="button" 
                    class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 focus:outline-none transition-colors"
                    @click="darkMode = !darkMode">
                    <!-- Sun Icon (Show when Dark) -->
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <!-- Moon Icon (Show when Light) -->
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                @if (Route::has('login'))
                    <nav>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                {{-- Jika Admin, arahkan ke edit data mahasiswa ini --}}
                                <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" class="p-2 rounded-full bg-blue-50 hover:bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-900/50 transition-colors" title="Edit Data (Admin)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            @elseif(Auth::user()->id === $mahasiswa->user_id)
                                 {{-- Jika Pemilik Profil, arahkan ke edit profil sendiri --}}
                                <a href="{{ url('/ktm/mahasiswa/profil') }}" class="p-2 rounded-full bg-green-50 hover:bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-900/50 transition-colors" title="Edit Profil Saya">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            @else
                                {{-- Jika user lain (Ahmad scan Abid), tawarkan ganti akun --}}
                                <div class="flex gap-2">
                                    <a href="{{ route('dashboard') }}" class="p-2 rounded-full bg-gray-50 hover:bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors" title="Ke Dashboard Saya">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="p-2 rounded-full bg-red-50 hover:bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50 transition-colors" title="Keluar / Ganti Akun" onclick="return confirm('Apakah Anda ingin keluar untuk login ke akun ini?');">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="p-2 rounded-full bg-gray-50 hover:bg-gray-100 text-green-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors" title="Masuk">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                            </a>
                        @endauth
                    </nav>
                @endif
            </div>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar">
            <div class="px-5 py-6 space-y-5 pb-24">
                
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Profil Mahasiswa</h1>

                <!-- PROFIL UTAMA CARD -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <!-- Foto Profil -->
                        <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-gray-100 dark:border-gray-700 flex-shrink-0 bg-gray-200 dark:bg-gray-700 group relative">
                            <a href="{{ route('login') }}" class="block w-full h-full relative">
                                 @if($mahasiswa->profil && $mahasiswa->profil->foto)
                                    <img src="{{ asset('storage/' . $mahasiswa->profil->foto) }}"
                                    class="w-full h-full object-cover group-hover:opacity-80 transition-opacity">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 group-hover:bg-gray-300 transition-colors">
                                        👤
                                    </div>
                                @endif
                                
                                <!-- Edit Hint Overlay -->
                                <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Info Dasar -->
                        <div class="flex-1 min-w-0">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white truncate">{{ $mahasiswa->nama }}</h2>
                            <p class="text-sm text-gray-500 truncate">NIM: {{ $mahasiswa->nim }}</p>
                            <p class="text-xs text-gray-400 mt-1 truncate font-medium">{{ $mahasiswa->prodi }}</p>
                        </div>
                    </div>

                    <!-- Badges Status -->
                    <div class="mt-5 flex flex-wrap items-center gap-2">
                        @if($mahasiswa->status === 'aktif')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-green-700 text-white shadow-sm tracking-wide">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                AKTIF
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-red-600 text-white shadow-sm tracking-wide">
                                NONAKTIF
                            </span>
                        @endif

                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 border border-green-100 dark:border-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Profil Resmi Matla
                        </span>

                        <button class="ml-auto p-2 rounded-xl text-gray-400 hover:text-green-600 hover:bg-green-50 transition-colors border border-transparent hover:border-green-100" title="Bagikan Profil">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- TENTANG SAYA CARD -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="text-base font-bold text-gray-800 dark:text-white mb-3">Tentang Saya</h3>
                    
                    @if($mahasiswa->profil && $mahasiswa->profil->tentang_saya)
                        <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ $mahasiswa->profil->tentang_saya }}
                        </p>
                    @else
                        <div class="text-center py-6 px-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-dashed border-gray-200 dark:border-gray-600">
                            <p class="text-xs text-gray-500 mb-2">Mahasiswa belum mengisi deskripsi diri.</p>
                            @guest
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-green-600 hover:text-green-700">
                                <span>Login untuk update profil</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            @endguest
                        </div>
                    @endif
                </div>

                <!-- SKILL CARD (Max 4) -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                         <h3 class="text-base font-bold text-gray-800 dark:text-white">Skill</h3>
                         @if($mahasiswa->skills->count() > 4)
                            <span class="text-[10px] bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 px-2 py-1 rounded-full">+{{ $mahasiswa->skills->count() - 4 }} Lainnya</span>
                         @endif
                    </div>

                    @if($mahasiswa->skills && $mahasiswa->skills->count())
                        <div class="flex flex-wrap gap-2">
                            @foreach($mahasiswa->skills->take(4) as $skill)
                                <div class="inline-flex items-center justify-between px-3 py-2 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $skill->nama_skill }}</span>
                                    <span class="ml-2 text-[10px] px-2 py-0.5 rounded bg-amber-50 text-amber-600 border border-amber-100 uppercase tracking-wide font-bold">
                                        {{ $skill->level }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-dashed border-gray-200 dark:border-gray-600">
                            <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">Belum ada skill</p>
                        </div>
                    @endif
                </div>

                <!-- KARYA & PORTOFOLIO CARD (Horizontal Scroll with Arrows) -->
                <div class="space-y-3">
                    <h3 class="text-base font-bold text-gray-800 dark:text-white px-1">Karya & Portofolio</h3>

                    @if($mahasiswa->portofolio && $mahasiswa->portofolio->count())
                        <!-- Wrapper for Arrows -->
                        <div class="relative group" x-data="{
                            scrollContainer: null,
                            showLeft: false,
                            showRight: true,
                            init() {
                                this.scrollContainer = $refs.container;
                                this.updateArrows();
                            },
                            scrollLeft() {
                                this.scrollContainer.scrollBy({ left: -this.scrollContainer.offsetWidth, behavior: 'smooth' });
                                setTimeout(() => this.updateArrows(), 300);
                            },
                            scrollRight() {
                                this.scrollContainer.scrollBy({ left: this.scrollContainer.offsetWidth, behavior: 'smooth' });
                                setTimeout(() => this.updateArrows(), 300);
                            },
                            updateArrows() {
                                if (!this.scrollContainer) return;
                                this.showLeft = this.scrollContainer.scrollLeft > 0;
                                this.showRight = Math.ceil(this.scrollContainer.scrollLeft + this.scrollContainer.offsetWidth) < this.scrollContainer.scrollWidth;
                            }
                        }">
                            
                            <!-- Left Arrow -->
                            @if($mahasiswa->portofolio->count() > 2)
                            <button @click="scrollLeft()" 
                                    x-show="showLeft"
                                    x-transition.opacity
                                    class="absolute left-2 top-1/2 -translate-y-1/2 z-20 bg-white/80 dark:bg-gray-800/80 p-2 rounded-full shadow-md text-gray-700 dark:text-gray-200 hover:bg-white dark:hover:bg-gray-800 hover:text-green-600 backdrop-blur-sm border border-gray-100 dark:border-gray-700"
                                    style="display: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            @endif

                            <!-- Horizontal Scroll Container -->
                            <div x-ref="container" 
                                 @scroll.debounce.50ms="updateArrows"
                                 class="flex overflow-x-auto gap-4 pb-4 px-1 snap-x no-scrollbar scroll-smooth">
                                 
                                @foreach($mahasiswa->portofolio as $item)
                                    <div class="flex-shrink-0 w-full snap-center bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700 cursor-pointer hover:shadow-md transition-all active:scale-[0.98]"
                                         @click='showDetail(@json($item))'>
                                        
                                        <!-- Thumbnail Placeholder -->
                                        <div class="h-48 w-full bg-gray-100 dark:bg-gray-700 rounded-xl mb-3 overflow-hidden flex items-center justify-center text-gray-300 dark:text-gray-500">
                                            @if($item->file && Str::endsWith($item->file, ['.jpg', '.jpeg', '.png']))
                                                <img src="{{ asset('storage/'.$item->file) }}" class="w-full h-full object-cover">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                        </div>

                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="px-2 py-0.5 bg-purple-100 text-purple-700 text-[10px] font-bold rounded uppercase">KARYA</span>
                                        </div>
                                        
                                        <h4 class="font-bold text-gray-800 dark:text-white text-base truncate">{{ $item->judul }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mt-1">{{ $item->deskripsi }}</p>
                                        
                                        <div class="mt-4 text-xs text-green-600 font-semibold flex items-center gap-1">
                                            Lihat Detail
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Right Arrow -->
                            @if($mahasiswa->portofolio->count() > 2)
                            <button @click="scrollRight()" 
                                    x-show="showRight"
                                    x-transition.opacity
                                    class="absolute right-2 top-1/2 -translate-y-1/2 z-20 bg-white/80 dark:bg-gray-800/80 p-2 rounded-full shadow-md text-gray-700 dark:text-gray-200 hover:bg-white dark:hover:bg-gray-800 hover:text-green-600 backdrop-blur-sm border border-gray-100 dark:border-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            @endif

                        </div>
                    @else
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 text-center border border-dashed border-gray-200 dark:border-gray-700 mx-1">
                             <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">Belum ada portofolio</p>
                        </div>
                    @endif
                </div>

                <!-- Footer Back Button -->
                <div class="fixed bottom-6 left-0 right-0 flex justify-center pointer-events-none z-30">
                    <button onclick="history.back()" class="pointer-events-auto bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm border border-gray-200 dark:border-gray-700 shadow-lg text-gray-600 dark:text-gray-200 hover:text-green-600 px-5 py-2.5 rounded-full text-sm font-medium flex items-center gap-2 transition-all hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </button>
                </div>
                
                 <!-- Copyright -->
                <div class="text-center text-[10px] text-gray-300 pt-4 pb-8">
                    &copy; {{ date('Y') }} MATLA Profile System
                </div>

            </div>
        </div>
    </div>


    <!-- MODAL DETAIL PORTOFOLIO -->
    <div x-show="openModal" 
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"
             x-show="openModal"
             x-transition.opacity
             @click="openModal = false"></div>

        <!-- Content -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl w-full max-w-sm relative z-10 overflow-hidden shadow-2xl flex flex-col max-h-[90vh]"
             x-show="openModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95">

            <!-- Close Button -->
            <button @click="openModal = false" class="absolute top-4 right-4 z-20 bg-black/20 hover:bg-black/40 text-white dark:text-gray-200 rounded-full p-1.5 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Image/File Preview -->
            <div class="h-64 bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden flex-shrink-0">
                <template x-if="activeItem?.file && (activeItem.file.endsWith('.jpg') || activeItem.file.endsWith('.jpeg') || activeItem.file.endsWith('.png'))">
                    <img :src="'/storage/' + activeItem.file" class="w-full h-full object-cover">
                </template>
                <template x-if="!activeItem?.file || !(activeItem.file.endsWith('.jpg') || activeItem.file.endsWith('.jpeg') || activeItem.file.endsWith('.png'))">
                     <div class="flex flex-col items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-xs font-medium">Dokumen / File</span>
                    </div>
                </template>
            </div>

            <!-- Body -->
            <div class="p-6 overflow-y-auto">
                <div class="mb-4">
                     <span class="px-2 py-0.5 bg-purple-100 text-purple-700 text-[10px] font-bold rounded uppercase">PORTOFOLIO</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" x-text="activeItem?.judul"></h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed mb-6" x-text="activeItem?.deskripsi || 'Tidak ada deskripsi.'"></p>

                <div class="space-y-3">
                    <!-- Download Button -->
                    <template x-if="activeItem?.file">
                        <a :href="'/storage/' + activeItem.file" 
                           download
                           target="_blank"
                           class="flex items-center justify-center gap-2 w-full py-3 bg-gray-900 text-white rounded-xl font-semibold text-sm hover:bg-gray-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download / Lihat File
                        </a>
                    </template>

                    <!-- Link Button -->
                    <template x-if="activeItem?.link">
                        <a :href="activeItem.link" 
                           target="_blank"
                           class="flex items-center justify-center gap-2 w-full py-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-xl font-semibold text-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Kunjungi Link Project
                        </a>
                    </template>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
