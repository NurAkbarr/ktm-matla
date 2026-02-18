<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Skill Mahasiswa</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AlpineJS for interactive elements -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #0f766e 0%, #064e3b 100%);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4 sm:p-6 font-sans antialiased text-gray-800">

<div class="w-full max-w-2xl glass-card rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-500">
    
    {{-- Header with subtle pattern --}}
    <div class="relative bg-teal-600 p-8 text-center text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="relative z-10">
            <h1 class="text-3xl font-extrabold tracking-tight mb-2">Kelola Skill</h1>
            <p class="text-teal-100 text-sm">Tambahkan keahlian untuk memperkaya profil Anda</p>
        </div>
    </div>

    <div class="p-8 sm:p-10 space-y-8">

        {{-- Error handling --}}
        @if($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-xl border border-red-200 flex items-start space-x-3 shadow-sm animate-pulse">
                <svg class="w-5 h-5 mt-0.5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="text-sm">
                    <ul class="list-disc ml-4 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(session('error'))
             <div class="bg-red-50 text-red-700 p-4 rounded-xl border border-red-200 flex items-start space-x-3 shadow-sm">
                <svg class="w-5 h-5 mt-0.5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="text-sm font-medium">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ url('/ktm/mahasiswa/skill') }}" class="space-y-6">
            @csrf

            {{-- Skill Name Input --}}
            <div class="space-y-2">
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Nama Skill</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <input type="text" name="nama_skill" 
                           class="w-full bg-gray-50 border border-gray-200 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all placeholder-gray-400 shadow-sm"
                           placeholder="Contoh: Laravel, desain grafis, public speaking..."
                           required>
                </div>
            </div>

            {{-- Level Select --}}
            <div class="space-y-2">
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Tingkat Keahlian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <select name="level" 
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl pl-12 pr-10 py-3.5 focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all shadow-sm appearance-none cursor-pointer"
                            required>
                        <option value="" disabled selected>Pilih Tingkat Penguasaan</option>
                        <option value="dasar">Dasar (Beginner)</option>
                        <option value="menengah">Menengah (Intermediate)</option>
                        <option value="mahir">Mahir (Advanced)</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 pt-2">
                <a href="{{ url('/ktm/mahasiswa/dashboard') }}" 
                   class="flex-1 text-center py-3.5 px-6 rounded-xl border border-gray-200 text-gray-600 font-semibold hover:bg-gray-50 hover:text-gray-800 transition-colors shadow-sm">
                    Kembali
                </a>
                <button type="submit"
                        class="flex-[2] py-3.5 px-6 rounded-xl bg-gradient-to-r from-teal-600 to-green-600 text-white font-bold tracking-wide hover:from-teal-700 hover:to-green-700 focus:ring-4 focus:ring-teal-200 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Simpan Skill
                </button>
            </div>

        </form>

        <hr class="border-gray-100">

        {{-- Skills List --}}
        <div class="space-y-4">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Skill yang Dimiliki
            </h3>
            
            @if($mahasiswa->skills->count())
                <div class="grid gap-3">
                    @foreach($mahasiswa->skills as $skill)
                        <div class="group flex justify-between items-center p-4 bg-gray-50 border border-gray-100 rounded-xl hover:border-teal-200 transition-all hover:shadow-md">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full 
                                    {{ $skill->level == 'dasar' ? 'bg-yellow-400' : 
                                      ($skill->level == 'menengah' ? 'bg-blue-400' : 'bg-green-500') }}">
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $skill->nama_skill }}</h4>
                                    <span class="text-xs uppercase font-semibold tracking-wide text-gray-500 bg-white px-2 py-0.5 rounded-full border border-gray-200">
                                        {{ ucfirst($skill->level) }}
                                    </span>
                                </div>
                            </div>
                            
                            <form method="POST" action="{{ url('/ktm/mahasiswa/skill/' . $skill->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-gray-400 hover:text-red-500 p-2 rounded-full hover:bg-red-50 transition-colors"
                                        title="Hapus Skill">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 text-sm">Belum ada skill yang ditambahkan.</p>
                </div>
            @endif
        </div>

    </div>
</div>

</body>
</html>
