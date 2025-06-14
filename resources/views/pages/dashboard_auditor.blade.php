<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Auditor') }}
        </h2>
    </x-slot> -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ deleteModalOpen: false, itemToDelete: { id: null, text: '' } }" class="space-y-6">
                <!-- Bagian Chart -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                        <h3 class="font-semibold text-lg mb-2 text-gray-800 dark:text-gray-200">Dokumen Diaudit</h3>
                        <div class="h-64">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                        <h3 class="font-semibold text-lg mb-2 text-gray-800 dark:text-gray-200">Status Dokumen</h3>
                        <div class="h-64">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <!-- Bagian Tabel -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">Daftar Dokumen Audit</h3>
                        <div class="flex items-center space-x-2">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-md shadow-sm text-sm flex items-center">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" /></svg>
                                Urutkan
                            </button>
                            <a href="{{ route('indikator.create') }}" class="bg-lime-500 hover:bg-lime-600 text-white font-semibold px-4 py-2 rounded-md shadow-sm text-sm">
                                Tambah Dokumen
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kriteria</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Sub-Kriteria</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Indikator</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Bobot(%)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Point</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($indikators as $indikator)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $indikator->subkriteria->kriteria->nama_kriteria ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $indikator->subkriteria->nama_subkriteria ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $indikator->teks_indikator }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $indikator->bobot_indikator }}%</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $indikator->poin_maks_indikator }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                                 <a href="{{ route('indikator.show', $indikator->id) }}" class="text-blue-600 hover:text-blue-800">Lihat</a>
                                         <a href="{{ route('indikator.edit', $indikator->id) }}" class="ml-3 text-yellow-600 hover:text-yellow-800">Ubah</a>
                                        <button @click="deleteModalOpen = true; itemToDelete = { id: {{ $indikator->id }}, text: '{{ addslashes($indikator->teks_indikator) }}' }" class="ml-3 text-red-600 hover:text-red-800">Hapus</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada data untuk ditampilkan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div x-show="deleteModalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <div x-show="deleteModalOpen" x-transition class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Hapus Item?</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus item <strong x-text="itemToDelete.text"></strong> ini?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                        <form :action="'/indikator/' + itemToDelete.id" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Hapus
                                </button>
                            </form>
                            <button @click="deleteModalOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 dark:text-gray-200 text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data untuk Line Chart
            const lineChartData = {
                labels: [],
                datasets: [{
                    label: 'Dokumen Diaudit',
                    data: [],
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
            const lineChartCtx = document.getElementById('lineChart');
            if(lineChartCtx) new Chart(lineChartCtx, lineChartConfig);

            // Data untuk Bar Chart
            const barChartData = {
                labels: [],
                datasets: [{
                    label: 'Status Dokumen',
                    data: [],
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
            const barChartCtx = document.getElementById('barChart');
            if(barChartCtx) new Chart(barChartCtx, barChartConfig);
        });
    </script>
    @endpush
</x-app-layout>
