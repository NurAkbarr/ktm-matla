<x-admin-layout>

    <div class="max-w-md mx-auto bg-white rounded-xl shadow p-6 text-center">

        <h2 class="text-lg font-bold text-gray-800 mb-4">
            QR Code Mahasiswa
        </h2>

        <div class="flex justify-center mb-4">
            {!! $qr !!}
        </div>

        <div class="text-sm text-gray-600 mb-6">
            {{ $mahasiswa->nama }} - {{ $mahasiswa->nim }}
        </div>

        <div class="flex justify-center gap-3">

            <!-- DOWNLOAD BUTTON -->
            <a href="{{ route('admin.mahasiswa.downloadQr', $mahasiswa->id) }}"
               class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-lg shadow">
                Download PNG
            </a>

            <!-- BACK BUTTON -->
            <a href="{{ route('admin.mahasiswa.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm px-4 py-2 rounded-lg rounded-lg">
                Kembali
            </a>

        </div>

    </div>

</x-admin-layout>
