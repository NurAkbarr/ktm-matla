<x-admin-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-teal-600">
                    Data Mahasiswa
                </h1>
                <p class="mt-2 text-sm text-gray-500">
                    Kelola data mahasiswa KTM Digital dengan mudah dan efisien.
                </p>
            </div>

            <div class="flex gap-2">
                <button onclick="submitBulkPrint()" style="background-color: #374151; color: white;" class="hidden md:inline-flex items-center justify-center gap-2 px-4 py-3 bg-gray-700 hover:bg-gray-800 text-white text-sm font-semibold rounded-xl shadow-lg transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Print QR Selected</span>
                </button>

                <a href="{{ route('admin.mahasiswa.print') }}" target="_blank" class="hidden md:inline-flex items-center justify-center gap-2 px-4 py-3 bg-gray-500 hover:bg-gray-600 text-white text-sm font-semibold rounded-xl shadow-lg transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Print Data</span>
                </a>

                <a href="{{ route('admin.mahasiswa.export') }}" class="hidden md:inline-flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-lg transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Export CSV</span>
                </a>

                <a href="{{ route('admin.mahasiswa.import') }}" style="background-color: #9333ea; color: white;" class="hidden md:inline-flex items-center justify-center gap-2 px-4 py-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-xl shadow-lg transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    <span>Import CSV</span>
                </a>

                <a href="{{ route('admin.mahasiswa.create') }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-green-200 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Tambah Mahasiswa</span>
                </a>
            </div>
        </div>

        <!-- SEARCH & FILTER -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8 relative overflow-hidden">
             <!-- Decorative Top Border -->
             <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-green-400 to-teal-500 opacity-50"></div>

            <form method="GET" class="flex flex-col md:flex-row gap-4 items-center">

                <div class="relative w-full md:w-1/3 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama, NIM, atau email..."
                           class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out sm:text-sm">
                </div>

                <div class="relative w-full md:w-1/5 group">
                     <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <select name="status"
                            class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl leading-5 bg-gray-50 focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out sm:text-sm appearance-none">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                     <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <div class="flex gap-3 w-full md:w-auto">
                    <button type="submit"
                            class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-xl transition-colors duration-200">
                        <span>Filter</span>
                    </button>

                    <a href="{{ route('admin.mahasiswa.index') }}"
                       class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-xl transition-colors duration-200">
                        <span>Reset</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="selectAll" onclick="toggleSelectAll()" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">NIM</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Prodi</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">QR Code</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($mahasiswa as $mhs)
                        <tr class="hover:bg-green-50/50 transition-colors duration-200 group">
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <input type="checkbox" name="ids[]" value="{{ $mhs->id }}" class="student-checkbox rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $mhs->nim }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center text-green-700 font-bold text-sm">
                                            {{ substr($mhs->nama, 0, 2) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 group-hover:text-green-700 transition-colors">
                                            {{ $mhs->nama }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $mhs->user->email ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $mhs->prodi }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.mahasiswa.toggleStatus', $mhs->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize transition-colors duration-200
                                            {{ $mhs->status === 'aktif' ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $mhs->status === 'aktif' ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                        {{ ucfirst($mhs->status) }}
                                    </button>
                                </form>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 space-x-2">
                                <div class="flex items-center gap-2">
                                     <a href="{{ route('admin.mahasiswa.qr', $mhs->id) }}"
                                       class="text-gray-400 hover:text-green-600 transition-colors p-1 rounded-md hover:bg-green-50"
                                       title="Lihat QR">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.mahasiswa.downloadQr', $mhs->id) }}"
                                       class="text-gray-400 hover:text-green-600 transition-colors p-1 rounded-md hover:bg-green-50"
                                       title="Download QR">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" 
                                       class="text-blue-500 hover:text-blue-700 p-1.5 rounded-lg hover:bg-blue-50 transition-colors"
                                       title="Edit Mahasiswa">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" 
                                          method="POST" 
                                          class="inline-block" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini? Data yang dihapus tidak dapat dikembalikan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700 p-1.5 rounded-lg hover:bg-red-50 transition-colors"
                                                title="Hapus Mahasiswa">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-base font-medium text-gray-600">Belum ada data mahasiswa.</p>
                                    <p class="text-sm text-gray-400 mt-1">Silakan tambahkan data mahasiswa baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($mahasiswa->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $mahasiswa->links() }}
                </div>
            @endif
        </div>

    </div>

</x-admin-layout>

<form id="bulkPrintForm" action="{{ route('admin.mahasiswa.bulkPrint') }}" method="POST" target="_blank" style="display: none;">
    @csrf
    <div id="bulkInputs"></div>
</form>

<script>
    function toggleSelectAll() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.student-checkbox');
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
    }

    function submitBulkPrint() {
        const checkboxes = document.querySelectorAll('.student-checkbox:checked');
        if (checkboxes.length === 0) {
            alert('Pilih minimal satu mahasiswa untuk dicetak QR-nya.');
            return;
        }

        const formInputs = document.getElementById('bulkInputs');
        formInputs.innerHTML = ''; // Clear previous

        checkboxes.forEach(cb => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = cb.value;
            formInputs.appendChild(input);
        });

        document.getElementById('bulkPrintForm').submit();
    }
</script>
