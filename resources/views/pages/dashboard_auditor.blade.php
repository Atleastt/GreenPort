@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
            <div class="p-3 bg-blue-500 text-white rounded-full">
                <img class="h-12 w-auto" src="{{ asset('images/icon/total-dokumen-icon.svg') }}" alt="Dokumen Icon">
            </div>
            <div>
                <p class="text-3xl font-semibold text-gray-800">18273</p>
                <p class="text-gray-500">Total Dokumen</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
            <div class="p-3 bg-green-500 text-white rounded-full">
                <img class="h-12 w-auto" src="{{ asset('images/icon/total-users-icon.svg') }}" alt="Pengguna Icon">
            </div>
            <div>
                <p class="text-3xl font-semibold text-gray-800">120</p>
                <p class="text-gray-500">Total Pengguna</p>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Visualiasi</h3>
                <select class="text-sm border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                    <option>Jan - Jun</option>
                    <option>Jul - Dec</option>
                </select>
            </div>
            <div class="h-72 rounded">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Dokumen</h3>
                <select class="text-sm border-gray-300 rounded-md focus:ring-emerald-500 focus:border-emerald-500">
                    <option>Jan - Jun</option>
                    <option>Jul - Dec</option>
                </select>
            </div>
            <div class="h-48 rounded mb-4">
                <canvas id="barChart"></canvas>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div class="h-12 bg-sky-300 rounded flex items-center justify-center text-sky-800 text-sm">Auditee</div>
                <div class="h-12 bg-amber-600 rounded flex items-center justify-center text-white text-sm">Auditor</div>
                <div class="h-12 bg-teal-700 rounded flex items-center justify-center text-white text-sm">PDF</div>
                <div class="h-12 bg-yellow-400 rounded flex items-center justify-center text-yellow-800 text-sm">XLSX</div>
            </div>
        </div>
    </div>

    <!-- List Form Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-700 flex items-center">
                <svg class="h-6 w-6 mr-2 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" /></svg>
                List Form
            </h2>
            <div class="flex items-center space-x-3">
                <button class="text-sm text-gray-600 hover:text-gray-800 flex items-center">
                    <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" /></svg>
                    Urutkan
                </button>
                <a href="{{ route('tambah.dokumen') }}" class="bg-lime-500 hover:bg-lime-600 text-white font-semibold px-4 py-2 rounded-md shadow-sm text-sm">
                    Tambah Dokumen
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kriteria</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub-Kriteria</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Indikator</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot(%)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Point</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $formData = [
                            ['Kriteria-1', 'Sub-Kriteria-1A', 'Indikator-1', '40%', 10],
                            ['Kriteria-1', 'Sub-Kriteria-1B', 'Indikator-2', '50%', 20],
                            ['Kriteria-2', 'Sub-Kriteria-2C', 'Indikator-3', '10%', 30],
                            ['Kriteria-2', 'Sub-Kriteria-2D', 'Indikator-4', '15%', 40],
                            ['Kriteria-3', 'Sub-Kriteria-3E', 'Indikator-5', '25%', 50],
                            ['Kriteria-3', 'Sub-Kriteria-3F', 'Indikator-6', '20%', 60],
                        ];
                    @endphp
                    @foreach ($formData as $data)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $data[0] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $data[1] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $data[2] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $data[3] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $data[4] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-800">Lihat</a>
                            <button @click="deleteModalOpen = true; itemToDelete = '{{ $data[2] }}'" class="ml-3 text-red-600 hover:text-red-800">Hapus</button> {{-- Assuming itemToDelete is indicator name for simplicity --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal (can be reused or adapted) -->
    <div x-show="deleteModalOpen" x-cloak
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div x-show="deleteModalOpen" x-transition
             class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Hapus Item?</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus item <strong x-text="itemToDelete"></strong> ini?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click="deleteModalOpen = false; /* Add delete logic here */" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Hapus</button>
                <button @click="deleteModalOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk Line Chart
    const lineChartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
            label: 'Dokumen Diaudit',
            data: [65, 59, 80, 81, 56, 55],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    // Konfigurasi Line Chart
    const lineChartConfig = {
        type: 'line',
        data: lineChartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Render Line Chart
    const lineChart = new Chart(
        document.getElementById('lineChart'),
        lineChartConfig
    );

    // Data untuk Bar Chart
    const barChartData = {
        labels: ['Selesai', 'Proses', 'Revisi'],
        datasets: [{
            label: 'Status Dokumen',
            data: [300, 50, 100],
            backgroundColor: [
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)',
                'rgb(255, 99, 132)'
            ],
            borderWidth: 1
        }]
    };

    // Konfigurasi Bar Chart
    const barChartConfig = {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Render Bar Chart
    const barChart = new Chart(
        document.getElementById('barChart'),
        barChartConfig
    );
</script>
@endsection
