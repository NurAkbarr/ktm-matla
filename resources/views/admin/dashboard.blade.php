<x-admin-layout>
    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
            Dashboard Admin
        </h1>
        <p class="mt-2 text-sm text-gray-500">
            Ringkasan statistik dan data mahasiswa KTM Digital.
        </p>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <!-- Card 1 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Mahasiswa</p>
                    <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalMahasiswa }}</h2>
                </div>
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-400">
                <span class="text-green-500 bg-green-50 px-1.5 py-0.5 rounded mr-2 font-bold">LIVE</span>
                <span>Data Realtime</span>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                     <p class="text-sm font-medium text-gray-500">Mahasiswa Aktif</p>
                    <h2 class="text-3xl font-bold text-green-600 mt-1">{{ $totalAktif }}</h2>
                </div>
                <div class="p-3 bg-green-50 rounded-xl text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
             <div class="mt-4 flex items-center text-xs text-gray-400">
                 <span>Status Aktif</span>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                     <p class="text-sm font-medium text-gray-500">Non-Aktif / Cuti</p>
                    <h2 class="text-3xl font-bold text-red-600 mt-1">{{ $totalNonAktif }}</h2>
                </div>
                <div class="p-3 bg-red-50 rounded-xl text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
             <div class="mt-4 flex items-center text-xs text-gray-400">
                 <span>Status Tidak Aktif</span>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                     <p class="text-sm font-medium text-gray-500">Total User System</p>
                    <h2 class="text-3xl font-bold text-purple-600 mt-1">{{ $totalUser }}</h2>
                </div>
                <div class="p-3 bg-purple-50 rounded-xl text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-400">
                 <span>Termasuk Admin</span>
            </div>
        </div>

    </div>

    <!-- CHARTS ROW -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- CHART 1: SEBARAN PRODI -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">
                Sebaran Mahasiswa per Prodi
            </h3>
            <div id="chart-prodi" class="w-full"></div>
        </div>

        <!-- CHART 2: STATUS AKTIF -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
             <h3 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">
                Perbandingan Status Mahasiswa
            </h3>
            <div id="chart-status" class="w-full"></div>
        </div>

    </div>

    <script>
        // DATA FROM CONTROLLER
        const prodiLabels = @json($prodiLabels);
        const prodiData = @json($prodiData);
        const totalAktif = {{ $totalAktif }};
        const totalNonAktif = {{ $totalNonAktif }};

        // --- CHART 1: PRODI (PIE/DONUT) ---
        var optionsProdi = {
            series: prodiData,
            chart: {
                type: 'donut',
                height: 350,
                fontFamily: 'Inter, sans-serif'
            },
            labels: prodiLabels,
            colors: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899', '#6366F1'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                fontSize: '22px',
                                fontWeight: 600,
                                color: '#374151',
                            }
                        }
                    }
                }
            },
             dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " Mahasiswa"
                    }
                }
            }
        };

        var chartProdi = new ApexCharts(document.querySelector("#chart-prodi"), optionsProdi);
        chartProdi.render();


        // --- CHART 2: STATUS (BAR) ---
        var optionsStatus = {
            series: [{
                name: 'Jumlah',
                data: [totalAktif, totalNonAktif]
            }],
            chart: {
                type: 'bar',
                height: 350,
                fontFamily: 'Inter, sans-serif',
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    columnWidth: '50%',
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: ['Aktif', 'Non-Aktif'],
                labels: {
                    style: {
                        colors: ['#10B981', '#EF4444'],
                        fontSize: '14px',
                        fontWeight: 600
                    }
                }
            },
            colors: ['#10B981', '#EF4444'],
            legend: {
                show: false
            },
             tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " Mahasiswa"
                    }
                }
            }
        };

        var chartStatus = new ApexCharts(document.querySelector("#chart-status"), optionsStatus);
        chartStatus.render();

    </script>

</x-admin-layout>
