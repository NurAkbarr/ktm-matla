<x-app-layout>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- WELCOME BANNER -->
        <div class="relative rounded-2xl bg-gradient-to-r from-green-600 to-teal-600 p-8 shadow-xl overflow-hidden">

            <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-white opacity-10 rounded-full blur-3xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">

                <div class="flex items-center gap-6">
                    <div class="bg-white/20 p-3 rounded-2xl backdrop-blur-sm">
                        <img src="{{ asset('images/logo-kampus.png') }}" class="h-16 w-auto object-contain">
                    </div>

                    <div class="text-white text-center md:text-left">
                        <h1 class="text-2xl md:text-3xl font-bold">
                            Selamat Datang, {{ explode(' ', $mahasiswa->nama)[0] }} 👋
                        </h1>
                        <p class="mt-2 text-green-50 text-sm opacity-90">
                            Sistem Informasi Akademik & Kemahasiswaan Terintegrasi.
                        </p>
                    </div>
                </div>

                <a href="{{ url('/ktm/p/' . $mahasiswa->qr_token) }}"
                   target="_blank"
                   class="bg-white text-green-700 hover:bg-green-50 px-6 py-3 rounded-xl text-sm font-bold shadow-lg transition hover:scale-105">
                    Lihat Profil Publik
                </a>

            </div>
        </div>

        <!-- STATS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- STATUS -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border flex items-center gap-4">
                <div class="p-4 rounded-xl {{ $mahasiswa->status === 'aktif' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                    ✔
                </div>
                <div>
                    <h3 class="text-gray-500 text-xs uppercase font-semibold">Status Akademik</h3>
                    <p class="text-xl font-bold">
                        {{ strtoupper($mahasiswa->status) }}
                    </p>
                </div>
            </div>

            <!-- SKILL -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border flex items-center gap-4">
                <div class="p-4 rounded-xl bg-blue-100 text-blue-600">
                    ⚡
                </div>
                <div>
                    <h3 class="text-gray-500 text-xs uppercase font-semibold">Total Skill</h3>
                    <p class="text-xl font-bold">
                        {{ $mahasiswa->skills?->count() ?? 0 }}
                    </p>
                </div>
            </div>

            <!-- PORTOFOLIO -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border flex items-center gap-4">
                <div class="p-4 rounded-xl bg-purple-100 text-purple-600">
                    📁
                </div>
                <div>
                    <h3 class="text-gray-500 text-xs uppercase font-semibold">Total Portofolio</h3>
                    <p class="text-xl font-bold">
                        {{ $mahasiswa->portofolio?->count() ?? 0 }}
                    </p>
                </div>
            </div>

        </div>

        <!-- MANAGEMENT GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- PROFIL -->
            <div class="bg-white rounded-2xl shadow-sm border flex flex-col hover:shadow-lg transition">

                <div class="p-6 border-b flex justify-between items-center">
                    <h2 class="text-lg font-bold">Profil Saya</h2>
                    <a href="/ktm/mahasiswa/profil"
                       class="text-xs font-bold text-green-600 hover:bg-green-50 px-3 py-1.5 rounded-lg">
                        EDIT PROFIL
                    </a>
                </div>

                <div class="p-6 flex-1 flex flex-col items-center text-center">

                    <div class="w-24 h-24 rounded-full border-4 border-green-50 overflow-hidden mb-4 shadow-sm">
                        @if($mahasiswa->profil && $mahasiswa->profil->foto)
                            <img src="{{ asset('storage/' . $mahasiswa->profil->foto) }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                👤
                            </div>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold text-gray-900">
                        {{ $mahasiswa->nama }}
                    </h3>

                    <p class="text-sm text-gray-500 mb-4">
                        {{ $mahasiswa->nim }} • {{ $mahasiswa->prodi }}
                    </p>

                    <div class="w-full bg-gray-50 rounded-xl p-4 text-left mt-auto">
                        <p class="text-xs text-gray-400 font-semibold uppercase mb-1">
                            Tentang Saya
                        </p>

                        <p class="text-sm text-gray-600 italic">
                            "{{ optional($mahasiswa->profil)->tentang_saya ?? 'Belum ada deskripsi profil.' }}"
                        </p>
                    </div>

                </div>
            </div>

            <!-- SKILL -->
            <div class="bg-white rounded-2xl shadow-sm border flex flex-col hover:shadow-lg transition">

                <div class="p-6 border-b flex justify-between items-center">
                    <h2 class="text-lg font-bold">Skill & Keahlian</h2>
                    <a href="/ktm/mahasiswa/skill"
                       class="text-xs font-bold text-blue-600 hover:bg-blue-50 px-3 py-1.5 rounded-lg">
                        KELOLA
                    </a>
                </div>

                <div class="p-6 flex-1">

                    @if($mahasiswa->skills && $mahasiswa->skills->count())
                        @foreach($mahasiswa->skills->take(3) as $skill)
                            <div class="flex justify-between p-3 rounded-xl bg-gray-50 border mb-2">
                                <span>{{ $skill->nama_skill }}</span>
                                <span class="text-xs uppercase">{{ $skill->level }}</span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-400 text-sm text-center">Belum ada skill.</p>
                    @endif

                </div>
            </div>

            <!-- PORTOFOLIO -->
            <div class="bg-white rounded-2xl shadow-sm border flex flex-col hover:shadow-lg transition">

                <div class="p-6 border-b flex justify-between items-center">
                    <h2 class="text-lg font-bold">Portofolio</h2>
                    <a href="/ktm/mahasiswa/portofolio"
                       class="text-xs font-bold text-purple-600 hover:bg-purple-50 px-3 py-1.5 rounded-lg">
                        KELOLA
                    </a>
                </div>

                <div class="p-6 flex-1">

                    @if($mahasiswa->portofolio && $mahasiswa->portofolio->count())
                        @foreach($mahasiswa->portofolio->take(2) as $item)
                            <div class="mb-3">
                                <h4 class="text-sm font-bold">{{ $item->judul }}</h4>
                                <p class="text-xs text-gray-500 line-clamp-1">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-400 text-sm text-center">
                            Belum ada portofolio.
                        </p>
                    @endif

                </div>
            </div>

        </div>

    </div>

</x-app-layout>
