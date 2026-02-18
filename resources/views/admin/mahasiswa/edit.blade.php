<x-admin-layout>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-teal-600">
                    Edit Data Mahasiswa
                </h1>
                <p class="mt-2 text-sm text-gray-500">
                    Perbarui informasi data mahasiswa di bawah ini.
                </p>
            </div>
            
            <a href="{{ route('admin.mahasiswa.index') }}" 
               class="group inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-green-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Daftar</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 relative">
            <!-- Decorative Top Border -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-green-400 to-teal-500"></div>

            <div class="p-8 sm:p-10">

                <form method="POST" action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Nama -->
                        <div class="space-y-2 group">
                            <label class="block text-sm font-semibold text-gray-700 group-focus-within:text-green-600 transition-colors duration-200">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $mahasiswa->nama) }}"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out sm:text-sm hover:border-gray-400">
                            </div>
                        </div>

                        <!-- Program Studi -->
                        <div class="space-y-2 group">
                            <label class="block text-sm font-semibold text-gray-700 group-focus-within:text-green-600 transition-colors duration-200">
                                Program Studi
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                    </svg>
                                </div>
                                <input type="text"
                                       name="prodi"
                                       value="{{ old('prodi', $mahasiswa->prodi) }}"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out sm:text-sm hover:border-gray-400">
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="space-y-2 group">
                            <label class="block text-sm font-semibold text-gray-700 group-focus-within:text-green-600 transition-colors duration-200">
                                Jenis Kelamin
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <select name="jenis_kelamin"
                                        class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl leading-5 bg-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out sm:text-sm hover:border-gray-400 appearance-none">
                                    <option value="laki-laki" {{ $mahasiswa->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ $mahasiswa->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="space-y-2 group">
                            <label class="block text-sm font-semibold text-gray-700 group-focus-within:text-green-600 transition-colors duration-200">
                                Status Mahasiswa
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <select name="status"
                                        class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl leading-5 bg-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out sm:text-sm hover:border-gray-400 appearance-none">
                                    <option value="aktif" {{ $mahasiswa->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ $mahasiswa->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                        <a href="{{ route('admin.mahasiswa.index') }}"
                           class="px-6 py-3 bg-white border border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-green-200 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Perbarui Data</span>
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</x-admin-layout>
