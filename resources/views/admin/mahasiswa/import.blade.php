<x-admin-layout>
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Import Data Mahasiswa</h1>
                    <p class="text-sm text-gray-500 mt-2">Upload file CSV untuk menambahkan data mahasiswa secara massal.</p>
                </div>

                @if(session('error'))
                    <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.mahasiswa.import.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">File CSV / Excel (Convert to CSV)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-green-500 transition-colors cursor-pointer bg-gray-50 hover:bg-green-50/30 group">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-green-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500 px-2">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file" type="file" class="sr-only" accept=".csv, .txt">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    CSV, TXT up to 2MB
                                </p>
                            </div>
                        </div>
                        @error('file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-blue-50 p-4 rounded-xl">
                        <h4 class="text-sm font-bold text-blue-800 mb-2">Format CSV yang Diharapkan:</h4>
                        <p class="text-xs text-blue-700 mb-2">Pastikan urutan kolom sesuai:</p>
                        <div class="bg-white p-2 rounded border border-blue-200 text-xs font-mono text-gray-600 overflow-x-auto">
                            NIM, Nama Lengkap, Email, Program Studi<br>
                            2024001, Ahmad Dahlan, ahmad@example.com, Teknik Informatika<br>
                            2024002, Siti Aminah, siti@example.com, Sistem Informasi
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('admin.mahasiswa.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-medium shadow-lg shadow-green-200">
                            Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
