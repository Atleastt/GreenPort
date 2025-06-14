<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Auditee') }}
        </h2>
    </x-slot> -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Jadwal Audit Mendatang</h3>
                    <p class="mt-2 text-3xl font-bold text-indigo-600 dark:text-indigo-400">2</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Audit terjadwal</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Dokumen Diminta</h3>
                    <p class="mt-2 text-3xl font-bold text-yellow-600 dark:text-yellow-400">5</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Menunggu diunggah</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Temuan Terbuka</h3>
                    <p class="mt-2 text-3xl font-bold text-red-600 dark:text-red-400">3</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Memerlukan tindakan</p>
                </div>
            </div>

            <!-- Tabel Aktivitas Terbaru -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Aktivitas Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aktivitas</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">15 Juli 2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Permintaan dokumen untuk Audit K3</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300">Menunggu</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">10 Juli 2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Anda mengunggah bukti untuk temuan TM-001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">Selesai</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">01 Juli 2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Jadwal audit baru telah ditambahkan: Audit Keuangan H1</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">Informasi</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@section('content')
    <h1 class="text-2xl font-semibold text-gray-700 mb-4">Dashboard Auditee</h1>
    <p class="text-gray-600">Ini adalah placeholder untuk Dashboard Auditee.</p>
    <p class="text-gray-600 mt-2">Konten spesifik halaman dashboard auditee akan ditambahkan di sini berdasarkan Figma jika ada desainnya.</p>
    
    {{-- Contoh link ke halaman lain yang relevan untuk Auditee --}}
    <div class="mt-6">
        <h2 class="text-xl font-medium text-gray-700 mb-2">Akses Cepat:</h2>
        <ul class="list-disc list-inside space-y-1">
            <li><a href="{{ route('bukti.pendukung.auditee') }}" class="text-blue-600 hover:underline">Input Bukti Pendukung</a></li>
            <li><a href="{{ route('detail.audit.auditee') }}" class="text-blue-600 hover:underline">Lihat Detail Audit (Placeholder)</a></li>
            {{-- Tambahkan link lain sesuai kebutuhan --}}
        </ul>
    </div>
@endsection
