<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Mahasiswa</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AlpineJS for interactive elements if needed -->
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

<div class="w-full max-w-2xl glass-card rounded-3xl shadow-2xl overflow-hidden transform transition-all hover:scale-[1.005] duration-500">
    
    {{-- Header with subtle pattern --}}
    <div class="relative bg-teal-600 p-8 text-center text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="relative z-10">
            <h1 class="text-3xl font-extrabold tracking-tight mb-2">Edit Profil</h1>
            <p class="text-teal-100 text-sm">Perbarui informasi dan foto profil Anda</p>
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

        <form method="POST"
              action="{{ url('/ktm/mahasiswa/profil') }}"
              enctype="multipart/form-data"
              class="space-y-8"
              x-data="{ 
                  photoPreview: '{{ $mahasiswa->profil && $mahasiswa->profil->foto ? asset('storage/'.$mahasiswa->profil->foto) : '' }}',
                  fileName: ''
              }">

            @csrf

            {{-- Photo Upload Section --}}
            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Foto Profil</label>
                
                <div class="flex flex-col sm:flex-row items-center gap-8">
                    
                    {{-- Preview Circle --}}
                    <div class="relative group">
                        <div class="w-40 h-40 rounded-full overflow-hidden border-4 border-white shadow-lg ring-4 ring-teal-50 bg-gray-100 flex-shrink-0">
                            <template x-if="photoPreview">
                                <img :src="photoPreview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!photoPreview">
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </template>
                        </div>
                        {{-- Edit Icon Overlay --}}
                        <div class="absolute bottom-2 right-2 bg-teal-600 text-white p-2 rounded-full shadow-md cursor-pointer hover:bg-teal-700 transition"
                             @click="document.getElementById('fotoInput').click()">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>

                    {{-- Upload Control --}}
                    <div class="flex-1 w-full">
                        <div class="relative border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center hover:bg-teal-50 hover:border-teal-400 transition-colors cursor-pointer group"
                             @click="document.getElementById('fotoInput').click()">
                            
                            <input type="file" 
                                   id="fotoInput" 
                                   name="fotoInput" 
                                   class="hidden" 
                                   accept="image/*"
                                   @change="
                                       const file = $event.target.files[0];
                                       const reader = new FileReader();
                                       reader.onload = (e) => { photoPreview = e.target.result; };
                                       reader.readAsDataURL(file);
                                       fileName = file.name;
                                   ">
                            
                            <div class="space-y-2">
                                <svg class="mx-auto h-10 w-10 text-gray-400 group-hover:text-teal-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <div class="text-sm text-gray-600">
                                    <span class="font-medium text-teal-600 group-hover:text-teal-700">Klik untuk upload</span> atau drag foto kesini
                                </div>
                                <p class="text-xs text-gray-400">JPG, PNG (Max 2MB)</p>
                            </div>

                            {{-- File Name Display --}}
                            <div x-show="fileName" class="mt-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-teal-100 text-teal-800" style="display: none;">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span x-text="fileName"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- About Me Section --}}
            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Tentang Saya</label>
                <div class="relative">
                    <textarea name="tentang_saya"
                            rows="5"
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl p-4 text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all placeholder-gray-400 shadow-inner resize-none appearance-none"
                            placeholder="Ceritakan sedikit tentang diri, hobi, atau keahlian Anda..."
                    >{{ old('tentang_saya', $mahasiswa->profil->tentang_saya ?? '') }}</textarea>
                    
                    {{-- Decorative corner --}}
                    <div class="absolute bottom-3 right-3 text-gray-300 pointer-events-none">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 pt-4">
                <a href="{{ url('/ktm/mahasiswa/dashboard') }}" 
                   class="flex-1 text-center py-3.5 px-6 rounded-xl border border-gray-200 text-gray-600 font-semibold hover:bg-gray-50 hover:text-gray-800 transition-colors shadow-sm">
                    Batal
                </a>
                <button type="submit"
                        class="flex-[2] py-3.5 px-6 rounded-xl bg-gradient-to-r from-teal-600 to-green-600 text-white font-bold tracking-wide hover:from-teal-700 hover:to-green-700 focus:ring-4 focus:ring-teal-200 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

</body>
</html>
