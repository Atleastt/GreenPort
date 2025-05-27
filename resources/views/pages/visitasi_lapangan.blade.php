@extends('layouts.app')

@section('content')
<div x-data="{ deleteModalOpen: false, itemToDelete: null }">
    <!-- Form Tambah Jadwal Visitasi -->
    <div class="bg-white p-6 md:p-8 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Jadwalkan Visitasi Lapangan Baru</h2>
        <form action="#" method="POST" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                    <label for="auditor_name" class="block text-sm font-medium text-gray-700">Nama Auditor</label>
                    <input type="text" name="auditor_name" id="auditor_name" value="{{ Auth::user()->name ?? 'Auditor Terlogin' }}" readonly
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
            </div>
            <div>
                    <label for="auditee_name" class="block text-sm font-medium text-gray-700">Nama Auditee</label>
                    <select id="auditee_name" name="auditee_name"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                        <option value="">Pilih Auditee</option>
                        <option value="PT Pelabuhan Jaya">PT Pelabuhan Jaya</option>
                        <option value="Terminal Petikemas Sentosa">Terminal Petikemas Sentosa</option>
                        <option value="Gudang Logistik Bahari">Gudang Logistik Bahari</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="visit_date" class="block text-sm font-medium text-gray-700">Tanggal Visitasi</label>
                <input type="date" name="visit_date" id="visit_date"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
            </div>

            <div>
                <label for="visit_notes" class="block text-sm font-medium text-gray-700">Catatan Tambahan (Opsional)</label>
                <textarea name="visit_notes" id="visit_notes" rows="4" placeholder="Contoh: Fokus pada pemeriksaan area gudang dan pengelolaan limbah."
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"></textarea>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Daftar Jadwal Visitasi -->
    <div class="bg-white p-6 md:p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Jadwal Visitasi Lapangan</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auditor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auditee</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $schedules = [
                            ['id' => 1, 'date' => '2024-06-10', 'auditor' => 'Ahmad Subarjo', 'auditee' => 'PT Pelabuhan Jaya', 'status' => 'Terjadwal'],
                            ['id' => 2, 'date' => '2024-05-28', 'auditor' => 'Siti Aminah', 'auditee' => 'Terminal Petikemas Sentosa', 'status' => 'Selesai'],
                            ['id' => 3, 'date' => '2024-06-15', 'auditor' => 'Budi Santoso', 'auditee' => 'Gudang Logistik Bahari', 'status' => 'Terjadwal'],
                        ];
                    @endphp
                    @forelse ($schedules as $schedule)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $schedule['date'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $schedule['auditor'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $schedule['auditee'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($schedule['status'] == 'Selesai')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Terjadwal</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-800">Detail</a>
                            <button @click="deleteModalOpen = true; itemToDelete = 'Jadwal {{ $schedule['auditee'] }} {{ $schedule['date'] }}'" class="ml-3 text-red-600 hover:text-red-900">Batalkan</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">Belum ada jadwal visitasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal (Cancel Schedule) -->
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
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Batalkan Jadwal Visitasi?</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Apakah Anda yakin ingin membatalkan jadwal visitasi untuk <strong x-text="itemToDelete"></strong>?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click="deleteModalOpen = false; /* Add cancellation logic here */" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Ya, Batalkan</button>
                <button @click="deleteModalOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Tidak</button>
            </div>
        </div>
    </div>
</div>
@endsection
