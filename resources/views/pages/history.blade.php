@extends('layouts.app')

@section('content')
<div x-data="{ deleteModalOpen: false, itemToDelete: '' }">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">Riwayat Transaksi/Aktivitas</h1>
            <div class="flex items-center space-x-3">
                <button class="text-sm text-gray-600 hover:text-gray-800 flex items-center">
                    <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" /></svg>
                    Urutkan
                </button>
{{--            <a href="{{ route('tambah.history') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-4 py-2 rounded-md shadow-sm text-sm">--}}
{{--                Tambah Riwayat--}}
{{--            </a>--}}
            </div>
        </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auditor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auditee</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi/Dokumen</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $historyData = [
                            ['id' => 1, 'date' => '2024-05-22', 'auditor' => 'Ahmad Subarjo', 'auditee' => 'PT Pelabuhan Jaya', 'description' => 'Audit Kepatuhan Lingkungan Tahap 1', 'status' => 'Selesai'],
                            ['id' => 2, 'date' => '2024-05-20', 'auditor' => 'Siti Aminah', 'auditee' => 'Terminal Petikemas Sentosa', 'description' => 'Verifikasi Dokumen SOP Keamanan', 'status' => 'Dalam Proses'],
                            ['id' => 3, 'date' => '2024-05-18', 'auditor' => 'Budi Santoso', 'auditee' => 'Gudang Logistik Bahari', 'description' => 'Pengajuan Perpanjangan Sertifikat ISO', 'status' => 'Pending'],
                            ['id' => 4, 'date' => '2024-05-15', 'auditor' => 'Ahmad Subarjo', 'auditee' => 'PT Pelabuhan Jaya', 'description' => 'Follow-up Temuan Audit Sebelumnya', 'status' => 'Selesai'],
                        ];
                    @endphp
                    @forelse ($historyData as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item['date'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item['auditor'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item['auditee'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ Str::limit($item['description'], 40) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                            @if($item['status'] == 'Selesai')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                            @elseif($item['status'] == 'Dalam Proses')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Dalam Proses</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('lihat.history', ['id' => $item['id']]) }}" class="text-blue-600 hover:text-blue-800">Lihat</a>
                            <a href="#" class="ml-3 text-indigo-600 hover:text-indigo-900">Edit</a>
                            <button @click="deleteModalOpen = true; itemToDelete = '{{ $item['description'] }}'" class="ml-3 text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">Tidak ada data riwayat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination (placeholder) -->
        <div class="mt-4 flex justify-end">
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">Prev</a>
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">Next</a>
            </nav>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
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
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Hapus Riwayat?</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus riwayat <strong x-text="itemToDelete"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
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
@endsection
